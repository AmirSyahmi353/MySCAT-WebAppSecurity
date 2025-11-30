<?php

use Illuminate\Support\Facades\Route;

// ---------------- AUTH CONTROLLERS ----------------
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ---------------- USER CONTROLLERS ----------------
use App\Http\Controllers\DemographicController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\FoodDiaryController;

// ---------------- ADMIN CONTROLLERS ----------------
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DietitianController as AdminDietitianController;

use App\Http\Controllers\Dietitian\DashboardController;
use App\Http\Controllers\Dietitian\DietitianAuthController;
use App\Http\Controllers\Dietitian\ResultController as DietitianResultController;
/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('welcome');

// Terms & Contact pages
Route::view('/terms-policy', 'terms-policy')->name('terms-policy');
Route::view('/contact-us', 'contact')->name('contact');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION (LOGIN/REGISTER)
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


/*
|--------------------------------------------------------------------------
| USER HOME (AFTER LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/home', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| DEMOGRAPHICS (PATIENT ONBOARDING)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Create demographic (first-time)
    Route::get('/demographics/create', [DemographicController::class, 'create'])
        ->name('demographics.create');

    Route::post('/demographics', [DemographicController::class, 'store'])
        ->name('demographics.store');

    // Update existing demographic
    Route::get('/demographics/edit', [DemographicController::class, 'edit'])
        ->name('demographics.edit');

    Route::put('/demographics/{id}', [DemographicController::class, 'update'])
        ->name('demographics.update');

    // View demographic
    Route::get('/demographics/show', [DemographicController::class, 'show'])
        ->name('demographics.show');
});


/*
|--------------------------------------------------------------------------
| MySCAT QUESTIONNAIRE
|--------------------------------------------------------------------------
*/

Route::prefix('questionnaire')->name('questionnaire.')->group(function () {
    Route::get('/intro', [QuestionnaireController::class, 'intro'])->name('intro');
    Route::post('/start', [QuestionnaireController::class, 'start'])->name('start');

    Route::get('/page/{page}', [QuestionnaireController::class, 'page'])
        ->whereNumber('page')
        ->name('page');

    Route::post('/save/{page}', [QuestionnaireController::class, 'savePage'])
        ->whereNumber('page')
        ->name('savePage');

    Route::get('/submit', [QuestionnaireController::class, 'submit'])->name('submit');
});

// Results
Route::middleware('auth')->get('/result', [QuestionnaireController::class, 'showResult'])
    ->name('result.show');


/*
|--------------------------------------------------------------------------
| FOOD DIARY
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('food-diary')->name('food-diary.')->group(function () {

    Route::get('/info', [FoodDiaryController::class, 'info'])->name('info');

    Route::get('/day', [FoodDiaryController::class, 'day'])->name('day');

    Route::post('/day/{day}/add-item', [FoodDiaryController::class, 'addItem'])
        ->where('day', '[1-3]')
        ->name('day.addItem');

    Route::delete('/day/{day}/{index}/delete', [FoodDiaryController::class, 'deleteItem'])
        ->where(['day' => '[1-3]', 'index' => '[0-9]+'])
        ->name('day.delete');

    Route::post('/submit-final', [FoodDiaryController::class, 'submitFinal'])
        ->name('submitFinal');

    Route::get('/view', [FoodDiaryController::class, 'view'])->name('view');
});


Route::prefix('admin')->name('admin.')->group(function () {

    // Admin login views & processing
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Admin logout
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Manage dietitians (admin only)
        Route::resource('dietitians', DietitianController::class);
    });




/*
|--------------------------------------------------------------------------
| DIETITIAN AUTH (LOGIN/LOGOUT)
|--------------------------------------------------------------------------
*/

Route::prefix('dietitian')->name('dietitian.')->group(function () {

    // Dietitian login
    Route::get('/login', [DietitianAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [DietitianAuthController::class, 'login'])->name('login.submit');

    // Dietitian logout
    Route::get('/logout', [DietitianAuthController::class, 'logout'])->name('logout');
});



/*
|--------------------------------------------------------------------------
| DIETITIAN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('dietitian')
    ->name('dietitian.')
    ->group(function () {

        // Dietitian dashboard (should NOT use admin dashboard)
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Add more dietitian-only features here later
        // Example:
        // Route::get('/patients', [DietitianPatientController::class, 'index'])->name('patients');

         Route::get('/results', [DietitianResultController::class, 'index'])
            ->name('results.index');

        Route::get('/results/{id}', [DietitianResultController::class, 'show'])
            ->name('results.show');
    });
  
       

     