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
                <h4>New Game</h4>
                <a class="btn custom-btn-light btn-sm" href="{{ route('games') }}">Back</a>
            </div>
            <hr>
            <div class="card-body">
                <form id="gameForm" action="{{ route('game.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="gameName" class="form-label">Game Name</label>
                        <input type="text" class="form-control custom-input" id="gameName" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Game Link</label>
                        <input type="text" class="form-control custom-input" id="link" name="link"
                            placeholder="https://example.com/game-name">
                    </div>

                    <div class="mb-3">
                        <label for="imagelink" class="form-label">Game Image Link</label>
                        <input type="text" class="form-control custom-input" id="imagelink" name="imagelink"
                            placeholder="https://example.com/image">
                    </div>

                    <div class="mb-3">
                        <label for="gameCategory" class="form-label">Game Category</label>
                        <select class="form-select custom-select" id="gameCategory" name="gameCategory">
                            <option value="" disabled selected>Select Category</option>
                            <option value="action">Action</option>
                            <option value="adventure">Adventure</option>
                            <option value="puzzle">Puzzle</option>
                            <option value="sports">Sports</option>
                            <option value="strategy">Strategy</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="gameStatus" class="form-label">Game Status</label>
                        <select class="form-select custom-select" id="gameStatus" name="gameStatus">
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control custom-textarea" id="description" name="description" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="gameImage" class="form-label">Upload Game Image</label>
                        <input type="file" class="form-control custom-input" id="gameImage" name="image"
                            accept="image/*" onchange="previewImage(event)">

                    </div>

                    <div class="mb-3" id="imagePreviewContainer" style="display: none;">
                        <img id="customImagePreview" class="img-fluid rounded shadow" alt="Image Preview">
                    </div>

                    <button type="submit" class="btn custom-btn-gradient">Add Game</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const customImagePreview = document.getElementById('customImagePreview');

            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                customImagePreview.src = e.target.result;
                imagePreviewContainer.style.display = 'block'; // Show the preview container
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.style.display = 'none'; // Hide the preview if no file
            }
        }
    </script>
@endsection
