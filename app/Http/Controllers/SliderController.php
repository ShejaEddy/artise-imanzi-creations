<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    // GENERATE UNIQUE IDs
    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    public function addSlide(Request $request)
    {
        $data = $request->validate([
            'slide_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
            'slide_caption'  => 'required',
            'slide_order'  => 'required|min:1'
        ]);

        $slide_image = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->slide_image->getClientOriginalExtension();
        $request->slide_image->move(public_path('uploads/images'), $slide_image);

        $slide = new Slider([

            'slide_image' => $slide_image,
            'slide_caption' => $data['slide_caption'],
            'slide_order' => $data['slide_order'],
            'status' => 'show',
        ]);

        if ($slide->save()) {
            $last = Slider::find($slide->id);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    public function updateSlide(Request $request)
    {
        $slide_image = "";
        $slide = null;
        if ($request->slide_image == '') {
            $data = $request->validate([
                'slide_caption'  => 'required',
                'slide_order'  => 'required|min:1'
            ]);
            $slide = DB::table('sliders')
                ->where('id', $request->slideId)
                ->update([
                    'slide_caption' => $data['slide_caption'],
                    'slide_order' => $data['slide_order'],
                    'status' => 'show',
                ]);
        } else {
            $data = $request->validate([
                'slide_image' => 'required|mimes:jpg,gif,png,jpeg,svg,webp|max:2048',
                'slide_caption'  => 'required',
                'slide_order'  => 'required|min:1'
            ]);
            $slide_image = 'Imanzi-Creations-' . $this->unique_code(9) . '.' . $request->slide_image->getClientOriginalExtension();
            $request->slide_image->move(public_path('uploads/images'), $slide_image);
            $slide = DB::table('sliders')
                ->where('id', $request->slideId)
                ->update([
                    'slide_image' => $slide_image,
                    'slide_caption' => $data['slide_caption'],
                    'slide_order' => $data['slide_order'],
                    'status' => 'show',
                ]);
        }



        if ($slide) {
            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }

    public function getSlides()
    {
        $slide_info = array();
        $slides_info = array();
        $slides = DB::table('sliders')->orderByRaw('slide_order ASC')
            ->get();
        foreach ($slides as $slide) {
            $slide_info['id'] = $slide->id;
            $slide_info['slide_image'] = $slide->slide_image;
            $slide_info['slide_caption'] = $slide->slide_caption;
            $slide_info['slide_order'] = $slide->slide_order;
            $slide_info['status'] = $slide->status;
            array_push($slides_info, $slide_info);
        }
        return response()->json($slides_info);
    }

    public function getSlide($id)
    {
        $slide_info = array();
        $slides_info = array();
        $slides = DB::table('sliders')->where('id', $id)->orderByRaw('slide_order ASC')
            ->get();
        foreach ($slides as $slide) {
            $slide_info['id'] = $slide->id;
            $slide_info['slide_image'] = $slide->slide_image;
            $slide_info['slide_caption'] = $slide->slide_caption;
            $slide_info['slide_order'] = $slide->slide_order;
            $slide_info['status'] = $slide->status;
            array_push($slides_info, $slide_info);
        }
        return response()->json($slides_info);
    }

    public function removeSlide($id)
    {
        $slide = Slider::find($id);
        $slide->delete();
        return response()->json($id);
    }
}
