<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.continued_attributes.start_date'))->class('col-md-2 form-control-label')->for('continued_start_date') }}
    <div class="col-md-10">
        {{html()->text('continued_start_date')->class('form-control')->value(
            old('continued_start_date') ??
            (($task->task_attributes && $task->task_attributes->start_at) ? $task->task_attributes->start_at->format('Y-m-d') : null)
        )}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.continued_attributes.start_time'))->class('col-md-2 form-control-label')->for('continued_start_time') }}
    <div class="col-md-10">
        {{html()->time('continued_start_time')->class('form-control')->value(
            old('continued_start_time') ??
            (($task->task_attributes && $task->task_attributes->start_at) ? $task->task_attributes->start_at->format('H:i:s') : null)
        )}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.continued_attributes.daily_duration'))->class('col-md-2 form-control-label')->for('continued_daily_duration') }}
    <div class="col-md-10">
        {{html()->number('continued_daily_duration')->attribute('min', 0)->class('form-control')->value(
            old('continued_daily_duration') ??
            ($task->task_attributes ? $task->task_attributes->daily_duration : null)
        )}}
    </div>
</div>



<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.continued_attributes.end_date'))->class('col-md-2 form-control-label')->for('continued_end_date') }}
    <div class="col-md-10">
        {{html()->text('continued_end_date')->class('form-control')->value(
            old('continued_end_date') ??
            (($task->task_attributes && $task->task_attributes->end_date) ? $task->task_attributes->end_date->format('Y-m-d') : null)
        )}}
    </div>
</div>

@push('after-scripts')
    <script !src="">
        $(function () {
            $('#continued_start_date').datepicker({
                dateFormat: "yy-mm-dd"
            });
            $('#continued_end_date').datepicker({
                dateFormat: "yy-mm-dd"
            });
        })
    </script>
@endpush
