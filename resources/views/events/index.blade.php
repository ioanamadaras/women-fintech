@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Events</h1>
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                Add Event
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
                <h5 class="card-title mb-0">Filter Events</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="filter" class="form-label">Filter:</label>
                        <select class="form-select" id="filter" name="filter" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="upcoming" {{ request('filter') == 'upcoming' ? 'selected' : '' }}>
                                Upcoming
                            </option>
                            <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>
                                Past
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        @if($events->count() > 0)
            <!-- Events Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td><strong>{{ $event->name }}</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form method="POST"
                                                      action="{{ route('events.destroy', $event) }}"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this event?');">
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
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <strong>No events found</strong> - No events match your filter criteria.
            </div>
        @endif
    </div>
</div>
@endsection
