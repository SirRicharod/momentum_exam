@extends('layouts.app')

@section('content')
<!-- Main container with centered card layout -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Report a New Pothole</div>
            <div class="card-body">
                <!-- Form submission to store the new pothole report -->
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf

                    <!-- Location (City) dropdown selection -->
                    <div class="mb-3">
                        <label for="location_id" class="form-label">Location (City)</label>
                        <select name="location_id" id="location_id" class="form-select @error('location_id') is-invalid @enderror" required>
                            <option value="">-- Select a City --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }} ({{ $location->postal_code }})
                                </option>
                            @endforeach
                        </select>
                        @error('location_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Street name text input field -->
                    <div class="mb-3">
                        <label for="street_name" class="form-label">Street Name</label>
                        <input type="text" name="street_name" id="street_name" class="form-control @error('street_name') is-invalid @enderror" value="{{ old('street_name') }}" required>
                        @error('street_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Severity level selection (1-5 scale) -->
                    <div class="mb-3">
                        <label for="severity" class="form-label">Severity (1-5)</label>
                        <select name="severity" id="severity" class="form-select @error('severity') is-invalid @enderror" required>
                            @foreach([1,2,3,4,5] as $val)
                                <option value="{{ $val }}" {{ old('severity') == $val ? 'selected' : '' }}>
                                    {{ $val }}
                                </option>
                            @endforeach
                        </select>
                        @error('severity')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Optional description textarea for additional details -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form action buttons: submit report or cancel -->
                    <button type="submit" class="btn btn-primary">Submit Report</button>
                    <a href="{{ route('reports.index') }}" class="btn btn-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection