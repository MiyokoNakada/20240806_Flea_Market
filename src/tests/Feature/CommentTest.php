<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class CommentTest extends TestCase
{
    //コメント投稿
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_add_comment()
    {
        $user = User::first();
        $this->actingAs($user);
        $item = Item::with('categories', 'condition', 'comments')->first();
        $item_id = $item->id;

        $response = $this->post('/item/' . $item_id . '/comment', [
            'comment' => 'This is a test comment.',
        ]);

        $this->assertDatabaseHas('comments', [
            'comment' => 'This is a test comment.',
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response->assertRedirect(route('detail', ['item_id' => $item->id]));
    }

    //コメント削除
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_comment() {
        $user = User::first();
        $this->actingAs($user);
        $item = Item::with('categories', 'condition', 'comments')->first();
        $item_id = $item->id;

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->item_id = $item->id;
        $comment->comment = 'This is a test comment.';
        $comment->save();
        $comment_id = $comment->id;

        $response = $this->delete('/item/' . $item_id . '/comment/' . $comment_id, [
            'item_id' => $item_id,
            'comment_id' => $comment_id
        ]);

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
        ]);

        $response->assertRedirect(route('detail', ['item_id' => $item->id]));
        $response->assertSessionHas('message', 'コメントが削除されました。');

    }
}
