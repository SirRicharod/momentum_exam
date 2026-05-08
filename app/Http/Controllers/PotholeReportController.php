<?php

namespace App\Http\Controllers;

use App\Models\PotholeReport;
use App\Models\Location;
use Illuminate\Http\Request;

class PotholeReportController extends Controller
{
    // Display paginated list of all pothole reports with optional severity filter
    public function index(Request $request)
    {
        $query = PotholeReport::with('location')->latest();

        if ($request->has('high_priority')) {
            $query->where('severity', '>=', 4);
        }

        $reports = $query->paginate(6)->withQueryString();

        return view('reports.index', compact('reports'));
    }

    // Show the form to create a new pothole report
    public function create()
    {
        $locations = Location::orderBy('name')->get();
        return view('reports.create', compact('locations'));
    }

    // Validate and save the new pothole report to the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'street_name' => 'required|string|max:255',
            'severity' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
        ]);

        PotholeReport::create($validated + ['status' => 'reported']);

        return redirect()->route('reports.index')->with('success', 'Pothole report created successfully!');
    }

    // Show the form to edit an existing pothole report
    public function edit(PotholeReport $report)
    {
        $locations = Location::orderBy('name')->get();
        return view('reports.edit', compact('report', 'locations'));
    }

    // Validate and save the updated pothole report to the database
    public function update(Request $request, PotholeReport $report)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'street_name' => 'required|string|max:255',
            'severity' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string',
            'status' => 'required|in:reported,fixed',
        ]);

        $report->update($validated);

        return redirect()->route('reports.index')->with('success', 'Report updated successfully!');
    }

    // Soft delete a pothole report (marks as deleted but preserves data for restoration)
    public function destroy(PotholeReport $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted.');
    }

    // Toggle the report status between 'reported' and 'fixed' (Momentum feature)
    public function toggleStatus(PotholeReport $report)
    {
        $report->update([
            'status' => $report->status === 'fixed' ? 'reported' : 'fixed'
        ]);

        return redirect()->back()->with('success', 'Status updated.');
    }
}
