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

Route::prefix('v1')->group(function () {
    Route::post('sign-in', 'Api\UserController@login');
    Route::post('sign-up', 'Api\UserController@register');
    Route::post('unauth-posts', 'Api\PostsController@unauthHome');
    Route::post('unauth-explore', 'Api\PostsController@unauthExplore');

    /*Authenticated routes */
    Route::group(['middleware' => 'auth:api'], function () {

        Route::post('user-info', 'Api\UserController@userDetails');
        Route::post('user-info-by-id', 'Api\UserController@userDetailsById');
        Route::post('logout', 'Api\UserController@logout');
        /*Post routes*/
        Route::post('explore', 'Api\PostsController@explore');
        Route::post('posts', 'Api\PostsController@index');
        Route::post('post', 'Api\PostsController@store');
        Route::post('post-update/{id}', 'Api\PostsController@update');
        Route::post('post/{id}', 'Api\PostsController@show');
//        Route::resource('post', 'Api\PostsController')->only('index', 'store', 'show', 'update', 'destroy');
        Route::post('my-list', 'Api\PostsController@my_list');
        Route::post('search-post', 'Api\PostsController@searchPost');
        Route::post('filter-post', 'Api\PostsController@filterPost');
        Route::post('filter-posts', 'Api\PostsController@filterPosts');
        /*End Post routes*/

        /*Like routes*/
        Route::post('like', 'Api\LikeController@store');
        Route::post('my-like', 'Api\LikeController@myLiked');
//        Route::resource('like', 'Api\LikeController')->only('store', 'destroy');
        /*End Like Route*/

        /*Comment Route*/
        Route::post('comment', 'Api\CommentController@store');
//        Route::resource('comment', 'Api\CommentController')->only('store', 'show', 'update', 'destroy');
        /*End Comment routes*/

        /*Comment Reply routes*/
        Route::resource('comment-reply', 'Api\CommentReplyController')->only('store', 'show', 'update', 'destroy');
        /*End Comment Reply routes*/

        /*Follow routes*/
        Route::post('follow', 'Api\FollowController@store');
//        Route::resource('follow', 'Api\FollowController')->only('store', 'destroy');
//        Route::post('my-following-user', 'Api\UserController@my_following');
        Route::post('my-following-user', 'Api\FollowController@my_following');
        /*End Follow routes*/

        /*follow a post*/
        Route::post('post-follows', 'Api\FollowPostController@index');
        Route::post('post-follow', 'Api\FollowPostController@store');
//        Route::resource('post-follow', 'Api\FollowPostController')->only('index', 'store');
        /*end follow a post*/

        /*User Details routes*/
        Route::post('user-details', 'Api\UserDetailController@store');
//        Route::resource('user-details', 'Api\UserDetailController')->only('store', 'show');
        Route::post('pro-user-registration', 'Api\UserDetailController@proUserRegistration');
        Route::post('pro-user-categories', 'Api\UserCategoryController@index');
        Route::post('get-user-interest', 'Api\UserDetailController@saveUserInterest');
        /*End User Details Routes*/

        /*Share Routes*/
        Route::resource('share', 'Api\ShareController')->only('store', 'show', 'update', 'destroy');
        /*End Share Routes*/
        /*Category route*/
        Route::post('post-category', 'Api\CategoryController@index');
        /*End Category route*/

        /*notification api */
        Route::post('notifications', 'Api\NotificationController@notifications');
        /*End notification api */

        /*messages*/
        Route::post('conversation-list', 'Api\ConversationController@conversationList');
        Route::post('save-conversation', 'Api\ConversationController@saveChatRoom');
        Route::post('chat-history', 'Api\MessageController@chatHistory');
        Route::post('new-message', 'Api\MessageController@saveMessage');
        /*end messages*/
    });

});




