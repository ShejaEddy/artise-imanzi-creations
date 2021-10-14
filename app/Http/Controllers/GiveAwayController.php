<?php

namespace App\Http\Controllers;

use App\Models\GiveAway;
use Illuminate\Http\Request;

class GiveAwayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = GiveAway::with('product')->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(Request $request)
    {
        $giveAway_id = $request->route('id');
        $data = GiveAway::find($giveAway_id);
        if ($data) {
            $data->update(['sent' => !$data->sent]);
            return response()->json($data);
        } else {
            return response()->json('Give away not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_names' => 'required|string',
            'phone' => 'required|string',
            'product_id' => 'required|exists:products,id'
        ]);

        $result = GiveAway::create($data);
        response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiveAway  $giveAway
     * @return \Illuminate\Http\Response
     */
    public function show(GiveAway $giveAway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiveAway  $giveAway
     * @return \Illuminate\Http\Response
     */
    public function edit(GiveAway $giveAway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiveAway  $giveAway
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiveAway $giveAway)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiveAway  $giveAway
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiveAway $giveAway)
    {
        //
    }
}
