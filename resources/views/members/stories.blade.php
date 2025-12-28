<h1>Success Stories – {{ $member->name }}</h1>

@if($stories->count() > 0)
<table border="1">
    <tr>
        <th>Title</th>
        <th>Story</th>
    </tr>

    @foreach($stories as $story)
        <tr>
            <td>{{ $story->title }}</td>
            <td>{{ $story->story }}</td>
        </tr>
    @endforeach
</table>
@else
    <p style="color: red;">Acest membru nu are povești de succes!</p>
@endif

<br>
<a href="{{ route('members.index') }}">⬅ Back to Members</a>
