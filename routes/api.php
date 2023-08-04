<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Buyer
Route::resource('buyers','Buyer\BuyerController',['only' => ['index','show']]);

// Buyer Transaction
Route::resource('buyers.transactions','Buyer\BuyerTransactionController',['only' => 'index']);

// Buyer Product
Route::resource('buyers.products','Buyer\BuyerProductController',['only' => 'index']);

// Buyer Seller
Route::resource('buyers.sellers','Buyer\BuyerSellerController',['only' => 'index']);

// Buyer Seller
Route::resource('buyers.categories','Buyer\BuyerCategoryController',['only' => 'index']);

// Categories
Route::resource('categories','Category\CategoryController',['except' => ['create','edit']]);

// Products
Route::resource('products','Product\ProductController',['except' => ['index','show']]);

// Sellers
Route::resource('products','Product\ProductController',['only' => ['index','show']]);

// Transactions
Route::resource('transactions','Transaction\TransactionController',['only' => ['index','show']]);

// Transactions
Route::resource('sellers','Seller\SellerController',['only' => ['index','show']]);

// Users
Route::resource('users','User\UserController',['except' => ['create','edit']]);


// Transaction Category
Route::resource('transaction.categories','Transaction\TransactionCategoryController',['only' => ['index']]);

// Transaction Seller
Route::resource('transaction.sellers','Transaction\TransactionSellerController',['only' => ['index']]);

// Category Product
Route::resource('categories.products','Category\CategoryProductController',['only' => ['index']]);

// Category Seller
Route::resource('categories.sellers','Category\CategorySellerController',['only' => ['index']]);

// Category Transaction
Route::resource('categories.transactions','Category\CategoryTransactionController',['only' => ['index']]);

// Category Buyer
Route::resource('categories.buyers','Category\CategoryBuyerController',['only' => ['index']]);

Route::resource('sellers.transactions','Seller\SellerTransactionController',['only' => ['index']]);

Route::resource('sellers.categories','Seller\SellerCategoryController',['only' => ['index']]);


Route::resource('sellers.buyers','Seller\SellerBuyerController',['only' => ['index']]);

