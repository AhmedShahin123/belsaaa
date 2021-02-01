

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.active'))->class('col-md-2 form-control-label')->for('active') }}

    <div class="col-md-10">
        {{ html()->select('active')->options(['0' => 'No', '1' => 'Yes'])->value(old('active', $task->active ? '1' : '0'))
            ->class('form-control') }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.title'))->class('col-md-2 form-control-label')->for('title') }}

    <div class="col-md-10">
        {{ html()->text('title')
            ->class('form-control')
            ->placeholder(__('validation.attributes.backend.task.title'))
            ->attribute('maxlength', 191)
            ->required() }}
    </div><!--col-->
</div><!--form-group-->

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.description'))->class('col-md-2 form-control-label')->for('description') }}
    <div class="col-md-10">
        {{ html()->textarea('description')->class('form-control')->required() }}
    </div>
</div>

@if($task->id)
<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.task_type'))->class('col-md-2 form-control-label')->for('task_type') }}
    <div class="col-md-10">
        {{html()->text('task_type')->value(\Str::studly($task->task_type))->class('form-control')->disabled()}}
    </div>
</div>
@else
    {{html()->hidden('task_type')->value(request()->query('task_type'))}}
@endif

@if($task->id)
<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.status'))->class('col-md-2 form-control-label')->for('status') }}
    <div class="col-md-10">
        {{html()->text('status')->value(\Str::studly($task->status))->class('form-control')->disabled()}}
    </div>
</div>
@endif

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.city'))->class('col-md-2 form-control-label')->for('city_id') }}
    <div class="col-md-10">
        {{html()->hidden('latitude')->id('task-latitude')}}
        {{html()->hidden('longitude')->id('task-longitude')}}
        <task-location :enable-selection="true" latitude-field-id="task-latitude" longitude-field-id="task-longitude" :point="{latitude: {{$task->latitude ?? 26.4207}}, longitude:{{$task->longitude ?? 50.0888}}}"></task-location>
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.employer'))->class('col-md-2 form-control-label')->for('employer_id') }}
    <div class="col-md-10">
        {{html()
            ->select('employer_id', $task->employer ? [$task->employer_id => $task->employer->name] : (old('employer_id') ? [old('employer_id') => \App\Models\Auth\User::find(old('employer_id'))->name] : []) )
            ->id('task-employer')
            ->class('form-control')
            ->attribute($task->employer ? 'disabled' : null, $task->employer ? 'disabled' : null)
        }}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.hour_rate'))->class('col-md-2 form-control-label')->for('hour_rate') }}
    <div class="col-md-10">
        {{html()->number('hour_rate')->attribute('min', 0)->class('form-control')}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.required_tasker_number'))->class('col-md-2 form-control-label')->for('required_tasker_number') }}
    <div class="col-md-10">
        {{html()->number('required_tasker_number')->attribute('min', 0)->class('form-control')}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.required_tasker_gender'))->class('col-md-2 form-control-label')->for('required_tasker_gender') }}
    <div class="col-md-10">
        {{html()->select('required_tasker_gender', [
            'male' => __('validation.attributes.backend.task.required_tasker_gender_male'),
            'female' => __('validation.attributes.backend.task.required_tasker_gender_female'),
        ])->class('form-control')}}
    </div>
</div>


@include("backend.task.includes.attributes_fields.{$task->task_type}_attributes")

@push('after-scripts')
    <script !src="">
        $(function () {
            if (!$('#task-employer').attr('disabled')) {
                $('#task-employer').select2({
                    ajax: {
                        url: '/employer?active_employers=1',
                        headers: {
                            'Accept': 'application/json',
                        },
                        processResults: function (data) {
                            // Transforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: $.map(data.data, function (value, index) {
                                    return {id: value.id, text: value.company_name !== null ? value.company_name : (value.first_name + ' ' + value.last_name)};
                                })
                            };
                        }
                    }
                });
            }
        });
    </script>
@endpush
