@extends('layouts.master')
@section('css')

@section('title')
{{trans('menu.Promotions_Student')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('menu.Promotions_Student')}}</h4><br>
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
                            <form method="post" action="{{route('Promotions.store')}}">
                            @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('student.Grade_old')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('student.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class_id">{{trans('student.classrooms_old')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="class_id">
        
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('student.section_old')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
        
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="academic_year">{{trans('student.academic_year')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="academic_year">
                                                <option selected disabled>{{trans('student.Choose')}}...</option>
                                                @php
                                                    $current_year = date("Y");
                                                @endphp
                                                @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                    <option value="{{ $year}}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('student.Grade_new')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id_new">
                                                <option selected disabled>{{trans('student.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class_id">{{trans('student.classrooms_new')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="class_id_new">
        
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('student.section_new')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id_new">
        
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="academic_year">{{trans('student.academic_year_new')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="academic_year_new">
                                                <option selected disabled>{{trans('student.Choose')}}...</option>
                                                @php
                                                    $current_year = date("Y");
                                                @endphp
                                                @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                    <option value="{{ $year}}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('student.submit')}}</button>
                            </form>
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
