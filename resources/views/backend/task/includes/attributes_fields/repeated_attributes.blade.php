{{--<div class="form-group row">--}}
{{--    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.start_date'))->class('col-md-2 form-control-label')->for('repeated_start_date') }}--}}
{{--    <div class="col-md-10">--}}
{{--        {{html()->text('repeated_start_date')->class('form-control')->value(--}}
{{--            old('repeated_start_date') ??--}}
{{--            (($task->task_attributes && $task->task_attributes->start_date) ? $task->task_attributes->start_date->format('Y-m-d') : null)--}}
{{--        )}}--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.end_date'))->class('col-md-2 form-control-label')->for('repeated_end_date') }}--}}
{{--    <div class="col-md-10">--}}
{{--        {{html()->text('repeated_end_date')->class('form-control')->value(--}}
{{--            old('repeated_end_date') ??--}}
{{--            (($task->task_attributes && $task->task_attributes->end_date) ? $task->task_attributes->end_date->format('Y-m-d') : null)--}}
{{--        )}}--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group row repeated-days" id="repeated-days-sunday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.sunday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[0][weekday]')->class('repeated-days-field')->value('sunday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[0][enabled]', old('repeated_days.0.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[0][start_time]')->class('form-control repeated-days-field')->value(old('repeated_days.0.start_time') ?? null)->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[0][end_time]')->class('form-control repeated-days-field')->value(old('repeated_days.0.end_time') ?? null)->disabled()}}
    </div>
</div>

<div class="form-group row repeated-days" id="repeated-days-monday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.monday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[1][weekday]')->class('repeated-days-field')->value('monday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[1][enabled]', old('repeated_days.1.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[1][start_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[1][end_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
</div>

<div class="form-group row repeated-days" id="repeated-days-tuesday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.tuesday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[2][weekday]')->class('repeated-days-field')->value('tuesday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[2][enabled]', old('repeated_days.2.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[2][start_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[2][end_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
</div>

<div class="form-group row repeated-days" id="repeated-days-wednesday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.wednesday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[3][weekday]')->class('repeated-days-field')->value('wednesday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[3][enabled]', old('repeated_days.3.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[3][start_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[3][end_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
</div>

<div class="form-group row repeated-days" id="repeated-days-thursday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.thursday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[4][weekday]')->class('repeated-days-field')->value('thursday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[4][enabled]', old('repeated_days.4.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[4][start_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[4][end_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
</div>

<div class="form-group row repeated-days" id="repeated-days-friday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.friday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[5][weekday]')->class('repeated-days-field')->value('friday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[5][enabled]', old('repeated_days.5.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[5][start_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[5][end_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
</div>

<div class="form-group row repeated-days" id="repeated-days-saturday">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.saturday'))->class('col-md-2 form-control-label') }}
    {{ html()->hidden('repeated_days[6][weekday]')->class('repeated-days-field')->value('saturday')->disabled() }}
    <div class="col-md-2">
        {{ html()->checkbox('repeated_days[6][enabled]', old('repeated_days.6.enabled') ? true : false)->class('form-control repeated-days-enable') }}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.from'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[6][start_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.days.to'))->class('col-md-2 form-control-label') }}
    <div class="col-md-2">
        {{html()->text('repeated_days[6][end_time]')->class('form-control repeated-days-field')->disabled()}}
    </div>
</div>

<div class="form-group row">
    {{ html()->label(__('validation.attributes.backend.task.repeated_attributes.repeat'))->class('col-md-2 form-control-label')->for('repeated_repeat') }}

    <div class="col-md-10">
        {{ html()->select('repeated_repeat')
            ->options(['0' => 'No', '1' => 'Yes'])
            ->value(old('repeated_repeat', $task->task_attributes && $task->task_attributes->repeat))
            ->class('form-control') }}
    </div><!--col-->
</div><!--form-group-->

@push('after-scripts')
    <script !src="">
        $(function(){
            $('.repeated-days-enable').each(function (index, item) {
                if ($(item)[0].checked) {
                    $(item).closest('.repeated-days').find('.repeated-days-field').removeAttr('disabled').removeProp('required')
                } else {
                    $(item).closest('.repeated-days').find('.repeated-days-field').attr('disabled', 'disabled').prop('required', true)
                }
            });


            $('.repeated-days-enable').change(function() {
                if(this.checked) {
                    console.log(this.checked);
                    console.log($(this).closest('.repeated-days'));
                    $(this).closest('.repeated-days').find('.repeated-days-field').removeAttr('disabled').removeProp('required')
                } else {
                    $(this).closest('.repeated-days').find('.repeated-days-field').attr('disabled', 'disabled').prop('required', true)
                }

            });

            $('#repeated_start_date').datepicker({
                dateFormat: "yy-mm-dd"
            });
            $('#repeated_end_date').datepicker({
                dateFormat: "yy-mm-dd"
            });
        })
    </script>

@endpush
