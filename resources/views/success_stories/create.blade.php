@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Add Success Story</h1>

<form method="POST" action="{{ route('success-stories.store') }}">
    @csrf

    Member:
    <select name="member_id">
        @foreach($members as $member)
            <option value="{{ $member->id }}">{{ $member->name }}</option>
        @endforeach
    </select><br><br>

    Title: <input type="text" name="title"><br><br>

    Story:<br>
    <textarea name="story"></textarea><br><br>

    <button type="submit">Save</button>
</form>

<a href="{{ route('success-stories.index') }}">Back</a>
