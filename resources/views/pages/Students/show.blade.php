@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('student.details') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('student.details') }}</h4>
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
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                   role="tab" aria-controls="home-02"
                                   aria-selected="true">{{trans('student.details')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                   role="tab" aria-controls="profile-02"
                                   aria-selected="false">{{trans('student.Attachments')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                 aria-labelledby="home-02-tab">
                                <table class="table table-striped table-hover" style="text-align:center">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{trans('student.name')}}</th>
                                        <td>{{ $students->name }}</td>
                                        <th scope="row">{{trans('student.email')}}</th>
                                        <td>{{$students->email}}</td>
                                        <th scope="row">{{trans('student.Gender')}}</th>
                                        <td>{{$students->gender->name}}</td>
                                        <th scope="row">{{trans('student.Nationality')}}</th>
                                        <td>{{$students->nationality->name}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{trans('student.Grade')}}</th>
                                        <td>{{ $students->grade->name }}</td>
                                        <th scope="row">{{trans('student.classrooms')}}</th>
                                        <td>{{$students->classroom->name}}</td>
                                        <th scope="row">{{trans('student.section')}}</th>
                                        <td>{{$students->section->name}}</td>
                                        <th scope="row">{{trans('student.Date_of_Birth')}}</th>
                                        <td>{{ $students->birth_date}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{trans('student.parent')}}</th>
                                        <td>{{ $students->parent->father_name}}</td>
                                        <th scope="row">{{trans('student.academic_year')}}</th>
                                        <td>{{ $students->academic_year }}</td>
                                        <th scope="row"></th>
                                        <td></td>
                                        <th scope="row"></th>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('Upload_attachment')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="academic_year">{{trans('student.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="student_name" value="{{$students->name}}">
                                                        <input type="hidden" name="student_id" value="{{$students->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('student.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('student.filename')}}</th>
                                                <th scope="col">{{trans('student.created_at')}}</th>
                                                <th scope="col">{{trans('student.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->file_name}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{url('Download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->file_name}}"
                                                           role="button"><i class="fa fa-download"></i>&nbsp; {{trans('student.Download')}}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $attachment->id }}"
                                                                title="{{ trans('Grades.Delete') }}">{{trans('Grades.Delete')}}
                                                        </button>

                                                    </td>
                                                </tr>
                                                 <!-- Delete -->
                                                <div class="modal" id="Delete_img{{ $attachment->id }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content modal-content-demo">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title">{{ trans('student.Delete_attachment') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="{{route('Delete_attachment')}}">
                                                                   @csrf
                                                                    <h6>{{trans('message.confirm')}}</h6>
                                                                    <div class="row">
                                                                        <input type="hidden" name="id" value="{{$attachment->id}}">
                                                                        <input type="hidden" name="student_name" value="{{ $attachment->imageable->name }}">
                                                                        <input type="hidden" name="student_id" value="{{ $attachment->imageable->id }}">
                                                                        <input type="hidden" name="file_name" value="{{$attachment->file_name}}">
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
@endsection

@section('js')

@endsection
