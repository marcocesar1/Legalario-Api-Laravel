<?php

namespace Tests\Feature\Customers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CustomerListTest extends TestCase
{
     use RefreshDatabase;

     /**
      * Test list customer with user not logged in.
      */
     public function test_create_customer_with_user_not_logged_in(): void
     {
        $response = $this->getJson(route('customers.index'), []);

        $response->assertJsonFragment([
            "message" => "Unauthenticated."
        ]);
        
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
     }

     /**
      * Test list customer with user logged in.
      */
     public function test_create_customer_with_user_logged_in(): void
     {
        Customer::factory()->count(5)->create();
         
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route('customers.index'), []);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(5, 'data');
     }
}
