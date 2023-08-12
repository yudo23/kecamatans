<?php

use Illuminate\Support\Facades\Route;
use App\Enums\RoleEnum;

Route::group(["as" => "auth.", "prefix" => "auth", "namespace" => "Auth"], function () {

    Route::group(["as" => "login.", "prefix" => "login"], function () {
        Route::get('/', 'LoginController@index')->name('index');
        Route::post('/', 'LoginController@post')->name('post');
    });

    Route::get('/logout', 'LogoutController@logout')->name("logout");

    Route::group(["as" => "forgot-password.", "prefix" => "forgot-password"], function () {
        Route::get('/', 'ForgotPasswordController@index')->name('index');
        Route::post('/', 'ForgotPasswordController@post')->name('post');
    });

    Route::group(["as" => "reset-password.", "prefix" => "reset-password"], function () {
        Route::get('/', 'ResetPasswordController@index')->name('index');
        Route::post('/', 'ResetPasswordController@post')->name('post');
    });

    Route::group(["as" => "verification.", "prefix" => "verification"], function () {
        Route::get('verify', 'VerificationController@verificationNotice')->name("notice")->middleware('auth');
        Route::get('verify/{id}/{hash}', 'VerificationController@verifyUser')->name("verify")->middleware(['signed']);
        Route::post('verification-notification', 'VerificationController@verificationResend')->name("send")->middleware(['auth', 'throttle:6,1']);
    });
});

Route::group(['middleware' => ['auth', 'dashboard.access', 'verified:dashboard.auth.verification.notice']], function () {
    Route::impersonate();

	Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);

	Route::get('/', 'DashboardController@index')->name('index')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN, RoleEnum::ADMINISTRATOR])]);

    Route::get('notification', 'NotificationController@notification')->name('notification')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	Route::get('notification/read/{id}', 'NotificationController@notificationRead')->name('notification.read')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	Route::get('notification/markAsRead', 'NotificationController@markAsRead')->name('notification.markAsRead')->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);

    Route::group(["as" => "profile.", "prefix" => "profile"], function () {
		Route::get('/', 'ProfileController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/', 'ProfileController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

    Route::group(["as" => "users.", "prefix" => "users"], function () {
		Route::get('/', 'UserController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'UserController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'UserController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'UserController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'UserController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'UserController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'UserController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}/restore', 'UserController@restore')->name("restore")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		Route::get('/{id}/impersonate', 'UserController@impersonate')->name("impersonate")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
	});

    Route::group(["as" => "settings.", "prefix" => "settings","namespace" => "Setting"], function () {
		Route::group(["as" => "dashboard.", "prefix" => "dashboard"], function () {
			Route::get('/', 'DashboardSettingController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
			Route::put('/', 'DashboardSettingController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		});

		Route::group(["as" => "landing-page.", "prefix" => "landing-page"], function () {
			Route::get('/', 'LandingPageSettingController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
			Route::put('/', 'LandingPageSettingController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN])]);
		});
	});

    Route::group(["as" => "galleries.", "prefix" => "galleries"], function () {
		Route::get('/', 'GalleryController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'GalleryController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'GalleryController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'GalleryController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'GalleryController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'GalleryController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'GalleryController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

    Route::group(["as" => "services.", "prefix" => "services"], function () {
		Route::get('/', 'ServiceController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'ServiceController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'ServiceController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'ServiceController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'ServiceController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'ServiceController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'ServiceController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

    Route::group(["as" => "blog-categories.", "prefix" => "blog-categories"], function () {
		Route::get('/', 'BlogCategoryController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'BlogCategoryController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'BlogCategoryController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'BlogCategoryController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'BlogCategoryController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'BlogCategoryController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'BlogCategoryController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

    Route::group(["as" => "blogs.", "prefix" => "blogs"], function () {
		Route::get('/', 'BlogController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'BlogController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'BlogController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'BlogController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'BlogController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'BlogController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'BlogController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

    Route::group(["as" => "inboxs.", "prefix" => "inboxs"], function () {
		Route::get('/', 'InboxController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'InboxController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

    Route::group(["as" => "announcements.", "prefix" => "announcements"], function () {
		Route::get('/', 'AnnouncementController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'AnnouncementController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'AnnouncementController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'AnnouncementController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'AnnouncementController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'AnnouncementController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'AnnouncementController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "indonesia.", "prefix" => "indonesia"], function () {
		Route::group(["as" => "provinces.", "prefix" => "provinces"], function () {
			Route::get('/', 'ProvinceController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		});
		Route::group(["as" => "cities.", "prefix" => "cities"], function () {
			Route::get('/', 'CityController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		});
		Route::group(["as" => "districts.", "prefix" => "districts"], function () {
			Route::get('/', 'DistrictController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		});
		Route::group(["as" => "villages.", "prefix" => "villages"], function () {
			Route::get('/', 'VillageController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		});
	});

	Route::group(["as" => "potentials.", "prefix" => "potentials"], function () {
		Route::get('/', 'PotentialController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'PotentialController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'PotentialController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'PotentialController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'PotentialController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'PotentialController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'PotentialController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "potential-categories.", "prefix" => "potential-categories"], function () {
		Route::get('/', 'PotentialCategoryController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'PotentialCategoryController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'PotentialCategoryController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'PotentialCategoryController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'PotentialCategoryController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'PotentialCategoryController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'PotentialCategoryController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "populations.", "prefix" => "populations"], function () {
		Route::get('/', 'PopulationController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'PopulationController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'PopulationController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'PopulationController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'PopulationController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'PopulationController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'PopulationController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "pages.", "prefix" => "pages"], function () {
		Route::get('/', 'PageController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'PageController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'PageController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'PageController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "employees.", "prefix" => "employees"], function () {
		Route::get('/', 'EmployeeController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'EmployeeController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'EmployeeController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'EmployeeController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'EmployeeController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'EmployeeController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'EmployeeController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "informations.", "prefix" => "informations"], function () {
		Route::get('/', 'InformationController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'InformationController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'InformationController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'InformationController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'InformationController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'InformationController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'InformationController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "files.", "prefix" => "files"], function () {
		Route::get('/', 'FileController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'FileController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'FileController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'FileController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'FileController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'FileController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'FileController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});

	Route::group(["as" => "sliders.", "prefix" => "sliders"], function () {
		Route::get('/', 'SliderController@index')->name("index")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/create', 'SliderController@create')->name("create")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}', 'SliderController@show')->name("show")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::get('/{id}/edit', 'SliderController@edit')->name("edit")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::post('/', 'SliderController@store')->name("store")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::put('/{id}', 'SliderController@update')->name("update")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
		Route::delete('/{id}', 'SliderController@destroy')->name("destroy")->middleware(['role:' . implode('|', [RoleEnum::SUPERADMIN,RoleEnum::ADMINISTRATOR])]);
	});
});