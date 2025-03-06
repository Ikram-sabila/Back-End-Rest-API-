<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use PHPUnit\Framework\Attributes\Test;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_can_get_all_items(): void
    {
        Item::factory()->count(3)->create();

        $response = $this->getJson('/api/items');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_get_a_single_item(): void {
        $item = Item::factory()->create();

        $response = $this->getJson("/api/items/{$item->id}");

        $response->assertStatus(200)
                 ->assertJson([
                    'id'=>$item->id,
                    'nama'=>$item->nama,
                    'jumlah'=>$item->jumlah,
                    'harga'=>$item->harga,
                 ]);
    }

    public function test_returns_404_if_item_not_exist() : void {
        $response = $this->getJson('/api/items/999');

        $response->assertStatus(404)
                 ->assertJson(['message'=>'Item not found']);
    }

    public function test_can_create_new_item() : void {
        $data = [
            'nama' => 'Barang Baru',
            'jumlah' => 3,
            'harga' => 20000 
        ];

        $response = $this->postJson('/api/items/', $data);
        
        $response->assertStatus(201)
                 ->assertJson($data);
        
        $this->assertDatabaseHas('items', $data);
    }

    public function test_can_update_item() : void {
        $data = Item::factory()->create([
            'nama' => 'Barang Baru',
            'jumlah' => 3,
            'harga' => 20000 
        ]);
        
        $updateData = [
            'nama' => 'Barang lama',
            'jumlah' => 4,
            'harga' => 40000 
        ];

        $response = $this->putJson("/api/items/{$data->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJson($updateData);
        
        $this->assertDatabaseHas('items', $updateData);
    }

    public function test_returns_404_upadating_not_existng_item() : void {
        $updateData = [
            'nama' => 'Barang lama',
            'jumlah' => 4,
            'harga' => 40000 
        ];

        $response = $this->putJson("/api/items/999", $updateData);

        $response->assertStatus(404)
                 ->assertJson(['message'=>'Item not found']);
    }

    public function test_can_delete_item() : void {
        $item = Item::factory()->create();

        $response = $this->deleteJson("/api/items/{$item->id}");

        $response->assertStatus(204);
                 
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
