<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    // ADD TAG
    public function addProductTag(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:2|string|unique:tags'
        ]);
        $tag = new Tag([
            'name' => $data['name']
        ]);
        if ($tag->save()) {
            $last = Tag::find($tag->id);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    // GET TAGS
    public function getProductTags()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    // REMOVE TAG
    public function removeProductTag($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json($id);
    }

    // UPDATE TAG
    public function updateProductTag(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|min:2',
        ]);
        $tag = Tag::find($data['id']);
        if ($tag->update($request->all())) {
            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }
}
