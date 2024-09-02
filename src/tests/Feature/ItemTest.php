<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use Illuminate\Support\Facades\Storage; 

class ItemTest extends TestCase
{
    //商品一覧取得
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_retrieve_item_list()
    {
        Storage::fake('local');

        $items = Item::where('sold', false)->get();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(Item::first()->name);

        foreach ($items as $item) {
            $response->assertSee($item->name);
        }
    }    
}
