<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdvertsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\GiveAwayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchEngineController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\GiveAway;

/*----------------------DASHBOARDS API-----------------------*/

// USER MANAGEMENT
Route::middleware('auth:sanctum')->post('/add-artist', [UserController::class, 'addartist']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/get-users', [UserController::class, 'getUsers']);
Route::middleware('auth:sanctum')->get('/get-user/{id}', [UserController::class, 'getUser']);
Route::middleware('auth:sanctum')->post('/admin-update-user', [UserController::class, 'updateUser']);
Route::middleware('auth:sanctum')->get('/remove-user/{id}', [UserController::class, 'removeUser']);

// USER MANAGEMENT --END



// PRODUCT API
Route::middleware('auth:sanctum')->post('/add-product', [ProductController::class, 'addProduct']);
Route::get('/get-products', [ProductController::class, 'getProducts']);
Route::get('/get-company-products', [ProductController::class, 'getCompanyProducts']);
Route::get('/get-shop-products', [ProductController::class, 'getShopProducts']);
Route::get('/get-my-products/{id}', [ProductController::class, 'getMyProducts']);
Route::get('/get-product/{id}', [ProductController::class, 'getProduct']);
Route::middleware('auth:sanctum')->post('/update-product', [ProductController::class, 'updateProduct']);
Route::middleware('auth:sanctum')->get('/remove-product/{id}', [ProductController::class, 'removeProduct']);
Route::post('/add-review', [ProductController::class, 'addReview']);
Route::get('/get-reviews/{id}', [ProductController::class, 'getProductReviews']);
Route::get('/get-all-reviews', [ProductController::class, 'getAllReviews']);
Route::post('/add-rate', [ProductController::class, 'addRates']);
Route::middleware('auth:sanctum')->get('/remove-review/{id}', [ProductController::class, 'removeReview']);
Route::middleware('auth:sanctum')->post('/update-review', [ProductController::class, 'updateReview']);
Route::middleware('auth:sanctum')->post('/publish-review', [ProductController::class, 'publishReview']);
Route::middleware('auth:sanctum')->get('/approve-product/{id}', [ProductController::class, 'approveProduct']);
Route::middleware('auth:sanctum')->get('/reject-product/{id}', [ProductController::class, 'rejectProduct']);
Route::middleware('auth:sanctum')->get('/get-all-earnings', [ProductController::class, 'getAllEarnings']);
Route::middleware('auth:sanctum')->get('/get-my-earnings', [ProductController::class, 'getMyEarnings']);
Route::middleware('auth:sanctum')->get('/give-aways', [GiveAwayController::class, 'index']);
Route::middleware('auth:sanctum')->post('/give-aways/{id}/toggle', [GiveAwayController::class, 'toggleStatus']);
Route::get('/add-views/{product_id}', [ProductController::class, 'addViews']);
Route::get('/give-away', [ProductController::class, 'getGiveAway']);
Route::post('/give-away', [GiveAwayController::class, 'store']);

// PRODUCT API--END

// PRODUCT CATEGORIES
Route::middleware('auth:sanctum')->post('/add-category', [CategoryController::class, 'addCategory']);
Route::middleware('auth:sanctum')->post('/add-company-category', [CategoryController::class, 'addCompanyCategory']);
Route::middleware('auth:sanctum')->post('/update-company-category', [CategoryController::class, 'updateCompanyCategory']);
Route::get('/get-categories', [CategoryController::class, 'getCategories']);
Route::get('/get-company-categories', [CategoryController::class, 'getCompanyCategories']);
Route::get('/get-extracted-categories', [CategoryController::class, 'getExtractedCategories']);
Route::get('/get-other-categories', [CategoryController::class, 'getOtherCategories']);
Route::middleware('auth:sanctum')->get('/get-category/{id}', [CategoryController::class, 'getCategory']);
Route::middleware('auth:sanctum')->post('/update-category', [CategoryController::class, 'updateCategory']);
Route::middleware('auth:sanctum')->get('/remove-category/{id}', [CategoryController::class, 'removeCategory']);
// PRODUCT CATEGORIES--END

// PRODUCT TAGS
Route::middleware('auth:sanctum')->post('/add-tag', [TagController::class, 'addProductTag']);
Route::get('/get-tags', [TagController::class, 'getProductTags']);
Route::middleware('auth:sanctum')->post('/update-tag', [TagController::class, 'updateProductTag']);
Route::middleware('auth:sanctum')->get('/remove-tag/{id}', [TagController::class, 'removeProductTag']);
// PRODUCT TAGS--END

// ORDERS
Route::middleware('auth:sanctum')->get('/get-orders', [OrderController::class, 'getOrders']);
Route::middleware('auth:sanctum')->get('/get-my-orders', [OrderController::class, 'getMyOrders']);
Route::middleware('auth:sanctum')->get('/get-product-orders', [OrderController::class, 'getProductOrders']);
Route::middleware('auth:sanctum')->get('/get-order-details', [OrderController::class, 'getOrderDetails']);
Route::middleware('auth:sanctum')->post('/complete-order', [OrderController::class, 'orderCompletion']);
Route::middleware('auth:sanctum')->post('/artist-confirmation', [OrderController::class, 'artistConfirmation']);
// ORDERS--END

// PRODUCT COLORS
Route::middleware('auth:sanctum')->get('/get-colors', [ColorController::class, 'getProductColors']);
// PRODUCT COLORS--END

// Blog API
Route::middleware('auth:sanctum')->post('/add-post', [PostsController::class, 'addPost']);
Route::post('/update-post', [PostsController::class, 'updatePost']);
Route::get('/get-posts', [PostsController::class, 'getPosts']);
Route::get('/get-single-post/{postId}', [PostsController::class, 'getSinglePost']);
Route::get('/publish-post/{postId}', [PostsController::class, 'publishPost']);
Route::get('/remove-post/{postId}', [PostsController::class, 'removePost']);
Route::get('/search-post/{searchFor}', [PostsController::class, 'searchPost']);

// Blog API--END

// Adverts API
//Route::middleware('auth:sanctum')->post('/add-advert', [AdvertsController::class, 'addAdvert']);
Route::get('/get-adverts', [AdvertsController::class, 'getAdverts']);
Route::middleware('auth:sanctum')->post('/add-advert', function (Request $request) {
    echo $request->left_advert->getClientOriginalExtension();
    return;
});
// Adverts API--END

// Slides API
Route::middleware('auth:sanctum')->post('/add-slide', [SliderController::class, 'addSlide']);
Route::get('/get-slides', [SliderController::class, 'getSlides']);
Route::middleware('auth:sanctum')->get('/get-slide/{slideId}', [SliderController::class, 'getSlide']);
Route::middleware('auth:sanctum')->post('/update-slide', [SliderController::class, 'updateSlide']);
Route::middleware('auth:sanctum')->get('/remove-slide/{slideId}', [SliderController::class, 'removeSlide']);
// Slides API--END

// Pages API
Route::middleware('auth:sanctum')->post('/add-page', [PagesController::class, 'addPage']);
Route::get('/get-pages', [PagesController::class, 'getPages']);
Route::middleware('auth:sanctum')->get('/get-page/{pageId}', [PagesController::class, 'getPage']);
Route::middleware('auth:sanctum')->post('/update-page', [PagesController::class, 'updatePage']);
Route::middleware('auth:sanctum')->get('/remove-page/{pageId}', [PagesController::class, 'removePage']);
Route::post('send-mail', [PagesController::class, 'ContactUsMailRequest']);
// Pages API --END

// Searching API
Route::middleware('auth:sanctum')->get('/dashboard-search/{type}/{searchValue}', [SearchEngineController::class, 'DashboardSearch']);
Route::get('/shop-search/{searchValue}', [SearchEngineController::class, 'ShopSearch']);
// Searching API--END


/*----------------------DASHBOARDS API --END-----------------------*/


/*----------------------MARKET API-----------------------*/

/*-------------  CHECKOUT---------*/
Route::middleware('auth:sanctum')->post('/checkout', [ProductController::class, 'checkout']);
/*-------------  CHECKOUT---------*/

/*----------------------MARKET API --END-----------------------*/


/*----------------------SOCIAL AUTH APIs-----------------------*/
Route::get('social-auth/{provider}/redirect', [SocialAuthController::class, 'RedirectToProvider']);
//Route::get('social-auth/{role}/{provider}/callback/{payload}', [SocialAuthController::class, 'HandleProviderCallback']);
Route::get('social-auth/callback/{payload}', [SocialAuthController::class, 'HandleProviderCallback']);

Route::post('sociallogin/{provider}', [SocialAuthController::class, 'SocialSignup']);
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'index']);
/*----------------------SOCIAL AUTH APIs --END-----------------------*/


/*----------------------LOGIN, LOGOUT & REGISTER API-----------------------*/
Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !HASH::check($request->password, $user->password)) {
        return response([
            'message' => 'These credentials do not match out records.',
            'errors' => [
                "email" => false,
                "password" => false
            ],
        ], 404);
    }

    $token = $user->createToken('anonymous-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

Route::post('/logout', function (Request $request) {
    $user = User::where('id', $request->userId)->first();
    $user->tokens()->where('tokenable_id', $request->userId)->delete();
    return response()->json('success');
});

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'names' => 'required|min:3|string|max:255',
        'email' => 'required|email|unique:users',
        'phone' => 'required|min:10',
        'address' => 'min:3|string',
        'country' => 'required|min:3|string',
        'city' => 'required|min:3|string',
        'zipCode' => 'min:3|string',
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
});
/*----------------------LOGIN, LOGOUT & REGISTER API--END-----------------------*/
/*----------------------UPDATE USER & CHANGE PASSWORD API -----------------------*/
Route::middleware('auth:sanctum')->post('/update-user', 'UserController@update');
Route::middleware('auth:sanctum')->post('/change-password', 'UserController@changePassword');
/*----------------------UPDATE USER & CHANGE PASSWORD API--END-----------------------*/

Route::post('/reset-password-request', 'UserController@ResetPasswordRequest');
Route::post('/reset-password', 'UserController@ResetPassword');
