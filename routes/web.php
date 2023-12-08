<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use App\Models\Attendance;
use App\Models\employeedata;
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
Route::get('zeardev/{password?}', 'ExampleController@ip');
Route::get('restricted_page',function(){
	return view('errors.503');
});

Route::get('gkmngdgaepo/ip', function(){
	$ip=$_SERVER['REMOTE_ADDR'];
	return '
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
	alert("'.$ip.'");
	let person = prompt("Please enter password", " ");
	</script>
	';
});




Route::group(['middleware' => 'accesspage'], function () {
	Route::group(['middleware' => 'guest'], function () {

		Route::get('/', ['as' => 'web.home', 'uses' => 'WebsiteController@index']);
		Route::get('/library', ['as' => 'web.library', 'uses' => 'WebsiteController@library']);
		Route::get('/local-videos', ['as' => 'web.local', 'uses' => 'WebsiteController@local']);
		Route::get('/fb-videos', ['as' => 'web.facebook', 'uses' => 'WebsiteController@facebook']);
		Route::get('/yt-videos', ['as' => 'web.youtube', 'uses' => 'WebsiteController@youtube']);
		Route::get('stream/{id?}',['as'=>'stream.show','uses'=>'WebsiteController@show']);

		Route::get('/pl', ['as' => 'web.playlist', 'uses' => 'WebsiteController@playlist']);
		Route::get('pl/{id}', 'WebsiteController@showPlaylistVideos')->name('playlist.videos');




	#Route::get('login', 'Auth\AuthController@getLogin');
		Route::get('login', 'Auth\AuthController@getLogin')->name('getlogin');
		Route::post('/login', 'Auth\AuthController@postLogin');      
		Route::get('reset_password.php',['as'=>'reset_password', 'uses'=>'ResetPasswordController@index'])->name('reset_password');
		Route::post('reset_password/store.php',['as'=>'reset_password.store', 'uses'=>'ResetPasswordController@store']);
	});


	
	
	Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
	
	Route::group(['middleware' => 'auth'], function () {
		Route::resource('dashboard','DashboardController'); 
		Route::resource('modules','ModulesController'); 
		Route::resource('role','RoleController'); 
		Route::resource('department','DepartmentController'); 
		Route::resource('users','UserController');
		Route::resource('video','VideoController');
		Route::resource('videoe','VideoeController');
		Route::resource('playlist','PlaylistController');



		Route::get('playlist/show/{id?}',['as'=>'playlist.show','uses'=>'PlaylistController@show']);

		Route::post('/playlist/{playlistId}/addVideo', [PlaylistController::class, 'addVideoToPlaylist'])->name('playlist.addVideo');
Route::delete('/playlist/{playlistId}/deleteVideo', [PlaylistController::class, 'deleteVideoFromPlaylist'])->name('playlist.deleteVideo');





		

		Route::get('video/edit/{id?}',['as'=>'video.show','uses'=>'VideoController@show']);
		Route::post('video/del',['as'=>'video.destroy','uses'=>'VideoController@destroy']);
		Route::post('video/update',['as'=>'video.edit','uses'=>'VideoController@update']);
	
		Route::get('videoe/edit/{id?}',['as'=>'videoe.show','uses'=>'VideoeController@show']);
		Route::post('videoe/del',['as'=>'videoe.destroy','uses'=>'VideoeController@destroy']);
		Route::post('videoe/update',['as'=>'videoe.edit','uses'=>'VideoeController@update']);

	});
	 
	Route::group(['middleware' => 'maintenancepage'], function () {
	});
	
	Route::group(['middleware' => 'zeardev'], function () {
		Route::post('access_control/update','DesignController@update')->name('design');
		Route::post('role/addrole','AccessControlController@roles')->name('access.addrole');
		Route::post('role/delrole',['as'=>'role.delete','uses'=>'AccessControlController@delrole']);
		Route::post('modules/delmodules',['as'=>'mod.delete','uses'=>'ModulesController@delmon']);
		Route::get('modules/edit/{id?}',['as'=>'modules.ed','uses'=>'ModulesController@edit']);
	});
	



	
});

