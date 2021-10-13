<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class SearchEngineController extends Controller
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
    public function DashboardSearch($type, $searchValue)
    {
    }
    public function ShopSearch($searchValue)
    {

        $item_info = array();
        $items_info = array();
        $items = DB::table('products')
            ->where('name', 'like', '%' . $searchValue . '%')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($items as $item) {
            $item_info['id'] = $item->id;
            $item_info['name'] = $item->name;
            $item_info['size'] = $item->size;
            $item_info['price'] = $item->price;
            $item_info['discounted_price'] = $item->price - (($item->price * $item->discount) / 100);
            $item_info['discount'] = $item->discount;
            $item_info['shortDesc'] = $item->shortDesc;
            $item_info['longDesc'] = $item->longDesc;
            $item_info['book_pdf'] = $item->book_pdf;
            $item_info['product_type'] = $item->product_type;
            $item_info['status'] = $item->status;
            $item_info['thumbnail'] = $item->thumbnail;
            $item_info['forwardImage'] = $item->forwardImage;
            $item_info['backwardImage'] = $item->backwardImage;
            $item_info['categoryId'] = $item->categoryId;
            $item_info['category_name'] = $this->get_category_name($item->categoryId);
            $item_info['stock'] = $item->stock;
            $item_info['location'] = $item->location;
            $item_info['added_by'] = $item->added_by;
            $item_info['artist_name'] = $this->get_artist_name($item->added_by);
            $item_info['date'] = $item->created_at;
            $item_info['updated_at'] = $item->updated_at;
            $item_info['reviews_num'] = $this->get_product_reviews($item->id);
            $item_info['reviews'] = Review::where('product_id', $item->id)->get();
            $rating_avg = round($this->get_product_ratings_average($item->id));
            $item_info['ratings_averages'] = $rating_avg;
            $item_info['ratings_percentage'] = round(($rating_avg / 5) * 100);


            array_push($items_info, $item_info);
        }
        return response()->json($items_info);
    }
}
