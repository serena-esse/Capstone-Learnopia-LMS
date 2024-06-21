<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_create_course_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('courses.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function teacher_can_access_create_course_page()
    {
        $teacher = User::factory()->create(['role' => 'teacher']);

        $response = $this->actingAs($teacher)->get(route('courses.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function student_cannot_access_create_course_page()
    {
        $student = User::factory()->create(['role' => 'student']);

        $response = $this->actingAs($student)->get(route('courses.create'));

        $response->assertRedirect('/home');
    }
}
