@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('student.List_Students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('student.List_Students')}}</h4>
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
                            <a href="{{route('Students.create')}}" class="btn btn-success btn-sm" role="button"
                               aria-pressed="true">{{ trans('student.create') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('student.name')}}</th>
                                            <th>{{trans('student.email')}}</th>
                                            <th>{{trans('student.Gender')}}</th>
                                            <th>{{trans('student.Grade')}}</th>
                                            <th>{{trans('student.classrooms')}}</th>
                                            <th>{{trans('student.section')}}</th>
                                            <th>{{trans('student.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                          $i = 0;  
                                        @endphp
                                        @foreach ($students as $student)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>
                                                    <a href="{{route('Students.edit',$student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button  class="btn btn-danger btn-sm" data-target="#delete{{$student->id}}" data-toggle="modal" aria-pressed="true"><i class="fa fa-trash"></i></button>
                                                    <a href="{{route('Students.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                             <!-- Delete -->
                                            <div class="modal" id="delete{{$student->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content modal-content-demo">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">{{ trans('student.Delete') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('Students.destroy','test')}}">
                                                                @method('delete')
                                                                @csrf
                                                                <h6>{{trans('message.confirm')}}</h6>
                                                                <div class="row">
                                                                    <input type="hidden" name="id" value="{{$student->id}}">
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
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
