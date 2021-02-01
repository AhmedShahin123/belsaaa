<div class="col">
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
        <tr>
            <th>{{ __('labels.backend.access.users.table.id') }}</th>
            <th>{{ __('labels.backend.access.users.table.first_name') }}</th>
            <th>{{ __('labels.backend.access.users.table.last_name') }}</th>
            <th>{{ __('labels.backend.access.users.table.email') }}</th>
            <th>{{ __('labels.backend.access.users.table.cellphone') }}</th>
        </tr>
        </thead>
        <tbody>
            @forelse($task->employer_accepted_requests as $request)
            <tr>
                <td scope="row">{{$request->tasker->id}}</td>
                <td scope="row">{{$request->tasker->first_name}}</td>
                <td scope="row">{{$request->tasker->last_name}}</td>
                <td scope="row">{{$request->tasker->email}}</td>
                <td scope="row">{{$request->tasker->cellphone}}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="5">{{ __('labels.backend.task.tabs.content.assigned_taskers.empty') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
