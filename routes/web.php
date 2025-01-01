<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\Certificate;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProcessController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\RecognizationController;
use App\Http\Controllers\Admin\SatyaStoryController;
use App\Http\Controllers\Admin\SustainController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppealController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MapController;

Route::resource('/back_team', TeamController::class);
Route::resource('/video', MediaController::class);
Route::resource('/customer', ClientController::class);
Route::resource('/map', MapController::class);
Route::resource('/sustain', SustainController::class);
Route::resource('/document', DocumentController::class);
Route::resource('/recognization', RecognizationController::class);
Route::resource('/quote', QuoteController::class);
Route::resource('/about_us', SatyaStoryController::class);
Route::resource('/operation', ProcessController::class);
Route::resource('/position', CareerController::class);
Route::resource('/appeal', AppealController::class);
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');




Route::get('/admin-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin-login/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
	Route::get('/', 'HomeController@admin')->name('admin');
	Route::group(['namespace' => 'Admin'], function () {
		Route::resource('category', 'CategoryController');
		Route::resource('post', 'PostController');
		Route::resource('product', 'ProductController');
		Route::resource('slider', 'SliderController');
		Route::resource('banner', 'BannerController');

		Route::resource('gallery', 'GalleryController');
		Route::resource('gallery-images', 'GalleryImageController');
		Route::get('/gallery-image/{id}', 'GalleryImageController@GalleryImage')->name('GalleryImage');


		Route::group(['prefix' => '/ordering'], function () {
			Route::get('/ordering-for-faq', 'FaqController@orderingFAQ')->name('faq-ordering');
			Route::post('/ordering-faq-update', 'FaqController@updateFaqOrder')->name('ordering-faq');

			Route::get('/page-ordering/{slug}', 'PageController@orderingPage')->name('page-ordering');
			Route::post('/page-ordering/update', 'PageController@updatePageOrder')->name('pageOrderUpdate');
		});






		Route::group(['prefix' => 'web-setting'], function () {
			Route::get('/', 'SiteController@allInfo')->name('web-setting');
			Route::post('/update-address', 'SiteController@updateAddress')->name('address-update');
		});

		Route::group(['prefix' => 'pages'], function () {
			Route::get('/create-page/{slug}', 'PageController@create')->name('create-page');
			Route::post('/create-page/{slug}', 'PageController@store')->name('create-page');

			Route::get('/edit-page/{slug}/{id}', 'PageController@EditPage')->name('edit-page');
			Route::post('/update-page/{slug}/{id}', 'PageController@update')->name('udpate-page');
			Route::get('/{slug}', 'PageController@pageCategory')->name('pageCategory');
		});


		Route::get('/list-all-message', 'ContactController@listAllMessage')->name('list-all-message');
		Route::get('/delete-message/{id}', 'ContactController@delete')->name('delete-message');


		Route::get('/form_detail', 'AdminController@ListAllDetail')->name('form_detail');
		Route::get('/delete-info/{id}', 'AdminController@delete')->name('delete-info');




		Route::group(['prefix' => 'ajax'], function () {

			Route::post('/check-blog-slug/', 'PostController@checkBlogSlug')->name('checkBlogSlug');
			Route::post('/change-category-status/', 'CategoryController@changeCategoryStatus')->name('changeCategoryStatus');
			Route::get('/get-child-parent-by-main-parent/{cat_id}', 'CategoryController@getSubCatByCatId')->name('getSubCatByCatId');
			Route::put('/product-images-update/{id}', 'ProductController@updateProductImage')->name('product-images-update');
			Route::get('/get-all-image-by-product-id', 'ProductController@getProductImageByProductId')->name('getProductImageByProductId');
			Route::get('/delete-gallery-image', 'ProductController@deleteImageById')->name('deleteImageById');

			Route::post('/change-gallery-status', 'GalleryController@changeGalleryStatus')->name('changeGalleryStatus');
			Route::get('/delete-gallery-image', 'GalleryImageController@deleteGalleryImageById')->name('deleteGalleryImageById');
			Route::get('/get-all-image-by-gallery-id', 'GalleryImageController@getAllImagesByGalleryId')->name('getAllImagesByGalleryId');





			// Route::post('/change-category-status/','CourseCategoryController@changeCategoryStatus')->name('changeCategoryStatus');
			Route::post('/change-slider-status/', 'SliderController@changeSliderStatus')->name('changeSliderStatus');
			Route::post('change-testimonial-status', 'TestimonialController@changeTestimonialStatus')->name('changeTestimonialStatus');

			Route::post('/change-post-status', 'PostController@changePostStatus')->name('changePostStatus');

			Route::post('/change-faq-status', 'FaqController@changeFAQStatus')->name('changeFAQStatus');
			Route::post('/change-page-status', 'PageController@changePageStatus')->name('changePageStatus');
			Route::post('/check-slug', 'PageController@checkSlug')->name('checkSlug');

			// product related ajax
			Route::post('get-child-cat-id-by-category-id/', 'CategoryController@getChildCategoryByCatId')->name('getChildCategoryByCatId');
			//  delete single image on edit product
			Route::post('/delete-product-image', 'ProductController@deleteImageById')->name('deleteImageById');
		});

		Route::get('/edit-product-images-details/{id}', 'ProductController@editProduct')->name('edit-product');
		Route::post('/edit-product-images-details/{id}', 'ProductController@updateProduct')->name('product-update');

		Route::get('/order-list/', 'OrderController@orderList')->name('order-list');
		Route::get('/edit-order/{id}/', 'OrderController@updateOrder')->name('edit-order');
		Route::post('/update-order/{id}', 'OrderController@Update')->name('order_update');
	});
	Route::group(['namespace' => 'Front'], function () {
		Route::get('/all-subscribers', 'SubscriberController@listAllsubscriber')->name('list-subscriber');
		Route::get('/delete-subscriber/{id}', 'SubscriberController@delete')->name('delete-subscriber');
	});
});


// website routing starts from here
Route::group(['prefix' => '/', 'namespace' => 'Front'], function () {
	Route::get('/', 'FrontEndController@homepage')->name('homepage');
	Route::get('all-categories', 'FrontEndController@allCategories')->name('allCategories');

	Route::get('contact-us', 'FrontEndController@contacts')->name('contacts');
	Route::post('/contact-us', 'FrontEndController@submitContact');

	Route::get('apply-us', 'FrontEndController@contacts')->name('applys');
	Route::post('/apply-us', 'FrontEndController@submitCareer');

	Route::get('/about-us', 'FrontEndController@about')->name('about');

	Route::get('/team', 'FrontEndController@team')->name('team');
	Route::get('/sustainibility', 'FrontEndController@sustainibility')->name('sustainibility');
	Route::get('/client', 'FrontEndController@client')->name('client');
	Route::get('/career', 'FrontEndController@career')->name('career');
	Route::get('/media', 'FrontEndController@media')->name('media');
	Route::get('/about', 'FrontEndController@story')->name('story');
	Route::get('/certificate', 'FrontEndController@certificate')->name('certificate');
	Route::get('/process', 'FrontEndController@process')->name('process');

	Route::post('/add-subscriber', 'SubscriberController@addSubscriber')->name('addSubscriber');
	Route::post('/ajax-submit-contact', 'FrontEndController@submitContact')->name('ajax-submit-contact');
	Route::post('/ajax-submit-career', 'FrontEndController@submitContact')->name('ajax-submit-carrer');
	Route::post('/submit-order', 'FrontEndController@SubmitOrder')->name('SubmitOrder');


	Route::group(['prefix' => '/blog'], function () {
		Route::get('/', 'FrontEndController@blogs')->name('blogs');
		Route::get('/{slug}', 'FrontEndController@PostDetail')->name('PostDetail');
	});
	Route::get('/products', 'FrontEndController@allProduct')->name('allProducts');
	Route::get('/frequently-asked-questions', 'FrontEndController@FAQs')->name('faq');
	Route::get('products/buy-now/{slug}', 'FrontEndController@buyNow')->name('buyNow');
	Route::get('/search', 'FrontEndController@SearchProduct')->name('search-product');
	Route::get('/gallery/{slug}', 'FrontEndController@galleryDetail')->name('galleryDetail');
	Route::get('/products/{slug}', 'FrontEndController@ProductDetail')->name('ProductDetail');
	Route::get('/category/{slug}/', 'FrontEndController@getProductByCategory')->name('getProductByCategory');
	Route::get('/categories/{slug}/', 'FrontEndController@getProductByCategories')->name('getProductByCategories');
	Route::get('/sub-categories/{slug}/', 'FrontEndController@getSubcategories')->name('getSubcategories');

	Route::get('/{slug}', 'FrontEndController@pageDetail')->name('pageDetail');
	Route::get('/terms', 'FrontEndController@pageDetail')->name('terms');
	Route::get('/privacy', 'FrontEndController@privacy')->name('privacy');
});
