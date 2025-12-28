<h1>Success Stories</h1>

<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>Member</th>
        <th>Title</th>
        <th>Story</th>
        <th>Actions</th>
    </tr>

    @foreach($stories as $story)
        <tr>
            <td>{{ $story->member->name }}</td>
            <td>{{ $story->title }}</td>
            <td>{{ $story->story }}</td>
            <td>
                <a href="{{ route('success-stories.create') }}">Add Story</a> 
                <a href="{{ route('success-stories.edit', $story) }}">Edit</a>

                <form method="POST"
                      action="{{ route('success-stories.destroy', $story) }}"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Delete this story?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<br>
<a href="{{ route('members.index') }}">⬅ Back to Members</a>
