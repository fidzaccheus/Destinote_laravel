<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Edit Destination - Destinote</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #D2D4D8;">
        <div class="container-fluid px-5">
            <a class="navbar-brand fw-bold fs-3" href="{{ route('home') }}">
                <img src="{{ asset('images/destinote_logo.png') }}" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Destinote
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto fs-5">
                    <li class="nav-item"><a class="nav-link text-black px-3" href="{{ route('destinations.index') }}">My
                            Destinations</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-3"
                            href="{{ route('profile.edit') }}">Profile</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3 pe-5">
                    <span class="text-black fw-semibold">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-5"
        style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Header -->
                    <div class="mb-4">
                        <h1 class="display-5 fw-bold mb-2">
                            <i class="bi bi-pencil-square text-warning"></i> Edit Destination
                        </h1>
                        <p class="text-muted">Update the details of {{ $destination->destination_name }}</p>
                    </div>

                    <!-- Form Card -->
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <form action="{{ route('destinations.update', $destination) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Destination Name -->
                                <div class="mb-4">
                                    <label for="destination_name" class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt-fill text-info"></i> Destination Name *
                                    </label>
                                    <input type="text" name="destination_name" id="destination_name"
                                        value="{{ old('destination_name', $destination->destination_name) }}"
                                        class="form-control form-control-lg @error('destination_name') is-invalid @enderror"
                                        required>
                                    @error('destination_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Country and City -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="country" class="form-label fw-semibold">
                                            <i class="bi bi-flag-fill text-primary"></i> Country *
                                        </label>
                                        <input type="text" name="country" id="country"
                                            value="{{ old('country', $destination->country) }}"
                                            class="form-control @error('country') is-invalid @enderror" required>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city" class="form-label fw-semibold">
                                            <i class="bi bi-building text-secondary"></i> City
                                        </label>
                                        <input type="text" name="city" id="city"
                                            value="{{ old('city', $destination->city) }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-semibold">
                                        <i class="bi bi-card-text text-info"></i> Description
                                    </label>
                                    <textarea name="description" id="description" rows="4"
                                        class="form-control">{{ old('description', $destination->description) }}</textarea>
                                </div>

                                <!-- Travel Date and Budget -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="travel_date" class="form-label fw-semibold">
                                            <i class="bi bi-calendar-event text-warning"></i> Travel Date
                                        </label>
                                        <input type="date" name="travel_date" id="travel_date"
                                            value="{{ old('travel_date', $destination->travel_date) }}"
                                            min="{{ date('Y-m-d', strtotime('tomorrow')) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="budget" class="form-label fw-semibold">
                                            <i class="bi bi-cash text-success"></i> Budget (₱)
                                        </label>
                                        <input type="number" name="budget" id="budget" step="0.01"
                                            value="{{ old('budget', $destination->budget) }}" class="form-control">
                                    </div>
                                </div>

                                <!-- Tag and Status -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="tag" class="form-label fw-semibold">
                                            <i class="bi bi-tag-fill text-info"></i> Tag
                                        </label>
                                        <input type="text" name="tag" id="tag"
                                            value="{{ old('tag', $destination->tag) }}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label fw-semibold">
                                            <i class="bi bi-check-circle-fill text-success"></i> Status *
                                        </label>
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="Noted" {{ old('status', $destination->status) === 'Noted' ? 'selected' : '' }}>📝 Noted (Dreaming)</option>
                                            <option value="Completed" {{ old('status', $destination->status) === 'Completed' ? 'selected' : '' }}>✅ Completed
                                                (Visited)</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Current Image -->
                                @if($destination->image)
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-image text-primary"></i> Current Image
                                        </label>
                                        <div>
                                            <img src="{{ asset('storage/' . $destination->image) }}"
                                                alt="{{ $destination->destination_name }}"
                                                class="img-fluid rounded shadow mb-2" style="max-height: 200px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_image"
                                                    id="remove_image" value="1">
                                                <label class="form-check-label text-danger" for="remove_image">
                                                    Remove this image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Image Upload -->
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-semibold">
                                        <i class="bi bi-image text-primary"></i>
                                        {{ $destination->image ? 'Change Image' : 'Upload Image' }}
                                    </label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                        onchange="previewImage(event)">
                                    <small class="text-muted">Upload a new photo (JPG, PNG, GIF)</small>

                                    <!-- Image Preview -->
                                    <div id="imagePreviewContainer" class="mt-3 d-none">
                                        <img id="imagePreview" src="" alt="Preview" class="img-fluid rounded shadow"
                                            style="max-height: 300px;">
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3 mt-5">
                                    <a href="{{ route('destinations.index') }}"
                                        class="btn btn-lg btn-outline-secondary flex-fill">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-lg fw-semibold flex-fill"
                                        id="start-journey-btn">
                                        <i class="bi bi-check-circle me-2"></i>Update Destination
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-dark text-center py-4" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('imagePreviewContainer');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                container.classList.add('d-none');
            }
        }
    </script>
</body>

</html>