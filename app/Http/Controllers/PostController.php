<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $posts =  Post::orderBy('updated_at')
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Posts/Index', [
            'filters' => $filters,
            'posts' => PostResource::collection($posts)
        ]);
    }

    public function create()
    {
        return Inertia::render("Admin/Posts/Create");
    }

    public function store(StorePostRequest $request, PostService $postService)
    {
        try {
            $postService->createPost($request->validated());
        } catch (\Throwable $th) {
            return Redirect::route('posts.create')->with('error', 'Error cant create: ' . $th->getMessage());
        }

        return Redirect::route('posts.index')->with('success', 'Post added succesfully.');
    }

    public function show(Post $post)
    {
        if ($post->status == "draft") {
            if (!auth()->user()->is_admin) {
                return redirect()->back();
            }
        }
        return Inertia::render('Public/Blog', [
            'post' => new PostResource($post),
            'related_posts' => PostResource::collection(Post::where('id', '!=', $post->id)->publishedPosts()->latest()->take(5)->get())
        ]);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Admin/Posts/Edit', [
            'post' => new PostResource($post),
        ]);
    }

    public function update(UpdatePostRequest $request, PostService $postService, Post $post)
    {
        try {
            $postService->updatePost($post, $request->validated());
        } catch (\Throwable $th) {
            return Redirect::route('posts.index')->with('error', 'Error cant update: ' . $th->getMessage());
        }

        return Redirect::route('posts.index')->with('success', 'Post added succesfully.');
    }

    public function destroy(Post $post)
    {
        DB::transaction(function () use ($post) {
            if ($post->media) {
                $post->media->delete();
            }
            $post->delete();
        });


        return Redirect::route('posts.index')->with('success', 'Post deleted successfully.');
    }
    public function search(Request $request)
    {
        $filters = $request->all('search');
        $posts =  Post::orderBy('updated_at')
            ->filter($filters)
            ->paginate(100)
            ->withQueryString();

        return Inertia::render('Public/Search', [
            'filters' => $filters,
            'posts' => PostResource::collection($posts)
        ]);
    }
}
