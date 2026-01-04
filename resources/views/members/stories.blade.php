@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Success Stories – {{ $member->name }}</h1>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">
                ← Back to Members
            </a>
        </div>

        @if($stories->count() > 0)
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Story</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stories as $story)
                                    <tr>
                                        <td><strong>{{ $story->title }}</strong></td>
                                        <td>{{ $story->story }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                <strong>No success stories found</strong> - Acest membru nu are povești de succes!
            </div>
        @endif
    </div>
</div>
@endsection
