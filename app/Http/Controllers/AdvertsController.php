<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use Illuminate\Support\Facades\DB;

class AdvertsController extends Controller
{
    // GENERATE UNIQUE IDs
    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    public function addAdvert(Request $request)
    {
        $data = $request->validate([
            'left_advert' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'right_advert' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
        ]);

        echo $request;
        return;

        $left_advert_img = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->left_advert->getClientOriginalExtension();
        $request->left_advert->move(public_path('uploads/images'), $left_advert_img);

        $right_advert_img = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->right_advert->getClientOriginalExtension();
        $request->right_advert->move(public_path('uploads/images'), $right_advert_img);

        $advert = new Advert([
            'left_advert' => $left_advert_img,
            'right_advert' => $right_advert_img,
            'status' => 'Published',
        ]);

        $count_ads = 0;
        $count_ads = DB::table('adverts')->count();

        if ($count_ads > 0) {
            $cleaned = DB::table('adverts')->delete();
            if ($cleaned) {
                if ($advert->save()) {
                    $last = Advert::find($advert->id);
                    return response()->json($last);
                } else {
                    return response()->json('Error');
                }
            }
        } else {
            if ($advert->save()) {
                $last = Advert::find($advert->id);
                return response()->json($last);
            } else {
                return response()->json('Error');
            }
        }
    }

    public function getAdverts()
    {
        $advert_info = array();
        $adverts_info = array();
        $adverts = DB::table('adverts')->get();
        foreach ($adverts as $advert) {
            $advert_info['id'] = $advert->id;
            $advert_info['left_advert'] = $advert->left_advert;
            $advert_info['right_advert'] = $advert->right_advert;
            $advert_info['status'] = $advert->status;
            array_push($adverts_info, $advert_info);
        }
        return response()->json($adverts_info);
    }
}
