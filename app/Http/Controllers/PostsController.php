<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    // GENERATE UNIQUE IDs
    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function get_user_name($id)
    {
        $names = "";
        $artist = User::select('names')->where('id', $id)->get();
        foreach ($artist as $art) {
            $names = $art->names;
        }
        return $names;
    }

    public function addPost(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|unique:posts',
            'caption' => 'required|string',
            'featured_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'content' => 'required|min:3'
        ]);

        $featuredImage = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->featured_image->getClientOriginalExtension();
        $request->featured_image->move(public_path('uploads/images'), $featuredImage);

        $post = new Post([
            'title' => $data['title'],
            'caption' => $data['caption'],
            'featured_image' => $featuredImage,
            'body' => $data['content'],
            'author' => auth()->user()->id,
            'status' => 'Pending',
        ]);
        if ($post->save()) {
            $last = Post::find($post->id);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    public function updatePost(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'caption' => 'required|string',
            'featured_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'body' => 'required|min:3'
        ]);

        $featuredImage = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->featured_image->getClientOriginalExtension();
        $request->featured_image->move(public_path('uploads/images'), $featuredImage);

        $post = DB::table('posts')
            ->where('id', $request->postId)
            ->update([
                'title' => $data['title'],
                'caption' => $data['caption'],
                'featured_image' => $featuredImage,
                'body' => $data['body']
            ]);
        if ($post) {
            $last = Post::find($request->postId);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    public function getPosts(Request $request)
    {
        $post_info = array();
        $posts_info = array();
        $posts = DB::table('posts')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($posts as $post) {
            $post_info['id'] = $post->id;
            $post_info['title'] = $post->title;
            $post_info['caption'] = $post->caption;
            $post_info['featured_image'] = $post->featured_image;
            $post_info['body'] = $post->body;
            $post_info['status'] = $post->status;
            $post_info['date'] = $post->created_at;
            $post_info['author'] = $this->get_user_name($post->author);
            array_push($posts_info, $post_info);
        }
        return response()->json($posts_info);
    }

    public function getSinglePost($postId)
    {
        $post_info = array();
        $posts_info = array();
        $posts = DB::table('posts')
            ->orderByRaw('created_at DESC')
            ->where('id', '=', $postId)
            ->get();
        foreach ($posts as $post) {
            $post_info['id'] = $post->id;
            $post_info['title'] = $post->title;
            $post_info['caption'] = $post->caption;
            $post_info['featured_image'] = $post->featured_image;
            $post_info['body'] = $post->body;
            $post_info['status'] = $post->status;
            $post_info['date'] = $post->created_at;
            $post_info['author'] = $this->get_user_name($post->author);
            array_push($posts_info, $post_info);
        }
        return response()->json($posts_info);
    }

    public function publishPost($postId)
    {
        $status = "Published";
        $post = DB::table('posts')
            ->where('id', $postId)
            ->update(['status' => $status]);
        if ($post) {
            return response()->json('Success');
        }
    }

    public function removePost($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        return response()->json($postId);
    }

    public function searchPost($searchFor)
    {
        $post_info = array();
        $posts_info = array();
        $posts = DB::table('posts')
            ->where('title', 'like', '%' . $searchFor . '%')
            ->get();
        foreach ($posts as $post) {
            $post_info['id'] = $post->id;
            $post_info['title'] = $post->title;
            $post_info['caption'] = $post->caption;
            $post_info['featured_image'] = $post->featured_image;
            $post_info['body'] = $post->body;
            $post_info['status'] = $post->status;
            $post_info['date'] = $post->created_at;
            $post_info['author'] = $this->get_user_name($post->author);
            array_push($posts_info, $post_info);
        }
        return response()->json($posts_info);
    }
}
