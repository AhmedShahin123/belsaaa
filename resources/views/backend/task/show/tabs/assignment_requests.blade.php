<table class="table table-striped table-inverse">
    <thead class="thead-inverse">
    <tr>
        <th>@lang('labels.backend.task.tabs.content.assignment_requests.table.created_at')</th>
        <th>@lang('labels.backend.task.tabs.content.assignment_requests.table.status')</th>
        <th>@lang('labels.backend.task.tabs.content.assignment_requests.table.taskers')</th>

    </tr>
    </thead>
    <tbody>
    @forelse($task->assignment_request_taskers as $assignment_request_tasker)
        <tr>
            <td scope="row">{{ timezone()->convertToLocal($assignment_request_tasker->created_at) }} ({{ $assignment_request_tasker->created_at->diffForHumans() }})</td>
            <td>{{$assignment_request_tasker->status}}</td>
            <td>
                {{$assignment_request_tasker->tasker->name}} ({{$assignment_request_tasker->status}})
            </td>
        </tr>

    @empty
        <tr>
            <td scope="row" colspan="">@lang('labels.general.empty')</td>
        </tr>
    @endforelse
    </tbody>
</table>

<div class="row mt-4">
    @if(empty($taskers) || !$manualAssignment)
        @if(!$manualAssignment)
            <div class="col">Task is not open for assignment.</div>
        @else
            <div class="col">No available tasker for manual assignment</div>
        @endif
    @else
    <div class="col">
        {{html()->form('POST', route('admin.backend.task.assign', ['task' => $task]))->class('form-inline')->open()}}

        <div class="form-group mx-sm-3 mb-2">
            {{html()
                ->select('tasker_id')
                ->class('form-control')
                ->options($taskers)
            }}
        </div>

        <button type="submit" class="btn btn-primary mb-2">Assign</button>
        {{html()->closeModelForm()}}

    </div>
    @endif
</div>

