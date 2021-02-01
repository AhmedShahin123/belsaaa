@extends('backend.layouts.app')

@section('title', __('labels.backend.contact_category.management') . ' | ' . __('labels.backend.contact_category.edit'))

@section('content')
{{ html()->modelForm($contactCategory, 'PATCH', route('admin.contact_category.update', $contactCategory->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.contact_category.management')
                        <small class="text-muted">@lang('labels.backend.contact_category.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.contact_category.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.contact_category.name'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.contact_category.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div>
{{ html()->closeModelForm() }}
@endsection

