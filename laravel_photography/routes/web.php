<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotographerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;    
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdvancePaymentController;
use App\Http\Controllers\FullPaymentController;

//----Website Routes----//


Route::get('/', function () {
    return view('website.index');
});

Route::get('/index', function () {
    return view('website.index');
});

Route::get('/about', function () {
    return view('website.about');
});

Route::get('/blogs', function () {
    return view('website.blogs');
});

Route::get('/booking-status', function () {
    return view('website.booking-status');
});

Route::get('/booking', function () {
    return view('website.booking');
});

Route::get('/catalogues', [CatalogueController::class, 'websiteCatalogues']);

Route::get('/categories', [CategoryController::class, 'websiteCategories']);

Route::get('/contact', [EnquiryController::class, 'create']);
Route::post('/contact', [EnquiryController::class, 'store']);

Route::get('/edit_profile', function () {
    return view('website.edit_profile');
});

Route::get('/gallery', [GalleryController::class, 'websiteGallery']);


Route::get('/invoice', function () {
    return view('website.invoice');
});

Route::get('/login', function () {
    return view('website.login');
});

Route::get('/mybooking', function () {
    return view('website.mybooking');
});

Route::get('/notifications', function () {
    return view('website.notifications');
});

Route::get('/packages', [PackageController::class, 'show_package']);

Route::get('/payment-confirm', function () {
    return view('website.payment-confirm');
});

Route::get('/payment-failed', function () {
    return view('website.payment-failed');
});

Route::get('/payment', function () {
    return view('website.payment');
});

Route::get('/private-gallery', function () {
    return view('website.private-gallery');
});

Route::get('/profile', function () {
    return view('website.profile');
});

Route::get('/registration', function () {
    return view('website.registration');
});

Route::get('/submit-review', function () {
    return view('website.submit-review');
});

Route::get('/support', function () {
    return view('website.support');
});

Route::get('/team', function () {
    return view('website.team');
});

Route::get('/testimonial', function () {
    return view('website.testimonial');
});



//----Admin Routes----//

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('add_photographer', [PhotographerController::class, 'create']);
Route::post('add_photographer', [PhotographerController::class, 'store']);

Route::get('edit_photographer/{id}', [PhotographerController::class, 'edit']);
Route::post('edit_photographer/{id}', [PhotographerController::class, 'update']);


Route::get('/photographer_management', [PhotographerController::class, 'show']);
Route::get('delete_photographer/{id}', [PhotographerController::class, 'destroy']);


Route::get('/appointments_management', function () {
    return view('admin.appointments_management');
});

Route::get('/blog_management', function () {
    return view('admin.blog_management');
});

Route::get('/booking_management', function () {
    return view('admin.booking_management');
});

Route::get('add_categories', [CategoryController::class, 'create']);
Route::post('add_categories', [CategoryController::class, 'store']);

Route::get('edit_categories/{id}', [CategoryController::class, 'edit']);
Route::post('edit_categories/{id}', [CategoryController::class, 'update']);

Route::get('/categories_management', [CategoryController::class, 'show']);
Route::get('delete_category/{id}', [CategoryController::class, 'destroy']);



Route::get('add_catalogues', [CatalogueController::class, 'create']);
Route::post('add_catalogues', [CatalogueController::class, 'store']);

Route::get('edit_catalogues/{id}', [CatalogueController::class, 'edit']);
Route::post('edit_catalogues/{id}', [CatalogueController::class, 'update']);

Route::get('/catelogues_management', [CatalogueController::class, 'show']);
Route::get('delete_catalogue/{id}', [CatalogueController::class, 'destroy']);


Route::get('/client_management', [ClientController::class, 'show']);

Route::get('/enquiry_management', [EnquiryController::class, 'show']);

Route::get('/send-mail',[EnquiryController::class,'sendmail']);


Route::get('/feedback_management', function () {
    return view('admin.feedback_management');
});

Route::get('add_gallery', [GalleryController::class, 'create']);
Route::post('add_gallery', [GalleryController::class, 'store']);

Route::get('/gallery_management', [GalleryController::class, 'show']);
Route::get('delete_gallery/{id}', [GalleryController::class, 'destroy']);

Route::get('edit_gallery/{id}', [GalleryController::class, 'edit']);
Route::post('edit_gallery/{id}', [GalleryController::class, 'update']);

Route::get('/invoice_management', function () {
    return view('admin.invoice_management');
});

Route::get('/notifications_management', function () {
    return view('admin.notifications_management');
});

Route::get('/package_management', [PackageController::class, 'show']);
Route::get('add_packages', [PackageController::class, 'create']);
Route::post('add_packages', [PackageController::class, 'store']);
Route::get('edit_packages/{id}', [PackageController::class, 'edit']);
Route::post('edit_packages/{id}', [PackageController::class, 'update']);
Route::get('delete_package/{id}', [PackageController::class, 'destroy']);

Route::get('/slot_management', [SlotController::class, 'show']);
Route::get('add_slots', [SlotController::class, 'create']);
Route::post('add_slots', [SlotController::class, 'store']);
Route::get('edit_slots/{id}', [SlotController::class, 'edit']);
Route::post('edit_slots/{id}', [SlotController::class, 'update']);
Route::get('delete_slot/{id}', [SlotController::class, 'destroy']);

Route::get('/private-gallery', function () {
    return view('admin.private-gallery');
});

Route::get('/support_ticket_management', function () {
    return view('admin.support_ticket_management');
});

Route::get('/reports', function () {
    return view('admin.reports');
});

Route::get('/advance_payment', function () {
    return view('admin.advance_payment');
});

Route::get('/full_payment', function () {
    return view('admin.full_payment');
});

Route::get('/feedback_management', function () {
    return view('admin.feedback_management');
});

Route::get('/feedback_management', function () {
    return view('admin.feedback_management');
});

Route::get('/feedback_management', function () {
    return view('admin.feedback_management');
});




