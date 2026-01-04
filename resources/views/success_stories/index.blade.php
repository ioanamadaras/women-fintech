@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Success Stories</h1>
            <a href="{{ route('success-stories.create') }}" class="btn btn-primary">
                Add Story
            </a>
        </div>

        @if($stories->count() > 0)
            <!-- Stories Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Member</th>
                                    <th>Title</th>
                                    <th>Story</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stories as $story)
                                    <tr>
                                        <td><strong>{{ $story->member->name }}</strong></td>
                                        <td><strong>{{ $story->title }}</strong></td>
                                        <td>{{ Str::limit($story->story, 100) }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('success-stories.edit', $story) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form method="POST"
                                                      action="{{ route('success-stories.destroy', $story) }}"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this story?');">
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
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <strong>No success stories found</strong> - No success stories available yet.
            </div>
        @endif
    </div>
</div>
@endsection
