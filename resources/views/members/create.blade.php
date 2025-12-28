@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Add Member</h1>

<form method="POST" action="{{ route('members.store') }}">
    @csrf

    Name: <input type="text" name="name"><br>
    Email: <input type="email" name="email"><br>
    Profession: <input type="text" name="profession"><br>
    Company: <input type="text" name="company"><br>
    LinkedIn: <input type="text" name="linkedin_url"><br>
    <label>Status:</label>
    <select name="status">
        <option value="active" selected>Active</option>
        <option value="inactive">Inactive</option>
    </select>
    <br><br>


    <button type="submit">Save</button>
</form>

<a href="{{ route('members.index') }}">Back to Members List</a>