@extends('layouts.app')

@section('content')
<!-- Header section with dashboard title and filter buttons -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Reports Dashboard</h2>
    <div>
        <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary me-2">Clear Filters</a>
        <a href="{{ route('reports.index', ['high_priority' => 1]) }}" class="btn btn-warning">⚠️ High Priority</a>
    </div>
</div>

<!-- Grid container to display all pothole reports as cards -->
<div class="row">
    @forelse($reports as $report)
        <!-- Individual report card with dynamic coloring based on status and severity -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 {{ $report->status === 'fixed' ? 'success-card' : ($report->severity >= 4 ? 'danger-card' : 'warning-card') }}">
                <div class="card-body">
                    <!-- Report title and status badge -->
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">{{ $report->street_name }}</h5>
                        <span class="badge {{ $report->status === 'fixed' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($report->status) }}
                        </span>
                    </div>
                    <!-- Location and postal code information -->
                    <h6 class="card-subtitle mb-2 text-muted">
                        {{ $report->location->name }} ({{ $report->location->postal_code }})
                    </h6>
                    <!-- Severity level and description details -->
                    <p class="card-text">
                        <strong>Severity:</strong> {{ $report->severity }}/5<br>
                        {{ $report->description }}
                    </p>
                </div>
                <!-- Report timestamp and action buttons (toggle, edit, delete) -->
                <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
                    <small class="text-muted">Reported on {{ $report->created_at->format('d M Y') }}</small>
                    <!-- Action buttons for report management -->
                    <div class="d-flex gap-2">
                        <form action="{{ route('reports.toggle-status', $report) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if($report->status === 'reported')
                                <button type="submit" class="btn btn-sm btn-success">Mark Fixed</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Mark Reported</button>
                            @endif
                        </form>
                        
                        <a href="{{ route('reports.edit', $report) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                        <form action="{{ route('reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <!-- Empty state message when no reports are found -->
        <div class="col-12">
            <div class="alert alert-info">No pothole reports found.</div>
        </div>
    @endforelse
</div>

<!-- Pagination controls for navigating through report pages -->
<div class="mt-5 pt-4">
    {{ $reports->links() }}
</div>
@endsection