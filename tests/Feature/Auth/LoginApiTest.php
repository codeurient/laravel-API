<?php

use App\Models\User;

test('user can login with valid credentials via api', function() {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('12345678')
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => '12345678'
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'user' => [
                'id', 'name', 'email'
            ],
            'token'
        ])
        ->assertJson([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ])
        ;

    expect($response->json('token'))->not->toBeEmpty();

    $this->assertAuthenticated();
});