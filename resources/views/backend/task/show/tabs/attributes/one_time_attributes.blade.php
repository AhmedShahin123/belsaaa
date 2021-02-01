<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>{{ __('labels.backend.task.tabs.content.task_attributes.start_at') }}</th>
                <td>{{ $task->task_attributes->start_date->format('Y-m-d') }}</td>
            </tr>

            <tr>
                <th>{{ __('labels.backend.task.tabs.content.task_attributes.start_time') }}</th>
                <td>{{ Carbon\Carbon::createFromTimeString($task->task_attributes->start_time)->setTimezone('Asia/Riyadh')->format('H:i') }}</td>
            </tr>
            <tr>
                <th>{{ __('labels.backend.task.tabs.content.task_attributes.end_time') }}</th>
                <td>{{ Carbon\Carbon::createFromTimeString($task->task_attributes->end_time)->setTimezone('Asia/Riyadh')->format('H:i') }}</td>
            </tr>
        </table>
    </div>
</div>
