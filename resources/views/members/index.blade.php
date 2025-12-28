<h1>Members</h1>

<br><br>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<form method="GET">
    <input type="text" name="search"
           placeholder="Search name or email"
           value="{{ request('search') }}">

    <input type="text" name="profession"
           placeholder="Profession"
           value="{{ request('profession') }}">

    <input type="text" name="company"
           placeholder="Company"
           value="{{ request('company') }}">

    <select name="status">
        <option value="">All statuses</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    <button type="submit">Filter</button>
</form>

<br>

@if($members->count() > 0)

<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Profession</th>
        <th>Actions</th>
    </tr>

    @foreach($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->profession }}</td>
            <td>

                <a href="{{ route('members.create') }}">Add Member</a>
                <a href="{{ route('members.edit', $member) }}">Edit</a>
                <a href="{{ route('members.stories', $member) }}">Stories</a>

                <form action="{{ route('members.destroy', $member) }}"
                      method="POST"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Delete?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@else
    <p><strong>Nu există membri pentru criteriile selectate.</strong></p>
@endif


<br>
<a href="{{ route('success-stories.index') }}">Stories</a>
<br>
<a href="{{ route('events.index') }}">Events</a> 
<br>
<a href="{{ route('members.export', request()->query()) }}">
    Export CSV
</a>


{{ $members->appends(request()->query())->links('pagination::simple-default') }}

