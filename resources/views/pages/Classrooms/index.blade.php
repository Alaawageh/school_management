@extends('layouts.master')
@section('css')

@section('title')
   {{trans('classes.Title')}} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-4"> {{trans('classes.Classes')}}</h4>
        </div>
        {{-- <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div> --}}
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card card-statistics h-100">
            <div class="card-header">
                
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <button type="button" class="button x-small" data-target="#modaldemo1" data-toggle="modal">{{ trans('classes.Add_Class') }}</button>
                <button type="button" class="button x-small" id="btn_delete_all" style="display: none; visibility: visible;">
                    {{ trans('classes.delete_checkbox') }}
                </button>
                <br><br>
                
                <form action="{{ route('Filter_Classes') }}" method="POST">
                    @csrf
                    <select class="selectpicker" data-style="btn-info" name="Grade_id" required
                            onchange="this.form.submit()">
                        <option value="" selected disabled>{{trans('classes.search_by_Grade')}}</option>
                        @foreach ($Grades as $Grade)
                            <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered p-0" id="datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">
                                    <input type="checkbox" name="select_all" id="select_all" onclick="CheckAll('box1', this)" >
                                </th>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{trans('classes.Name')}}</th>
                                <th class="wd-20p border-bottom-0">{{trans('classes.Grade')}}</th>
                                <th class="wd-25p border-bottom-0">{{trans('classes.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                              $i = 0;  
                            @endphp
                            @foreach ($Classes as $Class) 
                             @php
                             $i++; 
                            @endphp
                            <tr>
                                <td><input type="checkbox"  value="{{ $Class->id }}" class="box1" ></td>
                                <td>{{$i}}</td>
                                <td>{{$Class->name}}</td>
                                <td>{{$Class->Grade->name}}</td>
                                <td>
                                    <button type="button" class="btn ripple btn-info" data-target="#edit{{$Class->id}}" data-toggle="modal"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn ripple btn-danger" data-target="#delete{{$Class->id}}" data-toggle="modal"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Edit -->
                            <div class="modal" id="edit{{$Class->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">{{ trans('classes.Edit_Class') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('Classes.update','test')}}">
                                                @method('PUT')
                                                @csrf
                                                
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{$Class->id}}">
                                                <div class="form-group">
                                                        <div class="col">
                                                            <label>{{trans('classes.Name')}}</label>
                                                            <input type="text" name="name" class="form-control" value="{{$Class->getTranslation('name','ar')}}">
                                                        </div>
                                                </div>
                                                    <div class="form-group">
                                                        <div class="col">
                                                            <label>{{trans('classes.Name_en')}}</label>
                                                            <input type="text" name="name_en" class="form-control" value="{{$Class->getTranslation('name','en')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <label class="mr-sm-2">{{trans('classes.Grade')}}</label>
                                                        {{-- <div class="box"> --}}
                                                            <select name="Grade_id" class="form-control">
                                                                <option value="{{$Class->Grade->id}}">{{$Class->Grade->name}}</option>
                                                                @foreach($Grades as $Grade)
                                                                <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        {{-- </div> --}}
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-success" type="submit">{{trans('classes.Save_changes')}}</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('classes.Close')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Delete -->
                            <div class="modal" id="delete{{$Class->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">{{ trans('classes.Delete_Class') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('Classes.destroy','test')}}">
                                                @method('delete')
                                                @csrf
                                                <h6>{{trans('message.confirm')}}</h6>
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{$Class->id}}">
                                                </div>
                                               
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-danger" type="submit">{{trans('Classes.Delete')}}</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Classes.Close')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                        
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
<!-- Add -->
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('classes.Add_Class') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('Classes.store')}}" class="row mb-30">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col-md-3">
                                                <label class="mr-sm-2">{{trans('classes.Name')}}</label>
                                                <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                                <label class="mr-sm-2">{{trans('classes.Name_en')}}</label>
                                                <input type="text" name="name_en" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="mr-sm-2">{{trans('classes.Grade')}}</label>
                                            {{-- <div class="box"> --}}
                                                <select name="Grade_id" class="form-control">
                                                    @foreach($Grades as $Grade)
                                                    <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                                    @endforeach
                                                </select>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="col-md-1">
                                            <label class="mr-sm-2">{{ trans('classes.Processes') }}:</label>
                                            <input class="btn btn-danger" data-repeater-delete type="button" value="{{ trans('classes.Delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col">
                                    <button class="btn btn-info" data-repeater-create type="button">{{trans('classes.Add_recorde')}}</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="button x-small" type="submit">{{trans('classes.Save_changes')}}</button>
                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('classes.Close')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- row closed -->
<!-- حذف مجموعة صفوف -->
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('classes.Delete_Class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                @csrf
                <div class="modal-body">
                    {{trans('message.confirm')}}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classes.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('classes.Save_changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $("#select_all").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
    
});
$("input:checkbox").click(function(e) {
    $("#btn_delete_all").show();
});
</script>
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>
@endsection
