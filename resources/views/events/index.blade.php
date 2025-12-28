<h1>Events</h1>

<a href="{{ route('events.create') }}">Add Event</a> 

<br><br>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form method="GET">
    <label>Filter:</label>
    <select name="filter" onchange="this.form.submit()">
        <option value="">All</option>
        <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>
            Upcoming
        </option>
        <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>
            Past
        </option>
    </select>
</form>

<br>

<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    @foreach($events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
            <td>{{ $event->description }}</td>
            <td>
                <a href="{{ route('events.edit', $event) }}">Edit</a>

                <form method="POST"
                      action="{{ route('events.destroy', $event) }}"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Delete this event?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<br>

<a href="{{ route('members.index') }}">⬅ Back to Members</a>

{{ $events->links() }}
