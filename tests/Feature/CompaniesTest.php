<?php

namespace Tests\Feature;

use App\Models\Companies;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    public function test_get_all_company(): void
    {
        $user = User::where('email', 'admin@folkatech.com')->first();
        $response = $this->actingAs($user)->get('/company');

        $response->assertStatus(200);
    }

    public function test_create_company(): void
    {
        $data = [
            'name' => 'Test Company',
            'email' => 'test@company.com',
        ];

        $user = User::where('email', 'admin@folkatech.com')->first();
        $response = $this->actingAs($user)->post(route('company.store'), $data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('companies', $data);
    }

    public function test_show_a_company()
    {
        $company = Companies::factory()->create();
        $user = User::where('email', 'admin@folkatech.com')->first();
        $response = $this->actingAs($user)->get(route('company.show', $company->id));

        $response->assertStatus(200);
        $response->assertViewHas('data', $company);
    }

    public function test_update_a_company()
    {
        $company = Companies::factory()->create();

        $data = [
            'name' => 'Updated Company Name',
            'email' => 'updated@company.com',
        ];
        $user = User::where('email', 'admin@folkatech.com')->first();
        $response = $this->actingAs($user)->patch(route('company.update', $company->id), $data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('companies', $data);
    }

    public function test_delete_a_company()
    {
        $company = Companies::factory()->create();

        $user = User::where('email', 'admin@folkatech.com')->first();
        $response = $this->actingAs($user)->delete(route('company.destroy', $company->id));

        $response->assertStatus(302); // Check for a redirect
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
