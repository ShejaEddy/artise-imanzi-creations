<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OtherCategory;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function get_category_name($id)
    {
        $parent_category = "None";
        if ($id != 0) {
            $category = Category::select('name')->where('id', $id)->get();
            foreach ($category as $cat) {
                $parent_category = $cat->name;
            }
        }
        return $parent_category;
    }

    public function check_category_existence($name, $parentId)
    {
        $exists = false;
        $category = Category::select('name')
            ->where('name', $name)
            ->where('parent_category', $parentId)
            ->count();
        if ($category > 0) {
            $exists = true;
        }

        return $exists;
    }

    public function check_company_category_existence($name)
    {
        $exists = false;
        $category = Category::select('name')
            ->where('name', $name)
            ->count();
        if ($category > 0) {
            $exists = true;
        }

        return $exists;
    }

    public function get_children_categories_num($id)
    {
        $children = DB::table('categories')
            ->where('parent_category', '=', $id)
            ->count();

        return $children;
    }
    // GENERATE UNIQUE IDs
    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    // ADD CATEGORY
    public function addCategory(Request $request)
    {
        $category = null;

        $data = $request->validate([
            'name' => 'required',
            'parent_category' => 'required'
        ]);
        $category = new Category([
            'name' => $data['name'],
            'parent_category' => $data['parent_category'],
            'category_type' => 'company'
        ]);

        // Checking if category already exists
        $already_exists = $this->check_category_existence($data['name'], $data['parent_category']);

        if (!$already_exists) {
            if ($category->save()) {
                $last = Category::find($category->id);
                return response()->json($last);
            } else {
                return response()->json('Error');
            }
        } else {
            return response()->json('already exists');
        }
    }

    // GET EXTRACTED CATEGORY
    public function getExtractedCategories()
    {
        $category_info = array();
        $categories_info = array();
        $categories = Category::all();
        foreach ($categories as $cat) {
            $category_info['id'] = $cat->id;
            $category_info['name'] = $cat->name;
            $category_info['parent_category_id'] = $cat->parent_category;
            $category_info['parent_category'] = $this->get_category_name($cat->parent_category);
            $category_info['children_categories_num'] = $this->get_children_categories_num($cat->id);
            array_push($categories_info, $category_info);
        }
        return response()->json($categories_info);
    }

    // GET CATEGORY
    public function getCategories()
    {
        $child_id = "";
        $category_info = array();
        $categories_info = array();
        $categories = Category::all();
        foreach ($categories as $cat) {
            if ($cat->parent_category === 0) {
                $category_info['id'] = $cat->id;
                $category_info['name'] = $cat->name;
                $category_info['parent_category_id'] = $cat->parent_category;
                $category_info['parent_category'] = $this->get_category_name($cat->parent_category);
                $category_info['children_categories_num'] = $this->get_children_categories_num($cat->id);
                $children_categories = Category::where('parent_category', $cat->id)->get();
                $children_arr = array();
                $child_arr = array();
                $grand_children_arr = array();
                $grand_child_arr = array();
                foreach ($children_categories as $child) {
                    $child_arr['id'] = $child->id;
                    $child_id = $child->id;
                    $child_arr['name'] = $child->name;
                    $child_arr['parent_id'] = $child->parent_category;
                    $grand_children_num = $this->get_children_categories_num($child->id);
                    $child_arr['grand_children_categories_num'] = $grand_children_num;

                    if ($grand_children_num > 0) {
                        $grand_children_categories = Category::where('parent_category', $child_id)->get();
                        foreach ($grand_children_categories as $grand_child) {
                            $grand_child_arr['id'] = $grand_child->id;
                            $grand_child_arr['name'] = $grand_child->name;
                            $grand_child_arr['parent_id'] = $grand_child->parent_category;
                            array_push($grand_children_arr, $grand_child_arr);
                        }
                        $child_arr['grand_children_categories'] = $grand_children_arr;
                    }
                    array_push($children_arr, $child_arr);
                }
                $category_info['children_categories'] = $children_arr;


                array_push($categories_info, $category_info);
            }
        }
        return response()->json($categories_info);
    }

    public function getCompanyCategories()
    {
        $categories = OtherCategory::whereHas('products')->with(["products" => function ($q) {
            $q->limit(4)->orderBy("created_at", "DESC");
        }])->limit(4)->get();
        return response()->json($categories);
    }

    public function getCategory($id)
    {
        $category_info = array();
        $categories_info = array();
        $categories = Category::where('id', $id)->first();
        $category_info['id'] = $categories->id;
        $category_info['name'] = $categories->name;
        $category_info['parent_category_id'] = $categories->parent_category;
        $category_info['parent_category'] = $this->get_category_name($categories->parent_category);
        $category_info['children_categories_num'] = $this->get_children_categories_num($categories->id);
        $category_info['children_categories'] =  DB::table('categories')->where('parent_category', '=', $categories->id);
        array_push($categories_info, $category_info);

        return response()->json($categories_info);
    }

    // UPDATE CATEGORY
    public function updateCategory(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|min:2',
            'parent_category_id' => 'required',
        ]);

        $category = DB::table('categories')
            ->where('id', $data['id'])
            ->update([
                'name' => $data['name'],
                'parent_category' => $data['parent_category_id'],
            ]);
        if ($category) {
            $category_info = array();
            $categories_info = array();
            $categories = Category::where('id', $data['id'])->first();
            $category_info['id'] = $categories->id;
            $category_info['name'] = $categories->name;
            $category_info['parent_category_id'] = $categories->parent_category;
            $category_info['parent_category'] = $this->get_category_name($categories->parent_category);
            $category_info['message'] = 'Success';
            array_push($categories_info, $category_info);
            return response()->json($categories_info);
        } else {
            return response()->json('Error');
        }
    }

    // REMOVE CATEGORY
    public function removeCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json($id);
    }


    // ADD COMPANY CATEGORY
    public function addCompanyCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'title_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'bg_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'bg_image_direction' => 'required'
        ]);

        $titleImage = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->title_image->getClientOriginalExtension();
        $request->title_image->move(public_path('uploads/images'), $titleImage);

        $bgImage = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->bg_image->getClientOriginalExtension();
        $request->bg_image->move(public_path('uploads/images'), $bgImage);

        $category = new OtherCategory([
            'name' => $data['name'],
            'title_image' => $titleImage,
            'bg_image' => $bgImage,
            'bg_image_direction' => $data['bg_image_direction'],
        ]);

        // Checking if category already exists
        $already_exists = $this->check_company_category_existence($data['name']);


        if (!$already_exists) {
            if ($category->save()) {
                $last = OtherCategory::find($category->id);
                return response()->json($last);
            } else {
                return response()->json('Error');
            }
        } else {
            return response()->json('already exists');
        }
    }

    // UPDATE COMPANY CATEGORY
    public function updateCompanyCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'title_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'bg_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'bg_image_direction' => 'required'
        ]);

        $titleImage = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->title_image->getClientOriginalExtension();
        $request->title_image->move(public_path('uploads/images'), $titleImage);

        $bgImage = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->bg_image->getClientOriginalExtension();
        $request->bg_image->move(public_path('uploads/images'), $bgImage);

        $category = DB::table('categories')
            ->where('id', $data['id'])
            ->update([
                'name' => $data['name'],
                'title_image' => $titleImage,
                'bg_image' => $bgImage,
                'bg_image_direction' => $data['bg_image_direction'],
            ]);
        if ($category) {
            $category_info = array();
            $categories_info = array();
            $categories = Category::where('id', $data['id'])->first();
            $category_info['id'] = $categories->id;
            $category_info['name'] = $categories->name;
            $category_info['title_image'] = $categories->title_image;
            $category_info['bg_image'] = $categories->bg_image;
            $category_info['bg_image_direction'] = $categories->bg_image_direction;
            $category_info['message'] = 'Success';
            array_push($categories_info, $category_info);
            return response()->json($categories_info);
        } else {
            return response()->json('Error');
        }
    }

    public function getOtherCategories(Request $request)
    {
        $data = OtherCategory::all();
        return response()->json($data);
    }
}
