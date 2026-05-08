<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\PotholeReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PotholeReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_loads_correctly_and_displays_reports()
    {
        $report = PotholeReport::factory()->create();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee($report->street_name);
    }

    public function test_can_create_a_pothole_report()
    {
        $location = Location::factory()->create();

        $response = $this->post(route('reports.store'), [
            'location_id' => $location->id,
            'street_name' => 'Nieuwstraat',
            'severity' => 4,
            'description' => 'Huge pothole',
        ]);

        $response->assertRedirect(route('reports.index'));
        $this->assertDatabaseHas('pothole_reports', [
            'street_name' => 'Nieuwstraat',
            'severity' => 4,
            'status' => 'reported',
        ]);
    }

    public function test_can_update_a_pothole_report()
    {
        $report = PotholeReport::factory()->create(['status' => 'reported']);

        $response = $this->put(route('reports.update', $report), [
            'location_id' => $report->location_id,
            'street_name' => 'Updated Street',
            'severity' => 2,
            'description' => 'Updated desc',
            'status' => 'fixed',
        ]);

        $response->assertRedirect(route('reports.index'));
        $this->assertDatabaseHas('pothole_reports', [
            'id' => $report->id,
            'street_name' => 'Updated Street',
            'status' => 'fixed',
        ]);
    }

    public function test_can_delete_a_report()
    {
        $report = PotholeReport::factory()->create();

        $response = $this->delete(route('reports.destroy', $report));

        $response->assertRedirect(route('reports.index'));
        $this->assertDatabaseMissing('pothole_reports', [
            'id' => $report->id,
        ]);
    }

    public function test_can_toggle_report_status()
    {
        $report = PotholeReport::factory()->create(['status' => 'reported']);

        $response = $this->patch(route('reports.toggle-status', $report));

        $response->assertRedirect();
        $this->assertEquals('fixed', $report->fresh()->status);
    }

    public function test_high_priority_filter_works()
    {
        PotholeReport::factory()->create(['severity' => 2, 'street_name' => 'Low Prio Street']);
        PotholeReport::factory()->create(['severity' => 5, 'street_name' => 'High Prio Street']);

        $response = $this->get('/?high_priority=1');

        $response->assertStatus(200);
        $response->assertSee('High Prio Street');
        $response->assertDontSee('Low Prio Street');
    }
}
