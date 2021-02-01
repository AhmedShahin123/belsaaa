@extends('backend.layouts.app')

@section('title', __('labels.backend.task.management') . ' | ' . __('labels.backend.task.create'))

@section('content')
    {{ html()->modelForm($task, 'POST', route('admin.task.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.task.management')
                        <small class="text-muted">@lang('labels.backend.task.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    @include('backend.task.includes.fields')
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.task.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div>
    {{ html()->closeModelForm() }}
@endsection

