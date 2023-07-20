@extends('layouts.master')
@section('css')
   
@section('title')
    {{trans('student.List_Students')}}
@stop
@endsection
@section('page-header')
 
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                   {{trans('student.rollback')}}
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('student.name')}}</th>
                                            <th>{{trans('student.Grade_old')}}</th>
                                            <th>{{trans('student.classrooms_old')}}</th>
                                            <th>{{trans('student.section_old')}}</th>
                                            <th>{{trans('student.academic_year')}}</th>
                                            <th>{{trans('student.Grade_new')}}</th>
                                            <th>{{trans('student.classrooms_new')}}</th>
                                            <th>{{trans('student.section_new')}}</th>
                                            <th>{{trans('student.academic_year_new')}}</th>
                                            <th>{{trans('student.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->name}}</td>
                                                <td>{{$promotion->f_classroom->name}}</td>
                                                <td>{{$promotion->f_section->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->t_grade->name}}</td>
                                                <td>{{$promotion->t_classroom->name}}</td>
                                                <td>{{$promotion->t_section->name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{trans('student.rollback_one')}}</button>
                                                    {{-- <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button> --}}
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="Delete_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('student.rollback')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('Promotions.destroy','test')}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                            
                                                                <input type="hidden" name="page_id" value="1">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('message.confirm_rollback')}}</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Grades.Close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('student.submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="Delete_one{{$promotion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('student.rollback_one')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('Promotions.destroy','test')}}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                            
                                                                <input type="hidden" name="id" value="{{$promotion->id}}">
                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('message.rollback_one')}}</h5>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Grades.Close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('student.submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection