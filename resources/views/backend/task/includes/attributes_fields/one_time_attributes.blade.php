<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.one_time_attributes.start_date'))->class('col-md-2 form-control-label')->for('one_time_start_date') }}
    <div class="col-md-10">
        {{html()->text('one_time_start_date')->class('form-control')->value(
            old('one_time_start_date') ??
            (($task->task_attributes && $task->task_attributes->start_date) ? $task->task_attributes->start_date->format('Y-m-d') : null)
        )}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.one_time_attributes.start_time'))->class('col-md-2 form-control-label')->for('one_time_start_time') }}
    <div class="col-md-10">
        {{html()->text('one_time_start_time')->attribute('pattern', '([01]?[0-9]|2[0-3]):[0-5][0-9]')->class('form-control')->value(
            old('one_time_start_time') ??
            (($task->task_attributes && $task->task_attributes->start_time) ? \Carbon\Carbon::createFromFormat('H:i:s', $task->task_attributes->start_time)->format('H:i') : null)
        )}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.one_time_attributes.end_time'))->class('col-md-2 form-control-label')->for('one_time_end_time') }}
    <div class="col-md-10">
        {{html()->text('one_time_end_time')->attribute('pattern', '([01]?[0-9]|2[0-3]):[0-5][0-9]')->class('form-control')->value(
            old('one_time_end_time') ??
            (($task->task_attributes && $task->task_attributes->end_time) ? \Carbon\Carbon::createFromFormat('H:i:s', $task->task_attributes->end_time)->format('H:i') : null)
        )}}
    </div>
</div>

@push('after-scripts')
    <script !src="">
        $(function () {
            $('#one_time_start_date').datepicker({
                dateFormat: "yy-mm-dd"
            });
        })
    </script>
@endpush
