@extends('layouts.master')
@section('css')
{{-- <livewire:styles /> --}}

@section('title')
{{ trans('my_parent.My_Parents') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('my_parent.add_my_parent') }}</h4>
        </div>
       
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:add-parent />
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
<livewire:scripts />

@endsection
