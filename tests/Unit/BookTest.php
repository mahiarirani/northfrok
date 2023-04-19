<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_basic()
    {
        $this->assertTrue(true);
    }

    public function test_index()
    {
        $book = Book::factory()->create();
        $response = $this->get('/api/books')
            ->assertStatus(200);
        $this->assertEquals($response['count'], Book::all()->count());
        $last = array_key_last($response['data']);
        $this->assertEquals($response['data'][$last], [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author,
            'publication_date' => $book->publication_date,
            'description' => $book->description,
        ]);
    }

    public function test_create()
    {
        $book = Book::factory()->make();
        $data = [
            'title' => $book->title,
            'author' => $book->author,
            'publication_date' => $book->publication_date,
            'description' => $book->description,
        ];

        $this->post('/api/books', $data)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => $book->title,
                    'author' => $book->author,
                    'publication_date' => $book->publication_date,
                    'description' => $book->description,
                ]
            ]);
    }

    public function test_update()
    {
        $book = Book::factory()->create();
        $updatedBook = Book::factory()->make();
        $data = [
            'title' => $updatedBook->title,
            'author' => $updatedBook->author,
            'publication_date' => $updatedBook->publication_date,
            'description' => $updatedBook->description,
        ];

        $this->put('/api/books/' . $book->id, $data)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $book->id,
                    'title' => $updatedBook->title,
                    'author' => $updatedBook->author,
                    'publication_date' => $updatedBook->publication_date,
                    'description' => $updatedBook->description,
                ]
            ]);
    }


    public function test_delete()
    {
        $book = Book::factory()->create();
        $this->delete('/api/books/' . $book->id)
            ->assertStatus(200);
    }
}
