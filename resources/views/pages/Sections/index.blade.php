@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('sections.Title') }}
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('sections.seasons') }}</h4>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<!-- main body --> 
<div class="row">   
    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
            <div class="card-body"> 
                @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif  
            <h5 class="card-title">
            <button data-target="#modaldemo1" data-toggle="modal" class="button x-small">{{trans('sections.Add_season')}}</button>
            </h5>
            
            <div class="accordion">
                <div class="acd-group acd-active">
                    @foreach ($Grades as $Grade)
                    <a href="#" class="acd-heading">{{$Grade->name}}</a>
                    <div class="acd-des">
                        <div class="row">
                            <div class="col-xl-12 mb-30">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">
                                        <div class="d-block d-md-flex justify-content-between">
                                            <div class="d-block">
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0">
                                                <thead>
                                                <tr class="text-dark">
                                                    <th>#</th>
                                                    <th>{{trans('sections.Name')}}</th>
                                                    <th>{{trans('classes.Name')}}</th>
                                                    <th>{{trans('sections.Actions')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 0;  
                                                @endphp
                                                @foreach ($Grade->Section as $list_section)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                    
                                                        <td>{{$i}}</td>
                                                        <td>{{$list_section->name}}</td>
                                                        <td>{{$list_section->Classroom->name}}</td>
                                                        <td>

                                                            <a href="#"
                                                                class="btn btn-outline-info btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#edit{{ $list_section->id }}">{{ trans('sections.Edit') }}</a>
                                                            <a href="#"
                                                                class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete{{ $list_section->id }}">{{ trans('sections.Delete') }}</a>
                                                        </td>
                                                    
                                                    </tr>
                                                    <!-- Delete -->
                                                    <div class="modal" id="delete{{$list_section->id}}">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content modal-content-demo">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title">{{ trans('sections.Delete_Section') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="{{route('Sections.destroy','test')}}">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <h6>{{trans('message.confirm')}}</h6>
                                                                        <div class="row">
                                                                            <input type="hidden" name="id" value="{{$list_section->id}}">
                                                                        </div>
                                                                    
                                                                        <div class="modal-footer">
                                                                            <button class="btn ripple btn-danger" type="submit">{{trans('sections.Delete')}}</button>
                                                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('sections.Close')}}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="edit{{ $list_section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                                                        {{ trans('sections.edit_Section') }}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <form action="{{ route('Sections.update', 'test') }}" method="POST">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <input type="text" name="name" class="form-control" value="{{ $list_section->getTranslation('name', 'ar') }}">
                                                                            </div>

                                                                            <div class="col">
                                                                                <input type="text" name="name_en" class="form-control" value="{{ $list_section->getTranslation('name', 'en') }}">
                                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $list_section->id }}">
                                                                            </div>

                                                                        </div>
                                                                        <br>


                                                                        <div class="col">
                                                                            <label for="inputName" class="control-label">{{ trans('sections.Name_Grade') }}</label>
                                                                            <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">
                                                                                <!--placeholder-->
                                                                                <option value="{{ $Grade->id }}">
                                                                                    {{ $Grade->name }}
                                                                                </option>
                                                                                @foreach ($List_Grades as $list_Grade)
                                                                                    <option value="{{ $list_Grade->id }}">
                                                                                        {{ $list_Grade->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <br>

                                                                        <div class="col">
                                                                            <label for="inputName" class="control-label">{{ trans('sections.Name_Class') }}</label>
                                                                            <select name="Class_id" class="custom-select">
                                                                                <option value="{{ $list_section->Classroom->id }}">
                                                                                    {{ $list_section->Classroom->name }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <br>
                                                                         <div class="form-group">
                                                                            <label for="exampleFormControlSelect2">{{trans('teacher.name')}}</label>
                                                                            <select multiple class="form-control" name="teacher_id[]" id="exampleFormControlSelect2">
                                                                                @foreach ($list_section->Teacher as $teacher)
                                                                                    <option value="{{$teacher['id']}}">{{$teacher['name']}}</option> 
                                                                                @endforeach
                                                                                @foreach ($teachers as $teacher)
                                                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option> 
                                                                                @endforeach
                                                                            
                                                                            
                                                                            </select>
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="button x-small" type="submit">{{trans('Sections.Save_changes')}}</button>
                                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Sections.Close')}}</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
        
        
            </div>
        </div>   
    </div>

</div> 
  <!-- Add -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('sections.Add_season') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('Sections.store')}}">
                    @csrf
                    <div class="row">
                       <div class="form-group">
                            <div class="col">
                                <label>{{trans('Sections.Name')}}</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                       </div>
                        <div class="form-group">
                            <div class="col">
                                <label>{{trans('Sections.Name_en')}}</label>
                                <input type="text" name="name_en" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label>{{trans('Grades.Name')}}</label>
                            <select class="form-control" name="Grade_id" id="Grade_id" onchange="console.log($(this).val())">
                            <option value="" disabled selected></option>
                            @foreach($Grades as $Grade)
                            <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col">
                            <label>{{trans('classes.Name')}}</label>
                            <select class="form-control" name="Class_id" id="Class_id">
                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">{{trans('teacher.name')}}</label>
                        <select multiple class="form-control" name="teacher_id[]" id="exampleFormControlSelect2">
                            @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option> 
                            @endforeach
                          
                          
                        </select>
                      </div>
                    <div class="modal-footer">
                        <button class="button x-small" type="submit">{{trans('Sections.Save_changes')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Sections.Close')}}</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="Class_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

</script>
@endsection
