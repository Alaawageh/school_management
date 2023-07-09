@extends('layouts.master')
@section('css')

@section('title')
   {{trans('Grades.Title')}} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-4">{{trans('Grades.Grades')}}</h4>
        </div>
        
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

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
                <button type="button" class="button x-small" data-target="#modaldemo1" data-toggle="modal">{{ trans('Grades.Add_Grade') }}</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered p-0" id="datatable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{trans('Grades.Name')}}</th>
                                <th class="wd-20p border-bottom-0">{{trans('Grades.Notes')}}</th>
                                <th class="wd-25p border-bottom-0">{{trans('Grades.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                              $i = 0;  
                            @endphp
                            @foreach ($Grades as $Grade)
                             @php
                                 $i++
                             @endphp 
                           
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$Grade->name}}</td>
                                <td>{{$Grade->notes}}</td>
                                <td>
                                    <button type="button" class="btn ripple btn-info" data-target="#edit{{$Grade->id}}" data-toggle="modal"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn ripple btn-danger" data-target="#delete{{$Grade->id}}" data-toggle="modal"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Edit -->
                            <div class="modal" id="edit{{$Grade->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">{{ trans('Grades.Edit_Grade') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('Grades.update','test')}}">
                                                @method('PUT')
                                                @csrf
                                                
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{$Grade->id}}">
                                                <div class="form-group">
                                                        <div class="col">
                                                            <label>{{trans('Grades.Name')}}</label>
                                                            <input type="text" name="name" class="form-control" value="{{$Grade->getTranslation('name','ar')}}">
                                                        </div>
                                                </div>
                                                    <div class="form-group">
                                                        <div class="col">
                                                            <label>{{trans('Grades.Name_en')}}</label>
                                                            <input type="text" name="name_en" class="form-control" value="{{$Grade->getTranslation('name','en')}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label>{{trans('Grades.Notes')}}</label>
                                                            <textarea name="notes" rows="3" class="form-control">{{$Grade->notes}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-success" type="submit">{{trans('Grades.Save_changes')}}</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Grades.Close')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Delete -->
                            <div class="modal" id="delete{{$Grade->id}}">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">{{ trans('Grades.Delete_Grade') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('Grades.destroy','test')}}">
                                                @method('delete')
                                                @csrf
                                                <h6>{{trans('message.confirm')}}</h6>
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{$Grade->id}}">
                                                </div>
                                               
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-danger" type="submit">{{trans('Grades.Delete')}}</button>
                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Grades.Close')}}</button>
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
                <h6 class="modal-title">{{ trans('Grades.Add_Grade') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('Grades.store')}}">
                    @csrf
                    <div class="row">
                       <div class="form-group">
                            <div class="col">
                                <label>{{trans('Grades.Name')}}</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                       </div>
                        <div class="form-group">
                            <div class="col">
                                <label>{{trans('Grades.Name_en')}}</label>
                                <input type="text" name="name_en" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>{{trans('Grades.Notes')}}</label>
                                <textarea name="notes" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="button x-small" type="submit">{{trans('Grades.Save_changes')}}</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Grades.Close')}}</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>


@endsection
@section('js')

@endsection
