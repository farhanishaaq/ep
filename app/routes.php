<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/**
 * ===========================================================================
 * Public Routes
 * ===========================================================================
 */
Route::group(['Public'],function (){
    /**
     * AuthController Routes
     */

    Route::get('getDoctors', array('as'=>'getDoctors','uses'=>'DoctorsController@showDoctors'));
    Route::get('doctorStatus', array('as'=>'doctorStatus','uses'=>'UsersController@doctorStatusList'));
    Route::get('doctorAllRequest', array('as'=>'doctorAllRequest','uses'=>'UsersController@doctorAllRequest'));
    Route::post('updateDoctorStatus', array('as'=>'updateDoctorStatus','uses'=>'UsersController@updateDoctorStatus'));
    Route::get('login', array('as'=>'login','uses'=>'AuthController@showLogin'));
    Route::get('showChangePassword', array('as'=>'showChangePassword','uses'=>'AuthController@showPasswordChange'));
    Route::post('changePassword', array('as'=>'changePassword','uses'=>'AuthController@userPasswordChange'));
    Route::get('signUp', array('as'=>'signUp','uses'=>'AuthController@showSignUp'));
    Route::get('checkEmail',array('as'=> 'checkEmail','uses'=>'UsersController@checkEmail'));
    Route::get('cities', array('as'=>'cities','uses'=>'CityController@showCities'));



    Route::post('doLogin', array('as'=>'doLogin','uses'=>'AuthController@doLogin'));
    Route::post('doSignUp', array('as'=>'doSignUp','uses'=>'AuthController@doSignUp'));
    Route::post('doctorInfoForm', array('as'=>'doctorInfoForm','uses'=>'UsersController@doctorInfoForm'));
    Route::post('checkEmail', array('as'=>'checkEmail','uses'=>'AuthController@checkEmail'));
    Route::post('checkUserName', array('as'=>'checkUserName','uses'=>'AuthController@checkUserName'));
    Route::get('checkOldPassword', array('as'=>'checkOldPassword','uses'=>'AuthController@checkOldPassword'));
    Route::get('unauthorized', array('as'=>'unauthorized','uses'=>'AuthController@unauthorized'));

    /**
     * For ep social doctor profile
     */
    Route::get('drProfile/{id}', array('as'=>'drProfile','uses'=>'DoctorsController@showDoctorProfile'));
    Route::get('patientProfile', array('as'=>'patientProfile','uses'=>'PatientsController@getUserProfile'));


    Route::get('search', 'SearchController@index');
    Route::get('searchdata', 'SearchController@getSelectData');
    //Route::get('searchDoc', array('as'=>'searchDoc','user'=>'SearchController@getDoctorNamesForSelector'));
    //Route::get('searchDoc/{query}','SearchController@getDoctorNamesForSelector');
    Route::get('searchDoc/{query}','SearchController@getDoctorNamesForSelector');

    Route::get('getDoctorData',array('as'=> 'getDoctorData','uses'=>'SearchController@selectorDoctors'));
    Route::get('signUpCities',array('as'=> 'signUpCities','uses'=>'SearchController@signUpCities'));




    Route::get('drProfile/{id}', 'DoctorsController@GetProfile');
    Route::resource('starRating','RatingController');


//


    /**
     * HomeController Routes
     */
    Route::group(['Home'],function (){
        Route::get('/', ['as'=>'homePage','uses'=>'SearchController@index']);
        Route::group(['domain' => '{companyDomain}.ep.loc'], function ($companyDomain) {
            Route::get('companyHome', array('as'=>'showCompanyHomePage','uses'=>'HomeController@showCompanyHomePage'));
        });
        Route::get('fetchDoctorDutyAndFeeInfo', array('as'=>'fetchDoctorDutyAndFeeInfo','uses'=>'HomeController@fetchDoctorDutyAndFeeInfo'));
        Route::get('home', array('as'=>'home','uses'=>'HomeController@index'));
        Route::get('about', array('as'=>'about','uses'=>'HomeController@showAbout'));
        Route::get('services', array('as'=>'services','uses'=>'HomeController@showServices'));
        Route::get('contacts', array('as'=>'contacts','uses'=>'HomeController@showContacts'));
        Route::post('sendContactUsMail', array('as'=>'sendContactUsMail','uses'=>'HomeController@sendContactUsMail'));
    });

    /**
     * RemindersController Routes
     */
    Route::get('remind', array('as'=>'remind','uses'=>'RemindersController@getRemind'));
    Route::controller('password', 'RemindersController');
});


/**
 * ===========================================================================
 * Private Routes
 * ===========================================================================
 */
Route::group(['Private', 'before' => 'auth'],function (){
    /**
     * AuthController Routes
     */
    Route::get('logout', array('before' => 'auth', 'as'=>'logout','uses'=>'AuthController@logout'));

    /**
     * DashboardsController Routes
     */
    Route::get('show-dashboard', array('as'=>'showDashboard', 'uses' =>'DashboardsController@showDashboard'));

    /**
     * HomeController Routes
     */
    Route::group(['Home'],function (){

        Route::get('adminHome', array('as'=>'adminHome','uses'=>'HomeController@showAdminHome'));
        Route::any('doctorHome', array('before' => 'Doctor', 'as'=>'doctorHome', 'uses' => 'HomeController@showDoctorHome'));
        Route::get('receptionistHome', array('before' => 'Receptionist', 'as'=>'receptionistHome', 'uses' => 'HomeController@showReceptionistHome'));
        Route::get('labManagerHome', array('before' => 'Lab', 'as'=>'labManagerHome', 'uses' => 'HomeController@showLabManagerHome'));
        Route::get('accountantHome', array('before' => 'Accountant','as' => 'accountantHome', 'uses' => 'HomeController@showAccountantHome'));
    });


    /**
     * TimeSlotsController Routes
     */
    Route::get('getSlots', 'TimeSlotsController@getFreeSlots');
    Route::resource('timeSlots', 'TimeSlotsController');


    /**
     * UsersController Routes
     */
    Route::any('uploadProfilePic', array('as' => 'uploadProfilePic', 'uses' => 'UsersController@uploadProfilePic'));
    Route::any('userProfile', array('as' => 'userProfile', 'uses' => 'UsersController@userProfile'));
    Route::get('portalUserProfileShow', array('as' => 'portalUserProfileShow', 'uses' => 'UsersController@portalUserProfile'));
    Route::post('userProfileUpdate', array('as' => 'userProfileUpdate', 'uses' => 'UsersController@userProfileUpdate'));
    Route::post('doctorProfileUpdate', array('as' => 'doctorProfileUpdate', 'uses' => 'UsersController@doctorInfoForm'));
    Route::resource('users', 'UsersController');


    /**
     * RolesController Routes
     */
    Route::resource('roles', 'RolesController');



    /**
     * CompaniesController Routes
     */
    Route::resource('companies', 'CompaniesController');


    /**
     * CompaniesController Routes
     */
    Route::resource('doctors', 'DoctorsController');

    /**
     * PatientsController Routes
     */
    Route::get('patientsReporting', ['as'=>'patientsReporting', 'uses'=>'PatientsController@patientsReporting']);
    Route::resource('patients', 'PatientsController');


    /**
     * MedicinesController Routes
     */
    Route::resource('medicines', 'MedicinesController');


    /**
     * FamilyHistoriesController Routes
     */
    Route::resource('familyHistories', 'FamilyHistoriesController');


    /**
     * PreviousDiseasesController Routes
     */
    Route::resource('previousDiseases', 'PreviousDiseasesController');


    /**
     * AllergiesController Routes
     */
    Route::resource('allergies', 'AllergiesController');


    /**
     * DrugUsagesController Routes
     */
    Route::resource('drugUsages', 'DrugUsagesController');


    /**
     * VitalSignsController Routes
     */
    Route::resource('vitalSigns', 'VitalSignsController');


    /**
     * DutyDaysController Routes
     */
    Route::resource('dutyDays', 'DutyDaysController');


    /**
     * AppointmentsController Routes
     */
    Route::group(['Appointments'],function () {
        Route::resource('appointments', 'AppointmentsController');
        Route::get('vitalSign', array('as'=>'vitalSign', 'uses' => 'AppointmentsController@fetchVitalSign'));
        Route::get('appPrescription',  array('as'=>'appPrescription', 'uses' => 'AppointmentsController@addPrescriptions'));
        Route::get('showTestReports', ['as'=>'showTestReports','uses'=>'AppointmentsController@showTestReports']);
        Route::get('addCheckUpFee', ['as'=>'addCheckUpFee','uses'=>'AppointmentsController@addCheckUpFee']);
        Route::get('addTestFee', ['as'=>'addTestFee','uses'=>'AppointmentsController@addTestFee']);
        Route::get('printTestReports', ['as'=>'printTestReports','uses'=>'AppointmentsController@printTestReports']);
        Route::get('checkupFeeInvoice', ['as'=>'checkupFeeInvoice','uses'=>'AppointmentsController@checkupFeeInvoice']);
        Route::get('testFeeInvoice', ['as'=>'testFeeInvoice','uses'=>'AppointmentsController@testFeeInvoice']);
        Route::get('fetchTimeSlotsAndBookedAppointments',['as'=>'fetchTimeSlotsAndBookedAppointments','uses' => 'AppointmentsController@fetchTimeSlotsAndBookedAppointments']);

    });


    /**
     * PrescriptionsController Routes
     */
    Route::group(['Prescriptions'],function () {
        Route::resource('prescriptions', 'PrescriptionsController');
        Route::get('patientPrescriptions/{patientId}', array('before' => 'auth', 'as' => 'patientPrescriptions', 'uses' => 'PrescriptionsController@patientPrescriptions'));
        Route::get('printPrescription/{id}', ['as' => 'printPrescription', 'uses' => 'PrescriptionsController@printPrescription']);
        Route::any('uploadCheckUpPic', array('as' => 'uploadCheckUpPic', 'uses' => 'PrescriptionsController@uploadCheckUpPic'));
        Route::any('deleteCheckUpPic', array('as' => 'deleteCheckUpPic', 'uses' => 'PrescriptionsController@deleteCheckUpPic'));
        Route::get('followUpPrescriptions', array('as' => 'followUpPrescriptions', 'uses' => 'PrescriptionsController@followUpPrescriptions'));

    });
});


/**
 * Testing Route
 */
Route::get('testing', function(){

/*//    echo Route::getCurrentRoute()->getActionName();die;
    echo Route::getCurrentRoute()->getActionName();die;
    print_r(get_class_methods(Route::getCurrentRoute()));die;*/

    return  Redirect::route('showCompanyHomePage', array("ep-clinic"));
    //App\Globals\Ep::checkUpPrescrptionDirectory();die;
});

/**
 * Inventory Module Routes
 */

Route::group(['namespace' => 'App\Controllers\Inventory'],function () {



    /**
     * ===========================================================================
     * Private Routes
     * ===========================================================================
     */
    Route::group(['Private', 'before' => 'auth'],function (){

        /**
         * MedicinePurchasesController Routes
         */
        Route::resource('medicinePurchases','MedicinePurchasesController');

        /**
         * MedicineSalesController Routes
         */
        Route::resource('medicineSales','MedicineSalesController');

        /**
         * MedicineStocksController Routes
         */
        Route::resource('medicineStocks','MedicineStocksController');

        /**
         * MedicineLocationsController Routes
         */
        Route::resource('medicineLocations','MedicineLocationsController');

        /**
         * MedicineMenufacturersController Routes
         */
        Route::resource('medicineMenufacturers','MedicineMenufacturersController');

        /**
         * MedicineCategoryController Routes
         */
        Route::resource('medicineCategories','MedicineCategoriesController');

    });



    /**
     * ===========================================================================
     * Public Routes
     * ===========================================================================
     */
    Route::group(['Public'],function () {

    });


});
Route::get('testing12', function(){

/*
 * Ep Work
 */
Route::get('doctorss', 'DoctorContrller@index');


Route::get('appointment2', function (){
            return View::make('appointment2');

});
//Route::get('doctorsss', function (){
//            return View::make('doctor_list');
//
//});


//    Route::get('search', 'SearchController@index');
Route::get('/search', 'SearchController@index');


    return  View::make('doctors/edit');
    //App\Globals\Ep::checkUpPrescrptionDirectory();die;
});
Route::get('doctors_get_list', 'DoctorsController@show_doctors');


/*//    echo Route::getCurrentRoute()->getActionName();die;
    echo Route::getCurrentRoute()->getActionName();die;
    print_r(get_class_methods(Route::getCurrentRoute()));die;*/

//return  View::make('doctors/edit');
//App\Globals\Ep::checkUpPrescrptionDirectory();die;
//});
Route::post('updateComment', array('as'=>'updateComment','uses'=>'CommentsController@updateCommentStatus'));
Route::get('showComment', array('as'=>'showComment','uses'=>'CommentsController@show'));
Route::get('commentHistory', array('as'=>'commentHistory','uses'=>'CommentsController@showHistory'));
Route::get('commentsStatus', array('as'=>'commentsStatus','uses'=>'CommentsController@index'));
Route::get('comment', array('as'=>'comment','uses'=>'CommentsController@store'));

Route::post('articleStore', array('as'=>'arStore','uses'=>'ArticlesController@store'));
Route::get('getappointment/{id}', array('as'=>'getappointment', 'uses' => 'AppointmentsController@crtappointment'));
Route::get('articlesList', array('as'=>'articlesList','uses'=>'ArticlesController@articleList'));
Route::post('likePerform', array('as'=>'likePerform','uses'=>'ArticlesController@likeManage'));
Route::get('articles/{id}', array('as'=>'articles','uses'=>'ArticlesController@show'));
Route::get('articlesedit/{id}', array('as'=>'articlesedit','uses'=>'ArticlesController@edit'));
Route::post('articleupdate', array('as'=>'articleupdate','uses'=>'ArticlesController@replace'));
Route::get('articledelete/{id}', array('as'=>'articledelete','uses'=>'ArticlesController@destroy'));

Route::get('drEditer', array('as'=>'editer','uses'=>'ArticlesController@index'));
Route::get('articleStatus', array('as'=>'articleStatus','uses'=>'ArticlesController@status'));
Route::post('updateArticles', array('as'=>'updateArticles','uses'=>'ArticlesController@statusupdate'));


//this controller questions asked by patient to deoctor
Route::resource('question', 'QuestionController');
Route::get('question-status',array('as'=>'changeStatus','uses'=> 'QuestionController@updateStatus'));
Route::get('medicineSearch',array('as'=>'medicineSearch','uses'=> 'MedicineInfoController@medicineSearch'));

Route::get('medicinename',array('as'=>'medicinename','uses'=> 'MedicineInfoController@medicinename'));
Route::get('medicineDetail',array('as'=>'medicineDetail','uses'=> 'MedicineInfoController@medicineDetail'));
Route::get('medicineResutl/{id}',array('as'=>'medicineResutl','uses'=> 'MedicineInfoController@medicineResutl'));
Route::get('question-history',array('as' => 'questionHistory', 'uses' => 'QuestionController@viewHistory'));
Route::resource('answer','AnswerController');

Route::group(array('prefix'=>'api'),function () {

    Route::post('doLogin', array('as'=>'doLogin','uses'=>'AuthController@doLogin'));
    Route::post('doSignUp', array('as'=>'doSignUp','uses'=>'AuthController@doSignUp'));

});