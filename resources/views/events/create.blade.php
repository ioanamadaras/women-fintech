@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<h1>Add Event</h1>

<form method="POST" action="{{ route('events.store') }}">
    @csrf

    Name:<br>
    <input type="text" name="name"><br><br>

    Date:<br>
    <input type="date" name="event_date"><br><br>

    Description:<br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Save</button>
</form>

<a href="{{ route('events.index') }}">Back</a>
