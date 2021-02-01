<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.task.tabs.content.task_attributes.start_date')</th>
                <td>{{ $task->task_attributes->start_date }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.task.tabs.content.task_attributes.end_date')</th>
                <td>{{ $task->task_attributes->end_date }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="col">
    <h3>Days</h3>
    <ul>
    @foreach($task->task_attributes->days as $day)
            <li>
                Date: {{$day->date}} - Weekday: {{$day->weekday}} - Start Time: {{$day->start_time}} - End Time: {{$day->end_time}}
            </li>
    @endforeach
    </ul>
</div>
