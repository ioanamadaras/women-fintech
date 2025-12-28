<h1>Edit Success Story</h1>

<form method="POST" action="{{ route('success-stories.update', $successStory) }}">
    @csrf
    @method('PUT')

    Title:
    <input type="text" name="title" value="{{ $successStory->title }}"><br><br>

    Story:<br>
    <textarea name="story">{{ $successStory->story }}</textarea><br><br>

    Member:
    <select name="member_id">
        @foreach($members as $member)
            <option value="{{ $member->id }}"
                {{ $member->id == $successStory->member_id ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('success-stories.index') }}">Back</a>
