@extends('layouts.app') {{-- You can change 'layouts.app' to your actual layout name --}}

@section('content')
<div class="container mt-5">
    <h1>Notifications</h1>
    @if ($notifications->count() === 0)
    <p>You have no notifications.</p>
    @endif
    <ul class="list-group">
        @foreach ($notifications as $notification)
        <li class="list-group-item {{ $notification->read_at ? 'read' : 'unread' }}" data-notification-id="{{ $notification->id }}" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                @if ($notification->notifiable_type === 'question')
                <strong>{{ $notification->sender->name }}</strong> answered a question: "{{ $notification->notifiable->title }}"
                @elseif ($notification->notifiable_type === 'answer')
                <strong>{{ $notification->sender->name }}</strong> commented on an answer
                @endif
                <div class="notification-body">
                    {{ $notification->data }}
                </div>
                <div class="notification-time">
                    {{ $notification->created_at->diffForHumans() }}
                </div>
            </div>
            <a href="{{ route('question_detail', ['question_id' => $notification->notifiable_id]) }}" class="btn btn-primary">View Question</a>
            <form method="POST" action="{{ route('notifications.markAsRead', $notification) }}">
                @csrf
                @method('POST')
                @if ($notification->read_at)
                <button type="button" class="btn btn-danger" disabled>Already Read</button>
                @else
                <button type="submit" class="btn btn-success">Mark as Read</button>
                @endif
            </form>

        </li>
        @endforeach
    </ul>
</div>

<script>
    $(document).ready(function() {
        $('li.list-group-item.unread').click(function() {
            var notificationId = $(this).data('notification-id');
            window.location.href = '/notifications/markAsRead/' + notificationId;
        });
    });
</script>
@endsection
