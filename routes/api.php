<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//https://blog.pusher.com/laravel-jwt/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/email','EmailListController@store');
//Route::post('/auth/create','Modules\User\UserController@createAccount');
Route::group ( ['namespace'=>'Modules\User','prefix'=>'auth'], function(){ //No authentication //todo :: done

    Route::post('create','AuthController@createAccount'); //done
    Route::post('login','AuthController@loginUser'); //done
    Route::patch('verify/{email}/{pin}','AuthController@verifyAccount'); //done
    Route::get('forgotPassword/{url_path}/{email}','AuthController@forgotPassword'); //done
    Route::post('resetpassword','AuthController@resetPassword'); //done
    Route::post('/photographer/create','AuthController@createQuickAccountForPhotographer'); //done

} );

Route::group( ['namespace'=>'Modules\User','prefix'=>'user'], function(){ //User Module
    Route::get('profile','UserController@loadProfile');
    Route::get('/','UserController@getUserByToken'); //done
    Route::get('id/{id}','UserController@getUserById');//done
    Route::post('archive/{id}','UserController@archiveUser'); //done
    Route::patch('update','UserController@updateUser'); //done

} );


Route::group( ['namespace'=>'Modules\Photographer','prefix'=>'photographer'], function(){ //Photographer Module
    Route::post('search','PhotographerController@searchPhotographers'); //done
    Route::post('setupPhotographerPortfolioCategories','PhotographerController@addPhotographerCategory');

    Route::get('/{photographer_id}/portfolio/images/{category_key}','PhotographerProfileImagesController@getPhotographerPortfolioImages');
    Route::get('/{photographer_id}/profile/images/{category_key}','PhotographerProfileImagesController@getPhotographerProfileImages');

    Route::get('/calendar/{photographer_id}/{start_date}/{end_date}','PhotographerController@getPhotographerCalendarSchedules');  // todo
    Route::post('/calendar','PhotographerController@addCalendarSchedule');

    Route::get('/notification/setting','PhotographerController@getPhotographerNotificationSettings');

    Route::get('/carddetails/{photographer_id}','PhotographerController@getPhotographerATMCardDetails');
    Route::post('/carddetails','PhotographerController@savePhotographerATMCardDetails');

    Route::patch('/bvn','PhotographerController@updateBVN');  // todo

    Route::get('/details','PhotographerController@getProfileDetails');

    Route::get('/{photographer_id}/categories/images','PhotographerProfileImagesController@getPhotographerCategoriesImages');

    Route::get('/categories/images/hpsi/random/{count}','PhotographerProfileImagesController@getRandomHPSIImages');
    Route::group( ['middleware'=>'jwt.auth'], function() { //Photographer Module //
        Route::get('profile','PhotographerController@loadProfile');
        Route::post('join','PhotographerController@join');
        Route::get('/','PhotographerController@getAuthPhotographer'); //done
        Route::get('id/{id}','PhotographerController@getPhotographerById');
        Route::put('/','PhotographerController@update');
        Route::post('profile/images','PhotographerProfileImagesController@addPhotographerProfileImages');

        Route::group(['prefix'=>'bankdetails'],function(){
            Route::get('/','PhotographerController@getBankDetails');
            Route::get('/{id}','PhotographerController@getBankDetailsById');  // todo
            Route::post('/','PhotographerController@addBankDetails'); // todo
            Route::patch('/{id}','PhotographerController@updateBankDetails');  // todo
            Route::delete('/{id}','PhotographerController@deleteBankDetails');  // todo
        });

        Route::group(['prefix'=>'pricingpackage'],function(){
            Route::get('/','PhotographerController@getPhotographerPricingPackages');  // todo
            Route::get('/{id}','PhotographerController@getPricingPackageById');  // todo
            Route::post('','PhotographerController@savePhotographerPackage'); // todo
            Route::delete('/{pricingpackage_id}','PhotographerController@deletePhotographerPackage');  // todo
            Route::patch('/{id}','PhotographerController@updatePhotographerPricing');  // todo

            Route::group(['prefix'=>'item'],function(){
                Route::post('/{package_id}','PhotographerController@addPricingPackageItemToPackage');  // todo
                Route::delete('/{id}','PhotographerController@deletePhotographerPricingItem');  // todo
                Route::patch('/{id}','PhotographerController@updatePhotographerPricingItem');  // todo
            });

        });

        Route::group(['prefix'=>'calendar'],function(){

            Route::post('/','PhotographerController@addBookingCalendar'); // todo //make sure you can't add to already occupied date
//            Route::patch('/{id}','PhotographerController@updateBankDetails');  // todo
//            Route::delete('/{id}','PhotographerController@deleteBankDetails');  // todo
        });

        Route::group(['prefix'=>'portfolio'],function(){
         //   Route::post('/','PhotographerController@addPortfolio');  // todo
            Route::put('/','PhotographerController@addImageToCategory'); // todo
            Route::patch('/category/{from}/{to}','PhotographerController@updatePortfolioImagesCategory');  // todo

//            Route::delete('/{id}','PhotographerController@deleteBankDetails');  // todo
            Route::delete('/{category_id}','PhotographerController@deleteImagesInCategory');  // todo

        });

        Route::group(['prefix'=>'bookings'],function(){
            Route::get('/','PhotographerController@getPhotographerBookings'); // todo

        });
    });
} );

//Route::group(['namespace'=>'Modules\Photographer','prefix'=>'photographer/bankdetails','middleware'=>'jwt.auth'],function(){
//    Route::get('/{id}','PhotographerController@getBankDetailsById');  // todo
//    Route::post('','PhotographerController@addBankDetails'); // todo
//    Route::patch('/{id}','PhotographerController@updateBankDetails');  // todo
//    Route::delete('/{id}','PhotographerController@deleteBankDetails');  // todo
//});

Route::group( ['namespace'=>'Modules\FAQ','prefix'=>'faq'], function(){ //todo :FindMyFace
    Route::post('/','FAQController@addFAQ'); //add FAQ //done
    Route::get('/','FAQController@getFAQs'); //get FAQs  //done
    Route::patch('/{id}','FAQController@updateFAQ'); //update FAQ //done
} );

Route::group( ['namespace'=>'Modules\Image','prefix'=>'image'], function(){ //SupportTicket Module
    Route::post('add','ImageController@addImage');
    Route::get('id/{id}','ImageController@getImage');
    Route::patch('archive/{id}','ImageController@archiveImage');
    Route::patch('update/{id}','ImageController@updateImage');
} );

Route::group( ['namespace'=>'Modules\Album','prefix'=>'album'], function(){ //Album Module
    Route::post('create','AlbumController@create');
    Route::get('id/{id}','AlbumController@getAlbum');
    Route::get('user','AlbumController@getUserAlbum');
    Route::patch('archive/{id}','AlbumController@archiveAlbum');
    Route::patch('/','AlbumController@updateAlbum');
    //share album with emails
    Route::post('share','AlbumController@shareAlbum');
} );

Route::group( ['namespace'=>'Modules\Notifications','prefix'=>'notification'], function(){ //Notification Module
    Route::post('add','NotificationController@addNotification');
    Route::get('id/{id}','NotificationController@getNotification');
    Route::get('user','NotificationController@getUserNotifications');
    Route::patch('archive/{id}','NotificationController@archiveNotification');
    Route::patch('/','NotificationController@updateNotification');
} );

Route::group( ['namespace'=>'Modules\Studio','prefix'=>'studio'], function(){ //Studio Module
    Route::post('add','StudioController@addStudio');
    Route::get('/','StudioController@searchStudios');
    Route::get('id/{id}','StudioController@getStudio');
    Route::patch('archive/{id}','StudioController@archiveStudio');
    Route::patch('/','StudioController@updateStudio');
} );

//0049195978, Access Bank, Juliana

Route::group( ['namespace'=>'Modules\Job','prefix'=>'job'], function(){ //Job Module
    Route::post('create','JobController@addJob');
    Route::get('/','JobController@searchJobs');
    Route::get('id/{id}','JobController@getJobById');
    Route::patch('archive/{id}','JobController@archiveJob');
    Route::patch('/','JobController@updateJob');
} );

Route::group( ['namespace'=>'Modules\Pricing','prefix'=>'pricing'], function(){  //Pricing Module
    Route::post('create','PricingController@addPrice');
    Route::get('/','PricingController@searchPrices');
    Route::get('id/{id}','PricingController@getPrice');
    Route::patch('archive/{id}','PricingController@archivePrice');
    Route::patch('/','PricingController@updatePrice');
} );

Route::group( ['namespace'=>'Modules\SupportTicket','prefix'=>'supportticket'], function(){ //SupportTicket Module
    Route::post('create','SupportTicketController@addSupportTicket');
    Route::get('id/{id}','SupportTicketController@getSupportTicket');
    Route::get('user','SupportTicketController@getAuthSupportTicket');
    Route::get('department','SupportTicketController@getSupportTicketByDepartment');
    Route::get('severity','SupportTicketController@getSupportTicketBySeverity');
    Route::patch('archive/{id}','SupportTicketController@archiveSupportTicket');
    Route::patch('/','SupportTicketController@updateSupportTicket');
} );

Route::group( ['namespace'=>'Modules\StudioRating','prefix'=>'studiorating'], function(){ //SupportTicket Module
    Route::post('rate','StudioRatingController@rateStudio');
    Route::get('studio/{id}','StudioRatingController@getStudioRating');
} );

Route::group( ['namespace'=>'Modules\Gallery','prefix'=>'gallery'], function(){ //SupportTicket Module
    Route::post('/','GalleryController@addGallery');
    Route::get('id/{id}','GalleryController@getGallery');
    Route::get('user','GalleryController@getUserGallery'); //via Auth
    Route::patch('{id}','GalleryController@updateGallery');
} );

Route::group( ['namespace'=>'Modules\Payment','prefix'=>'payment'], function(){ //SupportTicket Module
    Route::get('test','PaymentController@testPayment');
    Route::get('verify/{reference}','PaymentController@testVerify');
    Route::post('/','PaymentController@addUserPayment');
} );

Route::group( ['prefix'=>'subscription'], function(){ //todo :Subscription
    Route::get('/addummy','iSubscriptionController@addDummy'); //add Subscription
    Route::post('/search','SubscriptionController@getUserSubscriptions'); //get Subscriptions
    Route::get('/charge/{subscription_plan_id}','SubscriptionController@requestPaymentForSubscription');
    Route::post('/complete','SubscriptionController@subscribeUser'); //get Subscriptions
    Route::get('/user/','SubscriptionController@getUserSubscriptions'); //get Subscriptions

    Route::get('/','SubscriptionController@addSubscription'); //add Subscription

    Route::get('/cancel/{id}','SubscriptionController@cancelSubscriptions'); //cancel Subscriptions
} );

Route::group( ['namespace'=>'Modules\FindMyFace','prefix'=>'findmyface'], function(){ //todo :FindMyFace
    Route::post('/','FindMyFaceController@FindMyFace'); //add Subscription //return albums
    Route::post('/train','FindMyFaceController@indexFindMyFace');
    Route::get('/subscribe','FindMyFaceController@subscribe'); //Subscribe to findMyFace
    Route::put('/','FindMyFaceController@download'); //add findmyface album to my collection
} );

Route::group( ['namespace'=>'Modules\Bookings','prefix'=>'bookings'], function(){ //Bookings Module
    Route::post('/','BookingsController@addBookings');
    Route::patch('/{booking_id}/accept','BookingsController@acceptBooking');
    Route::patch('/{booking_id}/reject','BookingsController@rejectBooking');
    Route::get('/types','BookingsController@listBookingTypes');
    Route::get('/unfurl','BookingsController@unfurlBookingTypes');
} );