@extends('dashboard.layout.app')
@section('content')
    <div class="mt-4">
        <div class="custom-card shadow-sm border-0">
            @if ($errors->any())
                <div class="custom-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="custom-card-header d-flex justify-content-between align-items-center">
                <h4>New Multiple Game</h4>
                <a class="btn custom-btn-light btn-sm" href="{{ route('games') }}">Back</a>
            </div>
            <hr>
            <div class="card-body">
                <form id="gameForm" action="{{ route('multigame.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="link" class="form-label">Game Link</label>
                        <input type="text" class="form-control custom-input" id="link" name="gamelink"
                            placeholder="https://example.com/demo">
                    </div>

                    <div class="mb-3">
                        <label for="gametype" class="form-label">Game Type</label>
                        <select class="form-select custom-select" id="gametype" name="gametype">
                            <option value="" disabled selected>Select Type</option>
                            <option value="gamepix">GamePix</option>
                            <option value="distribution">Game Distribution</option>
                            <option value="monetize">Game Monetize</option>
                        </select>
                    </div>

                    <button type="submit" class="btn custom-btn-gradient">Add Game</button>
                </form>
            </div>
        </div>
    </div>
@endsection
    