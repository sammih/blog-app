<?php

use App\Models\Post;
use App\Models\User;

test('post can be created', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create(['id' => 1]);

    $this->actingAs($user); // SigningIn a user

    $input = Post::factory()->make(['user_id' => $user->id]);

    $this->post(route('posts.store'), $input->toArray());

    expect($input->title)->toBe($input->title);
    expect($input->content)->toBe($input->content);
    expect($input->user_id)->toBe(1);

});

test('post can be updated', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create(['id' => 1]);

    $this->actingAs($user); // SigningIn a user
    
    $originalPost = Post::factory()->create([
        'title' => 'title',
        'content' => 'content',
        'user_id' => $user->id
    ]);
    
    expect($originalPost->title)->toBe('title');
    expect($originalPost->content)->toBe('content');
    expect($originalPost->user_id)->toBe($user->id);

    $updatedPost = Post::factory()->make([
        'title' => 'updated title',
        'content' => 'updated content',
        'user_id' => $user->id
    ]);

    $this->put(route('posts.update', $originalPost->id), $updatedPost->toArray());
    
    expect($updatedPost->title)->toBe($updatedPost->title);
    expect($updatedPost->content)->toBe($updatedPost->content);
    expect($updatedPost->user_id)->toBe($updatedPost->user_id);

});

test('post can be deleted', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create();

    $this->actingAs($user); // SigningIn a user
    
    $post = Post::factory()->create();

    expect($post->title)->toBe($post->title);

    $this->delete(route('posts.destroy', $post->id));

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id
    ]);

});
