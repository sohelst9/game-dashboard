@extends('dashboard.layout.app')
@section('content')
    <!-- Game Table -->
    <div class="mt-4">
        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>All Games</h4>
                <a class="btn btn-sm btn-success" href="{{ route('games.create') }}">New Game</a>
                <a class="btn btn-sm btn-info" href="{{ route('multigames.create') }}">Multiple Game Upload</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Game Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($games as $key => $game)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $game->name }}</td>
                                <td>
                                    <img src="{{ asset($game->image) }}" alt="" width="100">
                                </td>
                                <td>
                                    @foreach (explode(',', $game->category) as $category)
                                        <a class="btn btn-sm btn-primary">{{ trim($category) }}</a>
                                    @endforeach
                                </td>

                                <td>
                                    @if ($game->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary">Edit</a>
                                    <a class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
