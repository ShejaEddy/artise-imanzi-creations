<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use App\Models\UserSocialAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class SocialAuthController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        return view('welcome');
    }
    public function SocialSignup($provider)
    {
        // Socialite will pick response data automatic
        $user = Socialite::driver($provider)->stateless()->user();

        return response()->json($user);
    }
    public function redirectToProvider(Request $request)
    {
        $url = Socialite::driver($request->provider)->stateless()->redirect()->getTargetUrl();
        return response()->json(["url" => $url]);
    }

    public function handleProviderCallback(Request $request)
    {

        $role = $request->role;
        $user = "Empty";

        try {
            $user = Socialite::driver($request->provider)->stateless()->user();
            dd($user);
            exit();
        } catch (Exception $e) {
            echo $e;
        }


        if ($user->token) {
            // Check if this user already exists
            $user_exists = User::whereEmail($user->email)->first();
            if (!$user_exists) {
                // dd("Don't exist", $role);
                // Create user and add the provider
                $add_user = User::create([
                    'names' => $user->name,
                    'email' => $user->email,
                    'phone' => "N/A",
                    'password' => HASH::make('justdoit!'),
                    'city' => 'N/A',
                    'country' => 'N/A',
                    'role' => $role,
                ]);

                if ($add_user) {
                    // Adding the provider
                    $add_user_provider = UserSocialAccount::create([
                        'user_id' => $add_user->id,
                        'provider_user_id' => $user->id,
                        'provider' => $request->provider,
                    ]);

                    if (!$add_user_provider) {
                        return response()->json(['Error' => 'adding provider failure']);
                    }
                } else {
                    return response()->json(['Error' => 'adding user failure']);
                }
            } else {
                // this means that the user exists
                // Check if his provider exists
                $provider_exists = UserSocialAccount::select('provider')
                    ->where('provider', $request->provider)
                    ->where('provider_user_id', $user->id)
                    ->first();
                if (!$provider_exists) {
                    $add_user_provider = UserSocialAccount::create([
                        'user_id' => $user_exists->id,
                        'provider_user_id' => $user->id,
                        'provider' => $request->provider,
                    ]);
                }
            }
            $token = $user_exists->createToken('anonymous-token')->plainTextToken;
            $user_info = User::whereEmail($user->email)->first();

            // login our user and send the token
            $response = [
                'user' => $user_info,
                'token' => $token
            ];

            return response($response, 201);
        } else {
            return response()->json(["error" => "token missing"]);
        }
    }
}
