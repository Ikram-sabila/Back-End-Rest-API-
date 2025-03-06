<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use PHPUnit\Framework\Attributes\Test;


class CategoryApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_can_get_all_categories(): void
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_get_a_single_category(): void {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJson([
                    'id'=>$category->id
                 ]);
    }

    public function test_returns_404_if_category_not_exist() : void {
        $response = $this->getJson('/api/categories/999');

        $response->assertStatus(404)
                 ->assertJson(['message'=>'Category Not Found']);
    }

    public function test_can_create_new_category() : void {
        $data = [
            'nama' => 'Kategori Baru'
        ];

        $response = $this->postJson('/api/categories/', $data);
        
        $response->assertStatus(201)
                 ->assertJson($data);
        
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_can_update_category() : void {
        $data = Category::factory()->create([
            'nama' => 'Kategori Baru'
        ]);
        
        $updateData = [
            'nama' => 'Kategori lama'
        ];

        $response = $this->putJson("/api/categories/{$data->id}", $updateData);

        $response->assertStatus(status: 200)
                 ->assertJson($updateData);
        
        $this->assertDatabaseHas('categories', $updateData);
    }

    public function test_returns_404_upadating_not_existng_category() : void {
        $updateData = [
            'nama' => 'Kategori lama'
        ];

        $response = $this->putJson("/api/categories/999", $updateData);

        $response->assertStatus(404)
                 ->assertJson(['message'=>'Category Not Found']);
    }

    public function test_can_delete_category() : void {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(204);
                 
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
