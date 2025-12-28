<h1>Edit Event</h1>

<form method="POST" action="{{ route('events.update', $event) }}">
    @csrf
    @method('PUT')

    Name:<br>
    <input type="text" name="name" value="{{ $event->name }}"><br><br>

    Date:<br>
    <input type="date" name="event_date" value="{{ $event->event_date }}"><br><br>

    Description:<br>
    <textarea name="description">{{ $event->description }}</textarea><br><br>
    
    <button type="submit">Update</button>
</form>

<a href="{{ route('events.index') }}">Back</a>
