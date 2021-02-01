<ul class="pl-0">
    @forelse(app(\App\Repositories\NotificationRepository::class)->getForAdminPaginated(Auth::user()) as $notification)
        <li class="dropdown-item" id="notification-{{$notification->id}}">
            <a class="notification-link" data-notification-id="{{$notification->id}}">
                {{$notification->data['content'] ?? ''}}
            </a>
        </li>
    @empty
        <li>
            There is no notification
        </li>
    @endforelse
</ul>

@push('after-scripts')
    <script !src="">
        $(function () {
            $('.notification-link').click(function (event) {
                event.preventDefault();
                $.ajax({
                    url: '/notification/'+$(this).data('notificationId'),
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(function (response) {
                    if (response.link) {
                        window.location.href = response.link;
                    }
                })
            })
        })
    </script>
@endpush
