<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_subadmin_and_assign_a_student(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($admin)->post('/admin/subadmins', [
            'name' => 'Team Lead',
            'email' => 'lead@example.com',
            'mobile' => '9876543210',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect('/dashboard');

        $subadmin = User::where('email', 'lead@example.com')->firstOrFail();
        $this->patch("/admin/students/{$student->id}/assignment", [
            'assigned_subadmin_id' => $subadmin->id,
        ])->assertSessionHas('status');

        $this->assertDatabaseHas('users', ['id' => $student->id, 'assigned_subadmin_id' => $subadmin->id]);
    }

    public function test_subadmin_only_sees_their_assigned_students(): void
    {
        $subadmin = User::factory()->create(['role' => 'subadmin']);
        $assigned = User::factory()->create(['name' => 'Assigned Student', 'role' => 'student', 'assigned_subadmin_id' => $subadmin->id]);
        $other = User::factory()->create(['name' => 'Other Student', 'role' => 'student']);

        $this->actingAs($subadmin)->get('/dashboard')
            ->assertOk()
            ->assertSee($assigned->name)
            ->assertDontSee($other->name);
    }

    public function test_student_can_update_their_own_profile(): void
    {
        $student = User::factory()->create(['role' => 'student', 'work_status' => 'fresher']);

        $this->actingAs($student)->patch('/profile', [
            'name' => 'Updated Student',
            'email' => $student->email,
            'mobile' => '9999999999',
            'work_status' => 'experience',
        ])->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'id' => $student->id,
            'name' => 'Updated Student',
            'work_status' => 'experience',
        ]);
    }

    public function test_admin_can_delete_a_subadmin_without_deleting_assigned_students(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $subadmin = User::factory()->create(['role' => 'subadmin']);
        $student = User::factory()->create(['role' => 'student', 'assigned_subadmin_id' => $subadmin->id]);

        $this->actingAs($admin)->delete("/admin/users/{$subadmin->id}")
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('users', ['id' => $subadmin->id]);
        $this->assertDatabaseHas('users', ['id' => $student->id, 'assigned_subadmin_id' => null]);
    }
}
