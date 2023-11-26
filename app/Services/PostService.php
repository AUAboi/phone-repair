<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService
{
  public function createPost(array $data)
  {
    DB::transaction(function () use ($data) {
      $post = Post::create([
        'title' => $data['title'],
        'author' => $data['author'],
        'body' => $data['body'],
        'status' => $data['status'],
        'user_id' => auth()->id()
      ]);
      $this->addPostImage($post, $data['image']);
    });
  }

  public function updatePost(Post $post, array $data)
  {
    DB::transaction(function () use ($post, $data) {
      $post->update([
        'title' => $data['title'],
        'author' => $data['author'],
        'body' => $data['body'],
        'status' => $data['status'],
        'user_id' => auth()->id()
      ]);
      $this->addPostImage($post, $data['image']);
    });
  }

  public function addPostImage(Post $post, $image)
  {
    if ($post->media) {
      $post->media->delete();
    }
    $postMedia = $post->media()->create([]);
    $postMedia->baseMedia()->associate(
      $postMedia->addMedia($image)->toMediaCollection()
    )->save();
  }
}
