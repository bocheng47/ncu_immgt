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
use Illuminate\Support\Facades\Input;
Route::resource('news','HomeController');
Route::get('/', 'HomeController@index');

Route::get('/', 'HomeController@index');

Route::resource('questionnarie/aacsb' , 'AacsbController');
Route::resource('questionnarie/college' , 'CollegeController');
Route::resource('questionnarie' , 'QuestionnarieController');

Route::resource('about/statistics/aboutstatistics' , 'AboutstatisticsController');

Route::resource('about/office/aboutoffice', 'AboutofficeController');
Route::get('about/office/createcontact','AboutofficeController@create');
Route::get('about/office/aboutoffice/{id}/editstaff', 'AboutofficeController@editstaff');
Route::get('about/office/createstaff', 'AboutofficeController@createstaff');

Route::get('about' , 'AboutController@index');
Route::post('/about/storeArticle1', 'AboutController@storeArticle1');
Route::post('/about/storeArticle2', 'AboutController@storeArticle2');
Route::post('/about/storeArticle3', 'AboutController@storeArticle3');
Route::post('/about/storeArticle4', 'AboutController@storeArticle4');
Route::post('/about/storeArticle5', 'AboutController@storeArticle5');
Route::post('/about/storeArticle6', 'AboutController@storeArticle6');


Route::get('/about', 'AboutController@index');

Route::post('upload','MSexamController@upload');
Route::get('/enrollment/MS/MSexam','MSexamController@index');


Route::resource('enrollment/BS/BSsport', 'BSsportController');

Route::group([
    'prefix' => 'enrollment/BS/BSother',
], function($router) {
    $router->get('', 'BSotherController@index');
    $router->post('storeArticle', 'BSotherController@storeArticle');
});

Route::group([
    'prefix' => 'enrollment/BS/BSstar',
], function($router) {
    $router->delete('{id}/deleteText','BSstarController@destroyText');
    $router->put('{id}/updateText', 'BSstarController@updateText');
    $router->get('{id}/editNum', 'BSstarController@editNum');
    $router->post('storeText', 'BSstarController@storeText');
    $router->get('createNum', 'BSstarController@createNum');
});

Route::resource('enrollment/BS/BSstar', 'BSstarController');

Route::group([
    'prefix' => 'enrollment/BS/BSapply',
], function ($router) {
    $router->delete('{id}/deleteText','BSapplyController@destroyText');
    $router->put('{id}/updateText', 'BSapplyController@updateText');
    $router->get('{id}/editGrade', 'BSapplyController@editGrade');
    $router->get('{id}/editNum', 'BSapplyController@editNum');
    $router->post('storeText', 'BSapplyController@storeText');
    $router->get('createGrade', 'BSapplyController@createGrade');
    $router->get('createNum', 'BSapplyController@createNum');
});

Route::resource('enrollment/BS/BSapply', 'BSapplyController');

Route::group([
    'prefix' => 'enrollment/BS/BStest', 
], function ($router) {
    $router->get('{id}/editGrade', 'BStestController@editGrade');
    $router->get('createGrade', 'BStestController@createGrade');
});

Route::resource('enrollment/BS/BStest', 'BStestController');

Route::group([
    'prefix' => 'honor',
], function($router) {
    $router->get('{id}/content', 'HonorController@showContent');
    $router->post('{id}/content/update', 'HonorController@storeContent');
    $router->post('{id}/storefile', 'HonorController@storefile');
    $router->post('{id}/deletefile', 'HonorController@deletefile');
    
});
Route::resource('honor', 'HonorController');

Route::resource('enrollment/MS/MSselect', 'MSselectController');
Route::resource('enrollment/MS/MSexam', 'MSexamController');

Route::resource('enrollment/EMS/EMSexam', 'EMSexamController');
Route::resource('enrollment/EMS/EMScredit', 'EMScreditController');

Route::resource('enrollment/PhD/PhDselect', 'PhDselectController');
Route::resource('enrollment/PhD/PhDexam', 'PhDexamController');

Route::get('/enrollment/{id}/post', 'PostController@index');
Route::post('/enrollment/{id}/post', 'PostController@update');
Route::post('/enrollment/{id}/storefile', 'PostController@storefile');
Route::post('/enrollment/{id}/deletefile', 'PostController@deletefile');

Route::resource('enrollment', 'EnrollmentController');

Route::get('/business/teacher', function () {
    return view('business/businessteacher');
});
Route::post('/uploadFile','PDFController@uploadFile');
Route::get('/business', 'BusinessController@index');
Route::post('/business/article', 'BusinessController@storeArticle');
Route::get('/business/activity', 'BusinessController@activity');
Route::post('/business/article1', 'BusinessController@storeArticle1');
Route::get('/business/main', 'BusinessController@main');
Route::post('/business/article2', 'BusinessController@storeArticle2');
Route::get('/business/strategy', 'BusinessController@strategy');
Route::post('/business/article3', 'BusinessController@storeArticle3');
Route::get('/business/student', 'BusinessController@student');
Route::post('/business/article4', 'BusinessController@storeArticle4');
Route::get('/about', 'AboutController@index');
Route::resource('business', 'BusinessController');
Route::get('/business/{id}/post', 'NewsController@index');
Route::post('/business/{id}/post', 'NewsController@update');
Route::post('/business/{id}/storefile', 'NewsController@storefile');
Route::post('/business/{id}/deletefile', 'NewsController@deletefile');



// Routing for JohnsonYuan section. @JohnsonYuanTW
Route::get('/course', function(){ 
    return Redirect::to('/course/rule', 301); 
});
Route::resource('/course/rule', 'RuleController');
Route::resource('/course/waiver', 'WaiverController');
Route::post('/course/double/storeArticle', 'DoubleController@storeArticle');
Route::resource('/course/double', 'DoubleController');
Route::get('/course/program', function () {
    return view('course.programs');
});
Route::resource('/course/paperrule', 'PaperruleController');
Route::resource('/course/goodpaper', 'GoodpaperController');
Route::resource('/course/scholarship', 'ScholarshipController');
Route::post('/programupload','ProgramUploadController@upload');

Route::resource('files','FileController');
// section for JohnsonYuan ENDS. @JohnsonYuanTW


// Route::get('/activity', 'ActivityController@index');



Route::get('/enrollment', 'EnrollmentController@index');
Route::get('/teacher', 'TeacherController@index');
// Route::get('activity/{class}/show','ActivityController@show');
// Route::get('activity/{class}','ActivityController@index');
// Route::get('/img/activity/','ActivityController@update');
// Route::post('/img/activity/', 'UserController@update');
Route::get('activity/showall/{class}','ActivityController@index');
Route::get('activity/show/{id}','ActivityController@huan');
Route::put('activity/{id}','ActivityController@create');
Route::post('activity/{id}','ActivityController@update'); 
// Route::patch('activity/{id}','ActivityController@create');
Route::delete('activity/delete/{id}','ActivityController@destroy');
Route::resource('activity','ActivityController');

Route::post('/uploadProgramsfile','PDFController@uploadFile');




Route::patch('teacher','TeacherController@store');
Route::patch('detail','TeacherController@detail_store');
Route::get('teacher/{gp}/show','TeacherController@show');
Route::get('teacher/{gp}', 'TeacherController@index');
Route::resource('teacher','TeacherController');
Route::delete('teacher', 'TeacherController@detail_destroy');


Route::get('/', 'HomeController@index');
Route::patch('home', 'HomeController@store');
Route::delete('home{home}', 'HomeController@destroy');
Route::get('home{home}', 'HomeController@show');
Route::get('home{home}/edit', 'HomeController@edit');
Route::patch('homes{home}', 'HomeController@update');

Route::get('news','HomeController@all_index');
Route::get('cour','HomeController@cour_index');
Route::get('practice','HomeController@prac_index');
Route::get('speech','HomeController@speech_index');
Route::get('work','HomeController@work_index');
Route::get('enterprise','HomeController@enterprise_index');





Route::get('homes/{id}/post', 'HomeController@ShowPostContent');
Route::post('homes/{id}/storepost', 'HomeController@StorePostContent');

// Route::get('teacher/{gp}', 'TeacherController@index');

// Route::resource('teacher','TeacherController');
// Route::resource('detail','TeacherController');

/**
 * Download Route for all. (有子資料夾)
 *
 * @param $cat - 大分類 e.g. course.
 * @param $subpath - 子分類 e.g. rules...
 * @param $filename - 檔案名稱
 * @return file - if in programs and filename ends with "pdf", return inline
 */

Route::get('download/{cat}/{filename}', function($cat, $filename) 
{
    // Check if file exists in app/course/file folder
    $file_path = public_path().'/'.$cat.'/'. $filename;
if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        \Log::Alert('DEBUGMSG: Error, Cannot download file "'.$filename.'" at '.$file_path);
        abort(404);
    }
});
/**
 * Download Route for all. (有子資料夾)
 *
 * @param $cat - 大分類 e.g. course.
 * @param $subpath - 子分類 e.g. rules...
 * @param $filename - 檔案名稱
 * @return file - if in programs and filename ends with "pdf", return inline
 */

Route::get('download/{cat}/{filename}', function($cat, $filename) 
{
    // Check if file exists in app/course/file folder
    $file_path = public_path().'/'.$cat.'/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        \Log::Alert('DEBUGMSG: Error, Cannot download file "'.$filename.'" at '.$file_path);
        abort(404);
    }
});


/**
 * Download Route for all. (沒有子資料夾)
 *
 * @param $cat - 大分類 e.g. course.
 * @param $subpath - 子分類 e.g. rules...
 * @param $filename - 檔案名稱
 * @return file - if in programs and filename ends with "pdf", return inline
 */
Route::get('download/{cat}/{path}/{filename}', function($cat, $subpath, $filename) 
{
    // Check if file exists in app/course/file folder
    $file_path = public_path().'/storage/'.$cat.'/'.$subpath.'/'. $filename;
    if (file_exists($file_path))
    {
        $file_ext = substr($filename, -3);
        if ($cat == "course" && $subpath == "programs" && $file_ext == "pdf") {

            return Response::make(file_get_contents($file_path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);
        }

        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        \Log::Alert('DEBUGMSG: Error, Cannot download file "'.$filename.'" at '.$file_path);
        abort(404);
    }
});


/**
 * Upload Route for CKEDITOR.
 *
 * @return response readable for CKEDITOR.
 */
Route::post('/upload_image', function() {
    if (Input::hasFile('upload')) {
        $file = Input::file('upload');
        if ($file->isValid()) {
            $filename = $file->getClientOriginalName();
            $file->move(public_path().'/storage/'.Input::get('cat').'/images', $filename);
            $url = '/download/'.Input::get('cat').'/images/' . $filename;

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

    }
    return response()->json([
        'uploaded' => false,
        'error' => [
            'message' => "Please contact System Admin."
        ]
    ]);
});

// ========================================== Auth ==========================================
// Auth::routes();
// Custom Auth Route
// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// User User Management Routes...
Route::get('usermanage', 'Auth\UserManagementController@showUsers')->name('usermanage');
Route::delete('usermanage/delete/{id}', 'Auth\UserManagementController@deleteUsers');
Route::post('usermanage/edit/{id}', 'Auth\RegisterController@update');
Route::post('usermanage/changeusernamepassword', 'Auth\RegisterController@changeusernamepassword')->name('changeusernamepassword');


// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// ========================================== End Auth ==========================================

Route::post('/homes/{id}/storefile', 'HomeController@storefile');
Route::post('/homes/{id}/deletefile', 'HomeController@deletefile');
