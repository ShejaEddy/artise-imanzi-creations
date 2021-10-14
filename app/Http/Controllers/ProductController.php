<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColors;
use App\Models\TagAssociation;
use App\Models\colorAssociation;
use App\Models\ProductImages;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\User;
use App\Models\Tag;
use App\Models\Review;
use App\Models\ProductRate;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    // GENERATE UNIQUE IDs
    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function get_product_name($id)
    {
        $name = "";
        $product = Product::select('name')->where('id', $id)->get();
        foreach ($product as $prod) {
            $name = $prod->name;
        }
        return $name;
    }
    public function get_previous_views($product_id)
    {
        $views = "";
        $product = Product::select("views")->where('id', $product_id)->get();
        foreach ($product as $prod) {
            $views = $prod->views;
        }
        return $views;
    }
    public function get_category_name($id)
    {
        $name = "";
        $category = Category::select('name')->where('id', $id)->get();
        foreach ($category as $cat) {
            $name = $cat->name;
        }
        return $name;
    }
    public function get_artist_name($id)
    {
        $names = "";
        $artist = User::select('names')->where('id', $id)->get();
        foreach ($artist as $art) {
            $names = $art->names;
        }
        return $names;
    }
    public function get_artist_id($id)
    {
        $artist_id = "";
        $artist = User::select('id')->where('id', $id)->get();
        foreach ($artist as $art) {
            $artist_id = $art->id;
        }
        return $artist_id;
    }

    public function get_order_ref_no($id)
    {
        $ref_no = 0;
        $order = Order::select('refNo')->where('id', $id)->get();
        foreach ($order as $item) {
            $ref_no = $item->refNo;
        }
        return $ref_no;
    }

    public function get_order_details($id)
    {
        $orders = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.productId')
            ->join('orders', 'orders.id', '=', 'order_details.orderId')
            ->select('order_details.*', 'products.name as product', 'orders.refNo')
            ->where('orders.id', '=', $id)
            ->get();
        return $orders;
    }

    public function get_product_reviews($id)
    {
        $reviews = 0;
        $reviews = DB::table('reviews')
            ->where('product_id', '=', $id)
            ->count();

        return $reviews;
    }

    public function get_product_ratings_average($id)
    {
        $counter = 0;
        $total_rates = 0;
        $rate_average = 0;
        $product_ratings = DB::table('product_rates')
            ->where('product_id', '=', $id)
            ->get();

        foreach ($product_ratings as $rate) {
            $counter++;
            $total_rates += $rate->rate_value;
        }
        if ($counter > 0) {
            $rate_average = $total_rates / $counter;
        } else {
            $rate_average = 0;
        }

        return $rate_average;
    }

    // ADD PRODUCT
    public function addProduct(Request $request)
    {
        $is_for_company = false;
        $data = $request->validate([
            'name' => 'required|string|unique:products',
            'size' => 'required',
            'price' => 'required',
            'discount' => 'required',
            // 'colors' => 'required',
            'shortDesc' => 'required',
            'longDesc' => 'required',
            'product_type' => 'required',
            'thumbnail' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'forwardImage' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'backwardImage' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'added_by' => 'required',
            'categoryId' => 'required',
            'otherCategoryId' => 'required',
            'tags' => 'required',
            'stock' => 'required',
            'location' => 'required',
            'is_eBook' => 'required',
            'product_owner' => 'required'
        ]);

        // $thumbnailName = 'New-Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->thumbnail->getClientOriginalName();
        // $request->thumbnail->storeAs('uploads/images', $thumbnailName, 'public');

        // $forwardImageName = 'New-Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->forwardImage->getClientOriginalName();
        // $request->forwardImage->storeAs('uploads/images', $forwardImageName, 'public');

        // $backwardImageName = 'New-Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->backwardImage->getClientOriginalName();
        // $request->backwardImage->storeAs('uploads/images', $backwardImageName, 'public');

        $thumbnailName = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->thumbnail->getClientOriginalExtension();
        $request->thumbnail->move(public_path('uploads/images'), $thumbnailName);

        $forwardImageName = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->forwardImage->getClientOriginalExtension();
        $request->forwardImage->move(public_path('uploads/images'), $forwardImageName);

        $backwardImageName = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->backwardImage->getClientOriginalExtension();
        $request->backwardImage->move(public_path('uploads/images'), $backwardImageName);

        if ($request->product_owner == "company") {
            $is_for_company = true;
        }

        if ($request->book_pdf) {
            $book_pdf_name = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->book_pdf->getClientOriginalExtension();
            $request->book_pdf->move(public_path('uploads/images'), $book_pdf_name);
        } else {
            $book_pdf_name = "N/A";
        }



        $product = new Product([
            'name' => $data['name'],
            'size' => $data['size'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'shortDesc' => $data['shortDesc'],
            'longDesc' => $data['longDesc'],
            'product_type' => $data['product_type'],
            'book_pdf' => $book_pdf_name,
            'thumbnail' => $thumbnailName,
            'forwardImage' => $forwardImageName,
            'backwardImage' => $backwardImageName,
            'categoryId' => $data['categoryId'],
            'otherCategoryId' => $data['otherCategoryId'],
            'stock' => $data['stock'],
            'location' => $data['location'],
            'is_for_company' => $is_for_company,
            'status' => 'Pending',
            'added_by' => $data['added_by'],
        ]);


        if ($product->save()) {
            $lastRecord = Product::find($product->id);

            // SAVE PRODUCT TAGS
            $tags_array = explode(',', $data['tags']);
            foreach ($tags_array as $tag_item) {
                $tags = DB::table('tags')
                    ->select('id')
                    ->where('name', $tag_item)
                    ->get();
                foreach ($tags as $tag) {
                    DB::insert('insert into tag_associations (tag_id, product_id) values (?, ?)', [$tag->id, $product->id]);
                }
            }

            // SAVE PRODUCT COLORS
            // $colors_array = explode(',', $data['colors']);
            // foreach ($colors_array as $color_item) {
            //     $colors = DB::table('product_colors')
            //         ->select('id')
            //         ->where('name', $color_item)
            //         ->limit(1)
            //         ->get();
            //     foreach ($colors as $color) {
            //         DB::insert('insert into color_associations (color_id, product_id) values (?, ?)', [$color->id, $product->id]);
            //     }
            // }

            // SAVE PRODUCT IMAGES
            if ($request->hasFile('otherImages')) {
                foreach ($request->otherImages as $image) {
                    $image_name = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/images'), $image_name);

                    // $image_name = 'New-Imanzi-Creations-' . $this->unique_code(9) . '.' . $image->getClientOriginalName();
                    // $image->storeAs('uploads/images', $image_name, 'public');
                    DB::insert('insert into product_images (product_id, name) values (?,?)', [$product->id, $image_name]);
                }
            }

            return response()->json($lastRecord);
        } else {
            return response()->json('Error');
        }
    }

    // GET PRODUCTS
    public function getProducts()
    {
        $product_info = array();
        $products_info = array();
        $products = DB::table('products')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($products as $prod) {
            $product_info['id'] = $prod->id;
            $product_info['name'] = $prod->name;
            $product_info['size'] = $prod->size;
            $product_info['price'] = $prod->price;
            $product_info['discounted_price'] = $prod->price - (($prod->price * $prod->discount) / 100);
            $product_info['discount'] = $prod->discount;
            $product_info['shortDesc'] = $prod->shortDesc;
            $product_info['longDesc'] = $prod->longDesc;
            $product_info['book_pdf'] = $prod->book_pdf;
            $product_info['product_type'] = $prod->product_type;
            $product_info['is_for_company'] = $prod->is_for_company;
            $product_info['status'] = $prod->status;
            $product_info['thumbnail'] = $prod->thumbnail;
            $product_info['forwardImage'] = $prod->forwardImage;
            $product_info['backwardImage'] = $prod->backwardImage;
            $product_info['categoryId'] = $prod->categoryId;
            $product_info['otherCategoryId'] = $prod->otherCategoryId;
            $product_info['category_name'] = $this->get_category_name($prod->categoryId);
            $product_info['stock'] = $prod->stock;
            $product_info['location'] = $prod->location;
            $product_info['added_by'] = $prod->added_by;
            $product_info['artist_name'] = $this->get_artist_name($prod->added_by);
            $product_info['date'] = $prod->created_at;
            $product_info['updated_at'] = $prod->updated_at;
            $product_info['reviews_num'] = $this->get_product_reviews($prod->id);
            $product_info['reviews'] = Review::where('product_id', $prod->id)->get();
            $rating_avg = round($this->get_product_ratings_average($prod->id));
            $product_info['ratings_averages'] = $rating_avg;
            $product_info['ratings_percentage'] = round(($rating_avg / 5) * 100);


            array_push($products_info, $product_info);
        }
        return response()->json($products_info);
    }

    public function getCompanyProducts()
    {
        $product_info = array();
        $products_info = array();
        $products = DB::table('products')
            ->where('is_for_company', true)
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($products as $prod) {
            $product_info['id'] = $prod->id;
            $product_info['name'] = $prod->name;
            $product_info['size'] = $prod->size;
            $product_info['price'] = $prod->price;
            $product_info['discounted_price'] = $prod->price - (($prod->price * $prod->discount) / 100);
            $product_info['discount'] = $prod->discount;
            $product_info['shortDesc'] = $prod->shortDesc;
            $product_info['longDesc'] = $prod->longDesc;
            $product_info['book_pdf'] = $prod->book_pdf;
            $product_info['product_type'] = $prod->product_type;
            $product_info['is_for_company'] = $prod->is_for_company;
            $product_info['status'] = $prod->status;
            $product_info['thumbnail'] = $prod->thumbnail;
            $product_info['forwardImage'] = $prod->forwardImage;
            $product_info['backwardImage'] = $prod->backwardImage;
            $product_info['categoryId'] = $prod->categoryId;
            $product_info['otherCategoryId'] = $prod->otherCategoryId;
            $product_info['category_name'] = $this->get_category_name($prod->categoryId);
            $product_info['stock'] = $prod->stock;
            $product_info['location'] = $prod->location;
            $product_info['added_by'] = $prod->added_by;
            $product_info['artist_name'] = $this->get_artist_name($prod->added_by);
            $product_info['date'] = $prod->created_at;
            $product_info['updated_at'] = $prod->updated_at;
            $product_info['reviews_num'] = $this->get_product_reviews($prod->id);
            $product_info['reviews'] = Review::where('product_id', $prod->id)->get();
            $rating_avg = round($this->get_product_ratings_average($prod->id));
            $product_info['ratings_averages'] = $rating_avg;
            $product_info['ratings_percentage'] = round(($rating_avg / 5) * 100);


            array_push($products_info, $product_info);
        }
        return response()->json($products_info);
    }

    public function getShopProducts()
    {
        $product_info = array();
        $products_info = array();
        $products = DB::table('products')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($products as $prod) {
            if ($prod->status != "Pending" && $prod->status != "Rejected") {
                $product_info['id'] = $prod->id;
                $product_info['name'] = $prod->name;
                $product_info['size'] = $prod->size;
                $product_info['price'] = $prod->price;
                $product_info['discounted_price'] = $prod->price - (($prod->price * $prod->discount) / 100);
                $product_info['discount'] = $prod->discount;
                $product_info['shortDesc'] = $prod->shortDesc;
                $product_info['longDesc'] = $prod->longDesc;
                $product_info['book_pdf'] = $prod->book_pdf;
                $product_info['product_type'] = $prod->product_type;
                $product_info['is_for_company'] = $prod->is_for_company;
                $product_info['status'] = $prod->status;
                $product_info['thumbnail'] = $prod->thumbnail;
                $product_info['forwardImage'] = $prod->forwardImage;
                $product_info['backwardImage'] = $prod->backwardImage;
                $product_info['categoryId'] = $prod->categoryId;
                $product_info['otherCategoryId'] = $prod->otherCategoryId;
                $product_info['category_name'] = $this->get_category_name($prod->categoryId);
                $product_info['stock'] = $prod->stock;
                $product_info['location'] = $prod->location;
                $product_info['added_by'] = $prod->added_by;
                $product_info['artist_name'] = $this->get_artist_name($prod->added_by);
                $product_info['date'] = $prod->created_at;
                $product_info['updated_at'] = $prod->updated_at;
                $product_info['reviews_num'] = $this->get_product_reviews($prod->id);
                $product_info['reviews'] = Review::where('product_id', $prod->id)->get();
                $rating_avg = round($this->get_product_ratings_average($prod->id));
                $product_info['ratings_averages'] = $rating_avg;
                $product_info['ratings_percentage'] = round(($rating_avg / 5) * 100);

                array_push($products_info, $product_info);
            }
        }
        return response()->json($products_info);
    }

    // GET MY PRODUCTS

    public function getMyProducts($id)
    {

        $product_info = array();
        $products_info = array();
        $products = DB::table('products')->where('added_by', $id)->get();
        foreach ($products as $prod) {
            $product_info['id'] = $prod->id;
            $product_info['name'] = $prod->name;
            $product_info['size'] = $prod->size;
            $product_info['price'] = $prod->price;
            $product_info['discounted_price'] = $prod->price - (($prod->price * $prod->discount) / 100);
            $product_info['discount'] = $prod->discount;
            $product_info['shortDesc'] = $prod->shortDesc;
            $product_info['longDesc'] = $prod->longDesc;
            $product_info['book_pdf'] = $prod->book_pdf;
            $product_info['product_type'] = $prod->product_type;
            $product_info['is_for_company'] = $prod->is_for_company;
            $product_info['status'] = $prod->status;
            $product_info['thumbnail'] = $prod->thumbnail;
            $product_info['forwardImage'] = $prod->forwardImage;
            $product_info['backwardImage'] = $prod->backwardImage;
            $product_info['categoryId'] = $prod->categoryId;
            $product_info['otherCategoryId'] = $prod->otherCategoryId;
            $product_info['category_name'] = $this->get_category_name($prod->categoryId);
            $product_info['stock'] = $prod->stock;
            $product_info['location'] = $prod->location;
            $product_info['added_by'] = $prod->added_by;
            $product_info['artist_name'] = $this->get_artist_name($prod->added_by);
            $product_info['date'] = $prod->created_at;
            $product_info['updated_at'] = $prod->updated_at;
            $product_info['reviews_num'] = $this->get_product_reviews($prod->id);
            $product_info['reviews'] = Review::where('product_id', $prod->id)->get();
            $rating_avg = round($this->get_product_ratings_average($prod->id));
            $product_info['ratings_averages'] = $rating_avg;
            $product_info['ratings_percentage'] = round(($rating_avg / 5) * 100);

            array_push($products_info, $product_info);
        }
        return response()->json($products_info);
    }

    // GET PRODUCT
    public function getProduct($id)
    {
        $product_info = array();
        $products_info = array();
        $data = new ProductController;
        // $colors_arr = array();
        $tags_arr = array();
        $products = DB::table('products')->where('id', $id)->get();
        foreach ($products as $prod) {
            $product_info['id'] = $prod->id;
            $product_info['name'] = $prod->name;
            $product_info['size'] = $prod->size;
            $product_info['price'] = $prod->price;
            $product_info['discounted_price'] = $prod->price - (($prod->price * $prod->discount) / 100);
            $product_info['discount'] = $prod->discount;
            $product_info['shortDesc'] = $prod->shortDesc;
            $product_info['longDesc'] = $prod->longDesc;
            $product_info['book_pdf'] = $prod->book_pdf;
            $product_info['product_type'] = $prod->product_type;
            $product_info['status'] = $prod->status;
            $product_info['thumbnail'] = $prod->thumbnail;
            $product_info['forwardImage'] = $prod->forwardImage;
            $product_info['backwardImage'] = $prod->backwardImage;
            $product_info['categoryId'] = $prod->categoryId;
            $product_info['otherCategoryId'] = $prod->otherCategoryId;
            $product_info['category_name'] = $this->get_category_name($prod->categoryId);
            $product_info['stock'] = $prod->stock;
            $product_info['location'] = $prod->location;
            $product_info['added_by'] = $prod->added_by;
            $product_info['date'] = $prod->created_at;
            $product_info['updated_at'] = $prod->updated_at;
            $product_info['reviews_num'] = $this->get_product_reviews($prod->id);
            $product_info['reviews'] = Review::where('product_id', $prod->id)->get();
            $rating_avg = round($this->get_product_ratings_average($prod->id));
            $product_info['ratings_averages'] = $rating_avg;
            $product_info['ratings_percentage'] = round(($rating_avg / 5) * 100);

            array_push($products_info, $product_info);
        }

        $artist = User::where('id', $product_info['added_by'])->first();
        //$colors = colorAssociation::where('product_id', $id)->get();
        $tags = TagAssociation::where('product_id', $id)->get();



        // foreach ($colors as $color) {
        //     if ($color->color_id) {
        //         $color_name = ProductColors::select('name')->where('id', $color->color_id)->first();
        //         array_push($colors_arr, $color_name->name);
        //     }
        // }

        foreach ($tags as $tag) {
            if ($tag->tag_id) {
                $tag_name = Tag::select('name')->where('id', $tag->tag_id)->first();
                array_push($tags_arr, $tag_name->name);
            }
        }

        $data->product = $products_info;
        $data->artist = $artist;
        //$data->colors = $colors_arr;
        $data->tags = $tags_arr;
        return response()->json($data);
    }

    // DELETE PRODUCT
    public function removeProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        DB::table('reviews')->where('product_id', $id)->delete();
        DB::table('color_associations')->where('product_id', $id)->delete();
        DB::table('tag_associations')->where('product_id', $id)->delete();
        DB::table('product_images')->where('product_id', $id)->delete();
        DB::table('product_rates')->where('product_id', $id)->delete();
        return response()->json('Success');
    }

    // UPDATE PRODUCT
    public function updateProduct(Request $request)
    {
        $is_for_company = false;
        $data = $request->validate([
            'name' => 'required|string',
            'size' => 'required|string',
            'price' => 'required',
            'discount' => 'required',
            // 'colors' => 'required',
            'product_type' => 'required',
            'shortDesc' => 'required',
            'longDesc' => 'required',
            'added_by' => 'required',
            'categoryId' => 'required',
            'otherCategoryId' => 'required',
            'thumbnail' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'forwardImage' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'backwardImage' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'tags' => 'required',
            'stock' => 'required',
            'location' => 'required',
            'is_eBook' => 'required',
        ]);

        $thumbnailName = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->thumbnail->getClientOriginalExtension();
        $request->thumbnail->move(public_path('uploads/images'), $thumbnailName);

        $forwardImageName = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->forwardImage->getClientOriginalExtension();
        $request->forwardImage->move(public_path('uploads/images'), $forwardImageName);

        $backwardImageName = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->backwardImage->getClientOriginalExtension();
        $request->backwardImage->move(public_path('uploads/images'), $backwardImageName);

        if ($request->product_owner == "company") {
            $is_for_company = true;
        }


        if ($request->book_pdf) {
            $book_pdf_name = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->book_pdf->getClientOriginalExtension();
            $request->book_pdf->move(public_path('uploads/images'), $book_pdf_name);
        } else {
            $book_pdf_name = "N/A";
        }


        $product = DB::table('products')
            ->where('id', $request->productId)
            ->update([
                'name' => $data['name'],
                'size' => $data['size'],
                'price' => $data['price'],
                'discount' => $data['discount'],
                'shortDesc' => $data['shortDesc'],
                'longDesc' => $data['longDesc'],
                'product_type' => $data['product_type'],
                'book_pdf' => $book_pdf_name,
                'thumbnail' => $thumbnailName,
                'forwardImage' => $forwardImageName,
                'backwardImage' => $backwardImageName,
                'categoryId' => $data['categoryId'],
                'otherCategoryId' => $data['otherCategoryId'],
                'stock' => $data['stock'],
                'location' => $data['location'],
                'is_for_company' => $is_for_company,
                'added_by' => $data['added_by'],
            ]);

        if ($product) {

            // UPDATE PRODUCT TAGS

            // REMOVE PREVIOUS TAGS
            DB::table('tag_associations')->where('product_id', $request->productId)->delete();

            $tags_array = explode(',', $data['tags']);
            foreach ($tags_array as $tag_item) {
                $tags = DB::table('tags')
                    ->select('id')
                    ->where('name', $tag_item)
                    ->get();
                foreach ($tags as $tag) {
                    DB::insert('insert into tag_associations (tag_id, product_id) values (?, ?)', [$tag->id, $request->productId]);
                }
            }

            // UPDATE PRODUCT COLORS

            // REMOVE PREVIOUS COLORS
            // DB::table('color_associations')->where('product_id', $request->productId)->delete();

            // $colors_array = explode(',', $data['colors']);
            // foreach ($colors_array as $color_item) {
            //     $colors = DB::table('product_colors')
            //         ->select('id')
            //         ->where('name', $color_item)
            //         ->limit(1)
            //         ->get();
            //     foreach ($colors as $color) {
            //         DB::insert('insert into color_associations (color_id, product_id) values (?, ?)', [$color->id, $request->productId]);
            //     }
            // }

            // UPDATE PRODUCT IMAGES

            // REMOVE PREVIOUS IMAGES
            DB::table('product_images')->where('product_id', $request->productId)->delete();

            if ($request->hasFile('otherImages')) {
                foreach ($request->otherImages as $image) {
                    $image_name = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/images'), $image_name);

                    // $image_name = 'New-Imanzi-Creations-' . $this->unique_code(9) . '.' . $image->getClientOriginalName();
                    // $image->storeAs('uploads/images', $image_name, 'public');

                    DB::insert('insert into product_images (product_id, name) values (?,?)', [$request->productId, $image_name]);
                }
            }

            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|min:10',
            'address' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'country' => 'required|string',
            'zipCode' => 'required|string',
            'names' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'amount' => 'required',
            'currency' => 'required',
            'transaction_id' => 'required',
            'flw_ref' => 'required',
            'tx_ref' => 'required',
            'status' => 'required'
        ]);
        $cart = $request->cart;
        $cartTotal = $request->cartTotal;
        $userId = $request->userId;

        $shipping = new Shipping([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'zipCode' => $data['zipCode'],
        ]);
        if ($shipping->save()) {
            try {
                $order = new Order([
                    'userId' => $userId,
                    'amount' => $cartTotal,
                    'shippingId' => $shipping->id,
                    'refNo' => 'ORD/' . time(),
                    'orderCompleted' => 'No'
                ]);
                $order->save();
                $transaction = new Transaction([
                    'names' => $data['names'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'order_id' => $order->id,
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'transaction_id' => $data['transaction_id'],
                    'flw_ref' => $data['flw_ref'],
                    'tx_ref' => $data['tx_ref'],
                    'status' => $data['status']
                ]);
                $transaction->save();
                $detail_price = 0;
                for ($i = 0; $i < count($cart); $i++) {

                    if (floatval($cart[$i]['discount']) == 0) {
                        $detail_price = floatval($cart[$i]['price']);
                    } else {
                        $detail_price = floatval($cart[$i]['discounted_price']);
                    }

                    $orderDetail = new OrderDetail([
                        'orderId' => $order->id,
                        'price' => $detail_price,
                        'productId' => $cart[$i]['id'],
                        'unit' => 1,
                        'quantity' => floatval($cart[$i]['quantity']),
                    ]);
                    $orderDetail->save();
                    $product = Product::find($cart[$i]['id']);
                    $product->stock -= $cart[$i]['quantity'];
                    $product->save();
                }
                return response()->json('Success');
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
            // if ($order->save) {
            // } else {
            //     return response()->json('Error');
            // }
        } else {
            return response()->json('Error');
        }
    }

    // ADD REVIEW
    public function addReview(Request $request)
    {
        $data = $request->validate([
            'names' => 'required',
            'email' => 'required',
            'review' => 'required',
            'product_id' => 'required'
        ]);
        $review = new Review([
            'names' => $data['names'],
            'email' => $data['email'],
            'review' => $data['review'],
            'product_id' => $data['product_id'],
            'status' => "Pending"
        ]);
        if ($review->save()) {
            $last = Review::find($review->id);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    // GET REVIEWS
    public function getProductReviews($id)
    {
        $status = "Approved";
        $reviews = DB::table('reviews')
            ->where('product_id', $id)
            ->where('status', $status)
            ->get();
        return response()->json($reviews);
    }

    // GET ALL REVIEWS
    public function getAllReviews()
    {
        $review_info = array();
        $reviews_info = array();
        $reviews = DB::table('reviews')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($reviews as $rev) {
            $review_info['id'] = $rev->id;
            $review_info['names'] = $rev->names;
            $review_info['email'] = $rev->email;
            $review_info['review'] = $rev->review;
            $review_info['status'] = $rev->status;
            $review_info['date'] = $rev->created_at;
            $review_info['product_id'] = $rev->product_id;
            $review_info['product_name'] = $this->get_product_name($rev->product_id);
            $artist_id = $this->get_artist_id($rev->product_id);
            $review_info['artist_name'] = $this->get_artist_name($artist_id);

            array_push($reviews_info, $review_info);
        }
        return response()->json($reviews_info);
    }

    // GET ALL EARNINGS
    public function getAllEarnings()
    {
        $total_amount = 0;
        $earning_info = array();
        $earnings_info = array();
        $earnings = DB::table('transactions')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($earnings as $earn) {
            $earning_info['id'] = $earn->id;
            $earning_info['names'] = $earn->names;
            $earning_info['email'] = $earn->email;
            $earning_info['phone'] = $earn->phone;
            $earning_info['amount'] = $earn->amount;
            $total_amount += $earn->amount;
            $earning_info['total_amount'] = $total_amount;
            $earning_info['currency'] = $earn->currency;
            $earning_info['transaction_id'] = $earn->transaction_id;
            $earning_info['status'] = $earn->status;
            $earning_info['date'] = $earn->created_at;
            $earning_info['order_id'] = $earn->order_id;
            $earning_info['refNo'] = $this->get_order_ref_no($earn->order_id);
            $earning_info['order_details'] = $this->get_order_details($earn->order_id);

            array_push($earnings_info, $earning_info);
        }
        return response()->json($earnings_info);
    }

    // GET MY EARNINGS
    public function getMyEarnings()
    {
        $total_amount = 0;
        $userId = auth()->user()->id;
        $earning_info = array();
        $earnings_info = array();
        $earnings = DB::table('transactions')
            ->join('order_details', 'transactions.order_id', '=', 'order_details.orderId')
            ->join('products', 'products.id', '=', 'order_details.productId')
            ->join('orders', 'orders.id', '=', 'order_details.orderId')
            ->select('transactions.*', 'products.name as product', 'orders.refNo')
            ->where('products.added_by', '=', $userId)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($earnings as $earn) {
            $earning_info['id'] = $earn->id;
            $earning_info['names'] = $earn->names;
            $earning_info['email'] = $earn->email;
            $earning_info['phone'] = $earn->phone;
            $earning_info['amount'] = $earn->amount;
            $total_amount += $earn->amount;
            $earning_info['total_amount'] = $total_amount;
            $earning_info['currency'] = $earn->currency;
            $earning_info['transaction_id'] = $earn->transaction_id;
            $earning_info['status'] = $earn->status;
            $earning_info['date'] = $earn->created_at;
            $earning_info['order_id'] = $earn->order_id;
            $earning_info['refNo'] = $earn->refNo;
            $earning_info['order_details'] = $this->get_order_details($earn->order_id);

            array_push($earnings_info, $earning_info);
        }
        return response()->json($earnings_info);
    }

    public function addRates(Request $request)
    {
        $data = $request->validate([
            'rate_value' => 'required',
            'product_id' => 'required'
        ]);
        $rating = new ProductRate([
            'rate_value' => $data['rate_value'],
            'product_id' => $data['product_id'],
        ]);
        if ($rating->save()) {
            $last = ProductRate::find($rating->id);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }
    public function addViews($product_id)
    {
        $prev_views = $this->get_previous_views($product_id);
        echo "total: " . $prev_views;
    }
    public function updateReview(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'review' => 'required|string|min:2',
        ]);
        $review = Review::find($data['id']);
        if ($review->update($request->all())) {
            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }
    public function publishReview(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|min:1',
            'status' => 'required|string|min:2',
        ]);
        $review = Review::find($data['id']);
        if ($review->update($request->all())) {
            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }
    public function removeReview($id)
    {
        $review = Review::find($id);
        $review->delete();
        return response()->json($id);
    }

    public function approveProduct($id)
    {
        $status = "Approved";
        $product = DB::table('products')
            ->where('id', $id)
            ->update(['status' => $status]);
        if ($product) {
            return response()->json('Success');
        }
    }
    public function rejectProduct($id)
    {
        $status = "Rejected";
        $product = DB::table('products')
            ->where('id', $id)
            ->update(['status' => $status]);
        if ($product) {
            return response()->json('Success');
        }
    }

    public function getGiveAway()
    {
        $product = Product::where('price', 0)->orderBy('created_at', 'DESC')->first();
        return response()->json($product);
    }
}
