<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function get_artist_products_num($id)
    {
        $products = DB::table('products')
            ->where('added_by', '=', $id)
            ->count();

        return $products;
    }
    public function get_client_orders_num($id)
    {
        $orders = DB::table('orders')
            ->where('userId', '=', $id)
            ->count();

        return $orders;
    }

    public function getUsers()
    {
        $user_info = array();
        $users_info = array();
        $users = User::all();
        foreach ($users as $user) {
            $user_info['id'] = $user->id;
            $user_info['names'] = $user->names;
            $user_info['email'] = $user->email;
            $user_info['phone'] = $user->phone;
            $user_info['address'] = $user->address;
            $user_info['city'] = $user->city;
            $user_info['country'] = $user->country;
            $user_info['role'] = $user->role;
            $user_info['zipCode'] = $user->zipCode;
            $user_info['date'] = $user->created_at;

            if ($user->role === "client") {
                $user_info['orders_num'] = $this->get_client_orders_num($user->id);
            } elseif ($user->role === "artist") {
                $user_info['products_num'] = $this->get_artist_products_num($user->id);
            }

            array_push($users_info, $user_info);
        }
        return response()->json($users_info);
    }

    public function getUser($id)
    {
        $users = User::where('id', $id)->first();
        return response()->json($users);
    }
    public function update(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'required|min:3|string|max:255',
            'lastName' => 'nullable|min:3|string|max:255',
            'id' => 'required|integer',
            'email' => 'required|min:3|string',
            'phone' => 'required|min:10',
            'address' => 'nullable|string',
            'country' => 'required|min:3|string',
            'city' => 'required|min:3|string',
            'zipCode' => 'nullable|string',
            'role' => 'required|min:3|string'
        ]);
        if (!empty($data['lastName'])) {
            $data['names'] = $data['firstName'] . " " . $data['lastName'];
        } else {
            $data['names'] = $data['firstName'];
        }
        $user = User::find($data['id']);
        if ($user->update($data)) {
            return response()->json($user);
        } else {
            return response()->json('Error');
        }
    }
    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'password' => 'required|min:3|string|confirmed'
        ]);
        try {
            $user = User::find($request->id);
            $user->password = HASH::make($request->password);
            $user->save();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        return response()->json('Success');
    }

    public function addartist(Request $request)
    {
        $data = $request->validate([
            'names' => 'required|min:3|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10',
            'address' => 'required|min:3|string',
            'country' => 'required|min:3|string',
            'city' => 'required|min:3|string',
            'zipCode' => 'required|min:3|string',
            'role' => 'required|min:3|string',
            'password' => 'required|min:6'
        ]);
        $user = User::create([
            'names' => $data['names'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'country' => $data['country'],
            'city' => $data['city'],
            'zipCode' => $data['zipCode'],
            'role' => $data['role'],
            'password' => HASH::make($data['password']),
        ]);

        if ($user) {
            return response()->json('Success');
        } else {
            return response()->json('Error');
        }
    }

    // UPDATE CATEGORY
    public function updateUser(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'names' => 'required|min:3|string|max:255',
            'email' => 'required|min:3|string',
            'phone' => 'required|min:10',
            'address' => 'nullable|string',
            'country' => 'required|min:3|string',
            'city' => 'required|min:3|string',
            'zipCode' => 'nullable|string',
        ]);

        $user = DB::table('users')
            ->where('id', $data['id'])
            ->update([
                'names' => $data['names'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'country' => $data['country'],
                'city' => $data['city'],
                'zipCode' => $data['zipCode'],
            ]);
        if ($user) {
            $user_info = array();
            $_user_info = array();
            $user = User::where('id', $data['id'])->first();
            $user_info['id'] = $user->id;
            $user_info['names'] = $user->names;
            $user_info['email'] = $user->email;
            $user_info['phone'] = $user->phone;
            $user_info['address'] = $user->address;
            $user_info['city'] = $user->city;
            $user_info['country'] = $user->country;
            $user_info['role'] = $user->role;
            $user_info['zipCode'] = $user->zipCode;
            $user_info['date'] = $user->created_at;
            $user_info['message'] = 'Success';
            array_push($_user_info, $user_info);
            return response()->json($_user_info);
        } else {
            return response()->json('Error');
        }
    }

    public function removeUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json($id);
    }

    public function ResetPasswordRequest(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // storing the verification code in session
            $request->session()->put('vcode', $request->vcode);

            $vcode = $request->vcode;
            $details = [
                'title' => 'Mail from Artise.africa',
                'code' => $vcode
            ];

            Mail::to($request->email)->send(new \App\Mail\ResetPasswordMail($details));
            return response()->json("sent");
        } else {
            echo "not found";
        }
    }
    public function ResetPassword(Request $request)
    {
        $data = $request->validate([
            'vcode' => 'required|integer|min:8',
            'password' => 'required|min:8|string',
            'email' => 'required|min:8|string'
        ]);
        $vcode = $data['vcode'];
        $stored_vcode = $request->session()->pull('vcode');


        if ($stored_vcode == $vcode) {
            try {
                $user = User::where('email', $data['email'])->first();
                $user->password = HASH::make($data['password']);
                $user->save();
            } catch (\Exception $e) {
                return response()->json($e->getMessage());
            }
            return response()->json('Success');
        } else {
            return response()->json('Mismatch');
        }
    }
}
