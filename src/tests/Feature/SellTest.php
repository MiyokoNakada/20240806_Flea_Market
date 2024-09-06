<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Item;

class SellTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_sell_an_item()
    {
        Storage::fake('public');

        $user = User::first();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('test-image.jpg');
        
        $response = $this->post('/sell', [
            'name' => 'TestItem',
            'brand' => 'Test',
            'price' => '1000',
            'image' => $file,
            'description' => 'This is a test item.',
            'condition_id' => '1',
            'categories' => [1, 2],
        ]);

        $response->assertRedirect('/');
        
        $item = Item::where('name', 'TestItem')->first();

        $this->assertNotNull($item);
        $this->assertEquals('TestItem', $item->name);
        $this->assertEquals('This is a test item.', $item->description);
        $this->assertEquals(1000, $item->price);
        $this->assertEquals($user->id, $item->user_id);
        // $this->assertFileExists(storage_path('app/public/image/' . $file->getClientOriginalName()));
        $this->assertEquals([1, 2], $item->categories->pluck('id')->toArray());
    }
}
