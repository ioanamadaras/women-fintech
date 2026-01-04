@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Members</h1>
            <a href="{{ route('members.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Member
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Filter & Search</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" 
                               class="form-control" 
                               id="search" 
                               name="search"
                               placeholder="Search name or email"
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="profession" class="form-label">Profession</label>
                        <input type="text" 
                               class="form-control" 
                               id="profession" 
                               name="profession"
                               placeholder="Profession"
                               value="{{ request('profession') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="company" class="form-label">Company</label>
                        <input type="text" 
                               class="form-control" 
                               id="company" 
                               name="company"
                               placeholder="Company"
                               value="{{ request('company') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">All statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Export Button -->
        <div class="mb-3">
            <a href="{{ route('members.export', request()->query()) }}" class="btn btn-success btn-sm">
                Export CSV
            </a>
        </div>

        @if($members->count() > 0)
            <!-- Members Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Profession</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->profession }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <a href="{{ route('members.stories', $member) }}" class="btn btn-sm btn-outline-info">Stories</a>
                                                <form action="{{ route('members.destroy', $member) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this member?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $members->appends(request()->query())->links('pagination::simple-default') }}
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <strong>No members found</strong> - Nu există membri pentru criteriile selectate.
            </div>
        @endif
    </div>
</div>
@endsection
