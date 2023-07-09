@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('teacher.title') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('teacher.List_Teachers')}}</h4>
        </div>
      
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('Teachers.create')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{ trans('teacher.create') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('teacher.name')}}</th>
                                            <th>{{trans('teacher.email')}}</th>
                                            <th>{{trans('teacher.specialization')}}</th>
                                            <th>{{trans('teacher.gender')}}</th>
                                            <th>{{trans('teacher.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                          $i = 0;  
                                        @endphp
                                        @foreach ($teachers as $teacher)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$teacher->name}}</td>
                                                <td>{{$teacher->email}}</td>
                                                <td>{{$teacher->specialization->name}}</td>
                                                <td>{{$teacher->gender->name}}</td>
                                                <td>
                                                    <a href="{{route('Teachers.edit',$teacher->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Teacher{{ $teacher->id }}" title="{{ trans('teacher.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <!-- Add -->
                                            <div class="modal" id="delete_Teacher{{$teacher->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">{{ trans('teacher.Delete') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('Teachers.destroy','test')}}">
                                                                @method('delete')
                                                                @csrf
                                                                <h6>{{trans('message.confirm')}}</h6>
                                                                <div class="row">
                                                                    <input type="hidden" name="id" value="{{$teacher->id}}">
                                                                </div>
                                                               
                                                                <div class="modal-footer">
                                                                    <button class="btn ripple btn-danger" type="submit">{{trans('teacher.Delete')}}</button>
                                                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('teacher.Close')}}</button>
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
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
