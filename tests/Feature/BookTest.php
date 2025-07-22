<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_book()
    {
        $data = [
            'title' => 'Test Book',
            'author' => 'Jane Doe',
            'isbn' => '1234567890',
            'available_copies' => 3,
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Test Book']);

        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'author' => 'Jane Doe',
            'isbn' => '1234567890',
        ]);
    }
}
