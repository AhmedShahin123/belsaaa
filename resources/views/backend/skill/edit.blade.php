@extends('backend.layouts.app')

@section('title', __('labels.backend.skill.management') . ' | ' . __('labels.backend.skill.edit'))

@section('content')
{{ html()->modelForm($skill, 'PATCH', route('admin.skill.update', $skill->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.skill.management')
                        <small class="text-muted">@lang('labels.backend.skill.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.skill.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.skill.name'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.skill.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div>
{{ html()->closeModelForm() }}
@endsection

