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

Route::get('/test', 'frontend\FrontendController@test');
Route::get('/test1', 'frontend\FrontendController@test1');

/*Front-end*/
/*Authentication*/
/*// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/
/*End Authentication*/

Auth::routes();

Route::get('/post/{id}/details', 'frontend\FrontendController@postDetailsById')->name('frontend.post.details.id');
Route::get('registration-check-email', 'frontend\FrontendController@registrationCheckEmail')->name('registration.check.email');


Route::group(['middleware' => ['auth', 'only_user']], function () {
    Route::get('/new-pro-user-registration', 'frontend\FrontendController@newProUserRegistrationForm')->name('new.pro.user.registration');
    Route::post('/new-pro-user-registration', 'frontend\FrontendController@newProUserRegistration');
    /*pro user registration*/
    Route::get('/pro-user-registration', 'frontend\FrontendController@proUserRegistrationForm')->name('pro.user.registration');
    Route::post('/pro-user-registration', 'frontend\FrontendController@proUserRegistration');
    /*end pro user registration*/
    /*home page*/
    Route::get('/', 'frontend\FrontendController@home')->name('frontend.home');
    /*End Home page*/
    /*Notification*/
    Route::get('/notifications', 'frontend\FrontendController@notifications')->name('frontend.notifications');
    Route::get('/notification/details/{id}', 'frontend\FrontendController@notificationDetalis')->name('frontend.notification.details');
    /*new Post*/
    Route::get('/new-launch', 'frontend\FrontendController@newLaunch')->name('frontend.newlaunch');
    Route::post('/new-launch', 'frontend\FrontendController@saveLaunch');
    /*End new post*/
    /*post Like/Unlike*/
    Route::post('/post/like', 'frontend\FrontendController@likePost')->name('frontend.like.post');
    Route::post('/liked-like', 'frontend\FrontendController@likedLike')->name('frontend.liked.like');
    /*End post Like/Unlike*/
    Route::post('/user/follow', 'frontend\FrontendController@followUser')->name('frontend.follow.user');
    Route::get('/follow/user/{id}', 'frontend\FrontendController@followUserById')->name('frontend.follow.user.id');
    Route::post('/liked-follow', 'frontend\FrontendController@likedFollow')->name('frontend.liked.follow');
    Route::get('/search', 'frontend\FrontendController@search')->name('frontend.search');
    Route::post('/search/like', 'frontend\FrontendController@searchLike')->name('frontend.search.like');
    Route::get('/post-details/{id}', 'frontend\FrontendController@postDetails')->name('frontend.post.details');
    Route::post('/post-details/like', 'frontend\FrontendController@postDetailsLike')->name('frontend.post.details.like');
    Route::post('/post-details/follow', 'frontend\FrontendController@postDetailsFollow')->name('frontend.post.details.follow');
    Route::post('/post-comment/{id}', 'frontend\FrontendController@postComment')->name('frontend.post.comment');

    Route::get('/followed', 'frontend\FrontendController@followedByMe')->name('frontend.my.follow');

    Route::get('/liked', 'frontend\FrontendController@likedByMe')->name('frontend.my.liked');

    Route::get('/users/edit-my-profile', 'frontend\FrontendController@editMyProfile')->name('frontend.edit.myprofile');
    Route::post('/users/edit-my-profile', 'frontend\FrontendController@updateMyProfile');

    Route::get('/users/my-profile', 'frontend\FrontendController@myProfile')->name('frontend.my.profile');
    Route::get('/users/{id}/profile', 'frontend\FrontendController@userProfile')->name('frontend.user.profile');
    /*post follow*/
    Route::post('/users/follow/post', 'frontend\FrontendController@followPost')->name('frontend.follow.post');


    /*Chat Route*/
    Route::post('/users/chat-history', 'frontend\FrontendController@chatHistory')->name('frontend.chat.history');
    Route::post('/users/send-message', 'frontend\FrontendController@sendMessage')->name('frontend.send.message');
    Route::post('/users/save-conversation', 'frontend\FrontendController@saveConversation')->name('frontend.conversation.save');

    /*End Chat Route*/

    /*Report Post*/
    Route::post('/report/post', 'frontend\FrontendController@reportPost')->name('frontend.report.post');
    Route::post('/report/post-details', 'frontend\FrontendController@reportPostDetails')->name('frontend.report.postDetails');

    /*End Report Post*/

    /*User Report*/
    Route::post('/report/user/{id}', 'frontend\FrontendController@reportUser')->name('frontend.report.user');
    Route::post('/report/user-details', 'frontend\FrontendController@reportPostDetails')->name('frontend.report.userDetails');

    /*End USer REport*/
    /*filter*/
    Route::get('filter', 'frontend\FrontendController@filter')->name('frontend.filter');
    /*End filter*/
    /*Search Data*/
    Route::post('frontend/datalist','frontend\FrontendController@datalist')->name('frontend.search.datalist');
    Route::get('frontend/datalist','frontend\FrontendController@datalist')->name('frontend.search.datalist');
    /*load-comment*/
    Route::post('/post-comment-load', 'frontend\FrontendController@loadComments')->name('frontend.commentload');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/explore', 'frontend\FrontendController@explore')->name('frontend.home');

    Route::get('login/facebook', 'frontend\FacebookController@redirectToProvider');
    Route::get('login/facebook/callback', 'frontend\FacebookController@handleProviderCallback');

    /*Admin Login Logout*/
    Route::get('admin-login', 'dashboard\adminAuth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-login', 'dashboard\adminAuth\LoginController@login');
    /*End Admin Login Logout*/
});


Route::group(['middleware' => 'admin_auth'], function () {
    /* Admin Routs */

    /*Admin Logout*/
    Route::post('admin-logout', 'dashboard\adminAuth\LoginController@logout')->name('admin.logout');

    /*Admin Dashboard*/
    Route::get('admin/', 'dashboard\AdminController@dashboard')->name('admin.dashboard');

    /*Show User List*/
    Route::get('admin/users', 'dashboard\AdminController@users')->name('admin.users');
    Route::get('admin/{id}/user-delete', 'dashboard\AdminController@deleteUser')->name('admin.delete.user');
    Route::get('admin/{id}/user-suspend', 'dashboard\AdminController@suspendUser')->name('admin.suspend.user');

    /*User Edit Form*/
    Route::get('admin/users/edit/{id}', 'dashboard\AdminController@editUser')->name('admin.user.edit');
    Route::post('admin/users/edit/{id}', 'dashboard\AdminController@updateUser');

    /*Admin User Search*/
    Route::get('admin/users/search', 'dashboard\AdminController@userSearch')->name('admin.users.search');

    /*Show All Posts*/
    Route::get('admin/posts', 'dashboard\AdminController@posts')->name('admin.posts');
    Route::get('admin/{id}/delete-post', 'dashboard\AdminController@deletePost')->name('admin.delete.post');
    Route::get('admin/{id}/suspend-post', 'dashboard\AdminController@suspendPost')->name('admin.suspend.post');

    /*Edit User Post from Admin*/
    Route::get('admin/posts/edit/{id}', 'dashboard\AdminController@postEdit')->name('admin.post.edit');
    Route::post('admin/posts/edit/{id}', 'dashboard\AdminController@postUpdate');

    /*Admin Post Search*/
    Route::get('admin/posts/search', 'dashboard\AdminController@postSearch')->name('admin.posts.search');


    /*Category*/
    Route::get('admin/categories', 'dashboard\AdminController@categories')->name('admin.categories');
    Route::post('admin/categories', 'dashboard\AdminController@storeCategory');
    Route::get('admin/categories/{id}/change-status', 'dashboard\AdminController@changeCategoryStatus')->name('admin.change.category.status');

    Route::get('admin/reports/user', 'dashboard\AdminController@userReports')->name('admin.report.users');
    Route::get('admin/reports/user/{id}/details', 'dashboard\AdminController@userReportsDetails')->name('admin.report.userDetails');

    /*Report*/
    Route::get('admin/reports/post', 'dashboard\AdminController@postReports')->name('admin.post.reports');
    Route::get('admin/reports/post/details/{id}', 'dashboard\AdminController@detailPostReport')->name('admin.post.report.details');
    Route::get('admin/{id}/delete-report', 'dashboard\AdminController@deleteReport')->name('admin.delete.report');
    Route::get('admin/report/{id}/user-delete', 'dashboard\AdminController@reportDeleteUser')->name('admin.report.delete.user');
    Route::get('admin/report/{id}/user-suspend', 'dashboard\AdminController@reportSuspendUser')->name('admin.report.suspend.user');
    Route::get('admin/report/{id}/suspend-post', 'dashboard\AdminController@reportSuspendPost')->name('admin.report.suspend.post');

    /*End Report*/
    /*User Report*/
    Route::get('admin/{id}/delete-user-report', 'dashboard\AdminController@deleteUserReport')->name('admin.delete.user.report');
    Route::get('admin/user-report/{id}/user-delete', 'dashboard\AdminController@userReportDeleteUser')->name('admin.userreport.delete.user');
    Route::get('admin/user-report/{id}/user-suspend', 'dashboard\AdminController@userReportSuspendUser')->name('admin.userreport.suspend.user');

    /*End User Report*/
    Route::get('admin/settings', function () {
        return view('settings.settings');
    });


});






//Route::get('/home', 'HomeController@index')->name('home');
