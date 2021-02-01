@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.setting.management'))

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.settings.index') !!}
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.settings.management') }}
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    @include('app_settings::_settings')
                </div><!--col-->
            </div><!--row-->
        </div>
    </div>
@endsection
