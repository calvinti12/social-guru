<?php

use App\Http\Controllers\CoreController;

Route::get('/', function () {
    return redirect('home');
});

Route::any('/hook', 'Hook@fb');

Route::post('/slack/hook', 'Hook@slack');
Route::any('/schedule/fire', 'ScheduleController@fire');

// Instagram robot
Route::get('/service/instagram', 'ScheduleController@instagramService');
Route::get('/service/twitter', 'ScheduleController@twitterService');
Route::get('/service/pinterest', 'ScheduleController@pinterestService');

Route::get('/robot/instagram', 'ScheduleController@grabInstagramContent');

Route::get('/robot/twitter', 'ScheduleController@grabTwitterContent');
Route::get('/robot/pinterest', 'ScheduleController@grabPinterestContent');
Route::get('/schedule/get/request', 'ScheduleController@testRequest');
Route::get('/schedule/check', 'ScheduleController@checkRequest');

//Rss

Route::get('/robot/rss', 'ScheduleController@grabRssContent');
// Reset all sites status "done" to "pending"
Route::get('/rss/sites/reset', 'ScheduleController@resetRssSites');


Route::group(['middleware' => 'web'], function () {
    Route::auth();


    Route::group(['middleware' => 'auth'], function () {

        Route::resource('/contact', 'ContactController');

        Route::get('/prappo', 'Prappo@prappo');
        Route::get('/home', 'HomeController@index');
        Route::get('/write', 'Write@index');
        Route::get('/posttest', 'Write@postTest');

        // OAuth 2 callback urls
        Route::get('/fbconnect', 'Settings@fbconnect');

        // settings pages
        Route::get('/settings', 'Settings@index');
        Route::get('/settings/notifications', 'Settings@notifyIndex');
        Route::get('/settings/config', 'Settings@configIndex');
        Route::get('/reports', 'Reports@index');

        Route::get('/followers', 'FollowersController@index');
        Route::get('/gettwfoll', 'FollowersController@showTwFollowers');
        Route::get('/showalltwfollowers', 'FollowersController@showAllTwFollowers');

        // dashboard activities
        Route::get('/fblikes', 'HomeController@fbLikes');
        Route::get('/twfollowers', 'HomeController@twFollowers');
        Route::get('/tufollowers', 'HomeController@tuFollowers');
        Route::get('/liTotalCompanies', 'HomeController@liTotalCompanies');
        Route::get('/companyFollowers', 'HomeController@companyFollowers');
        Route::get('/liCompanyUpdates', 'HomeController@liCompanyUpdates');
        Route::get('/liPostedJobs', 'HomeController@liPostedJobs');

        Route::get('/allpost', 'AllpostController@index');

        Route::get('/facebook', 'FacebookController@index');
        Route::get('/twitter', 'TwitterController@index');
        Route::post('/twitter/retweet', 'TwitterController@retweet');
        Route::post('/twitter/message', 'TwitterController@twSendMsg');
        Route::get('/twitter/masssend', 'TwitterController@massSend');
        Route::post('/twitter/masssend/action', 'TwitterController@massMessageSend');
        Route::get('/twitter/message/send', 'TwitterController@sendMessage');
        Route::post('/twitter/reply', 'TwitterController@twReply');
        Route::post('/twitter/autoretweet', 'TwitterController@autoRetweet');
        Route::get('/twitter/autoretweet', 'TwitterController@autoRetweetIndex');
        Route::get('/twitter/autoreply', 'TwitterController@autoReplyIndex');
        Route::post('/twitter/autoreply', 'TwitterController@autoReply');
        Route::post('/twitter/autoreplyall', 'TwitterController@autoReplyAll');
        Route::post('/twitter/tag/add', 'TwitterController@addTag');
        Route::post('/twitter/tag/get', 'TwitterController@getTags');
        Route::post('/twitter/tag/remove', 'TwitterController@deleteTag');
        Route::post('/twitter/find/follower', 'TwitterController@findFollower');
        Route::get('/twitter/followers/get', 'TwitterController@getFollowers');
        Route::post('/twitter/add/follower', 'TwitterController@addFollowers');
        Route::post('/twitter/follower/delete', 'TwitterController@deleteFollower');

        Route::get('/twitter/auto/like', 'TwitterController@autoLikeIndex');

        Route::get('/twitter/add', 'TwitterController@addAccountIndex');
        Route::post('/twitter/add', 'TwitterController@addAccount');

        Route::get('/twitter/account/{username}', 'TwitterController@index');
        Route::post('/twitter/account/delete', 'TwitterController@delAccount');

        Route::get('/tumblr', 'TumblrController@index');
        Route::get('/wordpress', 'WordpressController@index');

        Route::post('/wpwrite', 'Write@wpWrite');
        Route::post('/twwrite', 'Write@twWrite');
        Route::post('/fbwrite', 'Write@fbWrite');
        Route::post('/fbgwrite', 'Write@fbgwrite');
        Route::post('/tuwrite', 'Write@tuWrite');
        Route::post('/linkedin/share', 'write@liWrite');
        Route::get('linkedin/callback', 'LinkedinController@callback');
        Route::post('/post/save', 'Write@postSave');

        Route::post('/delpost', 'Write@delPost');
        Route::post('/delallpost', 'AllpostController@delAll');
        Route::post('/delfromall', 'AllpostController@delFromAll');

        //update settings
        Route::post('/wpsave', 'Settings@wpSave');
        Route::post('/fbsave', 'Settings@fbSave');
        Route::post('/twsave', 'Settings@twSave');
        Route::post('/tusave', 'Settings@tuSave');
        Route::post('/skypesave', 'Settings@skypeSave');
        Route::post('/lisave', 'Settings@liSave');
        Route::post('/insave', 'Settings@inSave');
        Route::post('/settings/notifications', 'Settings@notifySave');
        Route::post('/save/fb/bot/config', 'Settings@fbBotConfigSave');
        Route::post('/settings/update/theme', 'Settings@updateTheme');
        Route::post('/pinsave', 'Settings@pinSave');

        // deleting
        Route::post('/fbdel', 'FacebookController@fbDelete');
        Route::post('/wpdel', 'WordpressController@wpDelete');

        // commenting
        Route::post('/fbcom', 'FacebookController@fbComment');

        // editing
        Route::post('/fbedit', 'FacebookController@fbEdit');
        // delete twitter post
        Route::post('/twdel', 'Write@twDelete');
        // delete tumblr post
        Route::post('/tudel', 'Write@tuDelete');
        Route::post('/tureblog', 'Write@tuReblog');

//        Image upload

        Route::post('/iup', 'ImageUpload@iup');
        Route::post('/content/upload', 'ImageUpload@contentUpload');
        Route::post('/content/list', 'ImageUpload@showImages');
        Route::post('/content/delete', 'ImageUpload@deleteImage');

        Route::post('/addschedule', 'ScheduleController@addSchedule');
        Route::get('/schedules', 'ScheduleController@index');
        Route::get('/scheduleslog', 'OptLogs@index');

        Route::get('/schedule/day', 'ScheduleController@scheduleDay');
        Route::post('/schedule/filter', 'ScheduleController@filter');
        Route::get('/schedule/filter', 'ScheduleController@scheduleDay');
        Route::get('/schedule/filter/week', 'ScheduleController@filterThisWeek');
        Route::get('/schedule/filter/month', 'ScheduleController@filterThisMonth');
        Route::get('/schedule/filter/all', 'ScheduleController@allDays');
        Route::post('/schedule/time/update', 'ScheduleController@timeUpdate');


        Route::post('/logdel', 'OptLogs@logDel');
        Route::post('/alllogdel', 'OptLogs@delAll');
        Route::post('/sdel', 'ScheduleController@sdel');
        Route::post('/sedit', 'ScheduleController@sedit');


        // Report specific routes
        Route::get('/fbreport', 'FacebookController@fbReport');
        Route::get('/fbreport/{pageId}', 'FacebookController@fbReportSingle');

        Route::get('/fbgroups', 'FacebookController@fbGroupIndex');
        Route::get('/tusync', 'Settings@tuSync');
        Route::get('/fbmassgrouppost', 'MassFbGroup@index');
        Route::post('/savepublicgroup', 'MassFbGroup@saveGroup');
        Route::post('/fbmassgroupdel', 'MassFbGroup@deleteGroup');
        Route::post('/posttomassgroup', 'MassFbGroup@massPost');

        Route::get('/conversations', 'Conversation@index');
        Route::get('/conversations/{pageId}', 'Conversation@getConversations');
        Route::get('/conversations/{pageId}/{cId}', 'Conversation@inbox');
        Route::get('/conversations/message/{pageId}/{mId}', 'Conversation@message');
        Route::get('/ajaxchat/{pageId}/{cId}', 'Conversation@ajaxGetConversations');
        Route::post('/chat', 'Conversation@chat');

        Route::get('/masssend/{pageId}', 'FacebookController@massSend');
        Route::get('/masssend', 'FacebookController@massSendIndex');
        Route::post('/massreplay', 'FacebookController@massReplay');
        Route::get('/facebook/masscomment', 'FacebookController@massComment');
        Route::post('/facebook/masscomment', 'FacebookController@massCommentAction');
        Route::post('/facebook/page/masscomment', 'FacebookController@massCommentPageAction');

        Route::post('/facebook/addpublicpage', 'FacebookController@publicPageAdd');
        Route::post('/delete/fbpublicpage', 'FacebookController@deletePage');


        Route::get('/fb/bot', 'ChatBotController@fb');
        Route::get('/slack/bot', 'ChatBotController@slack');
        Route::post('/fb/addquestion', 'ChatBotController@addQuestion'); // fb bot
        Route::post('/fb/delquestion', 'ChatBotController@delQuestion'); // fb bot
        Route::post('/add-slack-question', 'ChatBotController@addSlackQuestion');
        Route::post('/delete-slack-question', 'ChatBotController@deleteSlackQuestion');
        Route::post('/update-slack-bot-config', 'ChatBotController@updateBotConfig');

        Route::post('/langsave', 'Settings@lang');

        Route::get('/scraper', 'Scraper@index');
        Route::post('/scraper', 'FacebookController@scraper');

        // Notifications specific routes
        Route::post('/notify', 'Notify@insert');
        Route::get('/notify', 'Notify@show');
        Route::post('/allnotifydel', 'Notify@delAll');
        Route::get('/tw/scraper', 'Scraper@twScraper');
        Route::post('/tw/scraper', 'Scraper@twitterScrapper');

        // Skype specific routes
        Route::get('/skype', 'SkypeController@index');
        Route::get('/skype/user/{username}', 'SkypeController@skypeUser');
        Route::get('/skype/chatwith/{user}', 'SkypeController@getMessage');
        Route::post('/skypechat', 'SkypeController@sendMessage');
        Route::post('/skype/request', 'SkypeController@sendRequest');
        Route::post('/skype/masssend', 'SkypeController@massSend');
        Route::post('/skype/save/phones', 'SkypeController@collectPhone');
        Route::get('/skype/phone/list', 'SkypeController@showPhones');
        Route::post('/skype/phone/del', 'SkypeController@del');
        Route::post('/skype/phone/del/all', 'SkypeController@delAll');

        //linkedin specific routes
        Route::get('/linkedin/mass_comment', 'LinkedinController@massComment');
        Route::post('/linkedin/mass_comment', 'LinkedinController@fireMassComment');
        Route::post('/linkedin/comment/{companyId}/{updateKey}', 'LinkedinController@fireComment');
        Route::get('/linkedin/updates', 'LinkedinController@updates');

        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile', 'ProfileController@update');
        Route::post('/user/delete', 'UserController@userDel');
        Route::get('/user/add', 'UserController@addUserIndex');
        Route::post('/user/add', 'UserController@userAdd');
        Route::get('/user/list', 'UserController@userList');
        Route::get('/user/{id}', 'UserController@userEdit');
        Route::post('/user/update', 'UserController@userUpdate');

//        admin controllers
        Route::get('/admin', 'UserController@adminIndex');
        Route::get('/admin/options', 'AdminController@options');
        Route::get('/admin/system/log', 'AdminController@log');
        Route::get('/language/add', 'AdminController@addLanguageIndex');
        Route::post('/language/add', 'AdminController@addLanguage');
        Route::post('/language/change', 'AdminController@changeLanguage');

        Route::get('/instagram', 'InstagramController@index');
        Route::get('/instagram/followers', 'InstagramController@followers');
        Route::get('/instagram/following', 'InstagramController@following');
        Route::get('/instagram/popular', 'InstagramController@popular');
        Route::get('/instagram/home', 'InstagramController@home');
//        Route::get('/instagram/followers/get', 'InstagramController@getFollowers');
//        Route::get('/instagram/following/get', 'InstagramController@getFollowing');
        Route::post('/instagram/write', 'InstagramController@write');
        Route::get('/instagram/following/activity', 'InstagramController@getFollowingUserActivity');
//        Route::get('/instagram/delete','InstagramController@delete');

        Route::get('/instagram/info/{id}', 'InstagramController@getMediaInfo');
        Route::get('/instagram/followers/get/now', 'InstagramController@getInFollowers');

        Route::get('/instagram/add', 'InstagramController@addAccountIndex');
        Route::post('/instagram/add', 'InstagramController@addAccount');

        Route::get('/instagram/account/{username}', 'InstagramController@accountIndex');
        Route::post('/instagram/account/delete', 'InstagramController@deleteAccount');


        // instagram post

        Route::post('/instagram/follow', 'InstagramController@follow');
        Route::post('/instagram/unfollow', 'InstagramController@unfollow');
        Route::post('/instagram/like', 'InstagramController@like');
        Route::post('/instagram/comment', 'InstagramController@comment');
        Route::post('/instagram/delete', 'InstagramController@delete');
        Route::post('/instagram/add/follower', 'InstagramController@addFollower');
        Route::post('/instagram/find/follower', 'InstagramController@findUsers');
        Route::post('/instagram/tag/remove', 'InstagramController@removeTag');
        Route::post('/instagram/tag/add', 'InstagramController@addTag');
        Route::post('/instagram/tag/get', 'InstagramController@getTags');
        Route::post('/instagram/follower/delete', 'InstagramController@deleteFollower');


        //auto

        Route::get('/instagram/auto/follow', 'InstagramIndex@autoFollowIndex');
        Route::get('/instagram/auto/unfollow', 'InstagramIndex@autoUnfollowIndex');
        Route::get('/instagram/auto/comments', 'InstagramIndex@autoCommentsIndex');
        Route::get('/instagram/auto/likes', 'InstagramIndex@autoLikesIndex');
        Route::get('/instagram/auto/message', 'InstagramIndex@autoMessageIndex');
        Route::get('/instagram/scraper', 'InstagramIndex@scraper');

        //auto post

        Route::post('/instagram/followback', 'InstagramController@followback');
        Route::post('/instagram/followbytag', 'InstagramController@followByTag');
        Route::post('/instagram/unfollowall', 'InstagramController@unfollowAll');
        Route::post('/instagram/auto/comment', 'InstagramController@autoComment');
        Route::post('/instagram/scraper', 'InstagramController@scraper');
        Route::post('instagram/find/tags', 'InstagramController@searchTags');

        Route::get('/instagram/test', 'InstagramController@test');

        //youtube

        Route::get('/youtube/download', 'Youtube@downloadIndex');
        Route::post('/youtube/download', 'Youtube@download');
        Route::get('/youtube', 'YoutubeController@index');

        // plugins
        Route::get('/plugin/list', 'Plugins@index');
        Route::get('/plugin/test', 'Plugins@test');
        Route::get('/plugin/add', 'Plugins@addPlugin');
        Route::post('/plugin/action', 'Plugins@action');
        Route::post('/plugin/upload', 'Plugins@upload');
        Route::post('/plugin/active/for/user', 'Plugins@activePluginForUser');

        // shop

        Route::get('/shop', 'ShopController@index');
        Route::get('/shop/plugins', 'ShopController@getPlugins');

//        pinterest rotues
//        Route::get('/pinterest', 'PinterestController@index');
        Route::get('/pinterest/scraper', 'PinterestController@scraperIndex');
        Route::post('/pinterest/search', 'PinterestController@scraper');
        Route::get('/pinterest/home', 'PinterestController@home');
        Route::post('/pinterest/write', 'PinterestController@write');
        Route::post('/pinterest/tag/remove', 'PinterestController@deleteTag');
        Route::post('/pinterest/tag/get', 'PinterestController@getTags');
        Route::post('/pinterest/tag/add', 'PinterestController@addTag');

        Route::get('/pinterest/add', 'PinterestController@addAccountIndex');

        Route::post('/pinterest/add', 'PinterestController@addAccount');

        Route::get('/pinterest/account/{username}', 'PinterestController@index');


//        RSS routes
        Route::get('/rss/add', 'RssController@index');
        Route::get('/rss/feeds', 'RssController@getSites');
        Route::get('/rss/target', 'RssController@rssTargetIndex');
        Route::post('/rss/add/site', 'RssController@addSite');
        Route::post('/rss/delete/site', 'RssController@deleteSite');
        Route::post('/rss/feed/get', 'RssController@getFeed');
        Route::post('/rss/add/target', 'RssController@rssTargetInsert');

//        Service routes

        Route::post('/service/start', 'ServiceController@startService');
        Route::post('/service/stop', 'ServiceController@stopService');


//        virtual assistant routes

//        Route::post('/getexmsg','SettingsController@getExMessage');
//        Route::get('/spam/logs','SpamController@logs');
//        Route::post('/spam/deleteall','SpamController@deleteLogs');
//        Route::resource('/facebook','FacebookController');
//        Route::resource('/settings','SettingsController');
//        Route::resource('/comment','Comments');
//        Route::resource('/message','Messages');
//        Route::resource('/spam','SpamController');
//        Route::resource('/code','ShortCodeController');
//        Route::resource('/notification','NotificationController');
//        Route::resource('/spam','SpamController');
    });


});
