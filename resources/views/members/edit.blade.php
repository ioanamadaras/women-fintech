@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Edit Member</h1>

<form method="POST" action="{{ route('members.update', $member) }}">
    @csrf
    @method('PUT')

    Name: <input type="text" name="name" value="{{ $member->name }}"><br>
    Email: <input type="email" name="email" value="{{ $member->email }}"><br>
    Profession: <input type="text" name="profession" value="{{ $member->profession }}"><br>
    Company: <input type="text" name="company" value="{{ $member->company }}"><br>
    LinkedIn: <input type="text" name="linkedin_url" value="{{ $member->linkedin_url }}"><br>
    <label>Status:</label>
    <select name="status">
        <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
    <br><br>
    <button type="submit">Update</button>
</form>

<a href="{{ route('members.index') }}">Back to Members List</a>