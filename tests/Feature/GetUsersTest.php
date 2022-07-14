<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testCanGetUsers()
    {
        $json = json_decode(file_get_contents(base_path('tests/fixtures/response.json')), true);

        Http::fake([
            'cspf-dev-challenge.herokuapp.com' => Http::response($json),
        ]);

        $user = User::factory()->create();

        $this->actingAs($user)->get('/dashboard')
             ->assertInertia(fn (Assert $page) => $page
                 ->component('Dashboard')
                 ->where('title', "This amazing table")
                 ->has('rows', 5)
                 ->has('rows.1', fn (Assert $page) => $page
                     ->where('id', 66)
                     ->where('first_name', 'Chris')
                     ->where('last_name', 'Test')
                     ->where('email', 'chris@test.com')
                     ->where('date', Carbon::parse(1552944355)->toDayDateTimeString())
                 )
             );
    }
}
