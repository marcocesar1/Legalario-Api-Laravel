<?php

namespace Tests\Feature\Customers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
     use RefreshDatabase;

     /**
      * Test create customer with user not logged in.
      */
     public function test_create_customer_with_user_not_logged_in(): void
     {
         $response = $this->postJson(route('customers.store'), []);

         $response->assertJsonFragment([
             "message" => "Unauthenticated."
         ]);
         $response->assertStatus(Response::HTTP_UNAUTHORIZED);
     }

    /**
     * Test create customer with invalid name.
     */
    public function test_create_customer_with_invalid_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('customers.store'), [
            'name' => '',
            'email' => 'test@example.com',
            'age' => 20,
            'country' => 'MEX',
        ]);
        
        $response->assertJsonFragment([
            "message" => "The name field is required."
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test create customer with invalid email.
     */
    public function test_create_customer_with_invalid_email(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('customers.store'), [
            'name' => 'Usuario',
            'email' => 'email',
            'age' => 20,
            'country' => 'MEX',
        ]);

        $response->assertJsonFragment([
            "message" => "The email field must be a valid email address."
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test create customer with invalid age.
     */
    public function test_create_customer_with_invalid_age(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('customers.store'), [
            'name' => 'Usuario',
            'email' => 'test@example.com',
            'age' => 'age',
            'country' => 'MEX',
        ]);

        $response->assertJsonFragment([
            "message" => "The age field must be an integer."
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test create customer with valid data.
     */
    public function test_create_customer_with_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('customers.store'), [
            'name' => 'Usuario',
            'email' => 'test@example.com',
            'age' => 30,
            'country' => 'MEX',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
