<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\ManagerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:analyst'])->group(function () {
    Route::get('/analyst/dashboard', function () {
        return view('analystHome');
    });
});

Route::middleware(['auth:formateur'])->group(function () {
    Route::get('/formateur/dashboard', function () {
        return view('formateurHome');
    });
});

///////////////////////////////////////////////////////////////////////////////////////////////////////

Route::namespace("Admin")->prefix("superAdmin")->name("superAdmin.")->group(function () {

    Route::middleware("auth:super")->group(function () {

        Route::get("dashboard/{name?}", [SuperAdminController::Class, "index"])->name("dashboard");
        Route::get("/dashboard", [SuperAdminController::Class, "index"])->name("dashboard");

        Route::get("inbox", [ContactController::Class, "inbox"])->name("inbox");
        Route::post("message/delete", [ContactController::Class, "delete"])->name("message.delete");
        Route::post("message/setRead", [ContactController::Class, "setRead"])->name("message.setRead");

        Route::get("newsletter", [NewsletterController::Class, "display"])->name("newsletter");
        Route::post("newsletter/changeState", [PackageController::Class, "changeState"])->name("newsletter.changeState");

        Route::get("/managersGestion", [SuperAdminController::Class, "display"])->name("managers.display");
        Route::post("/managersGestion/delete", [SuperAdminController::Class, "delete"])->name("managers.delete");
        Route::get("/managersGestion/add", [SuperAdminController::Class, "add"])->name("managers.add");
        Route::post("/managersGestion/insert", [SuperAdminController::Class, "insert"])->name("managers.insert");


        #################################   Super Admin Tasks Begin    ###########################################################
        Route::middleware(["auth:admin", "isSuper"])->prefix("superAdmin")->group(function () {

//            Route::get("/", [ManagerController::Class, "display"])->name("managers.display");
//            Route::get("add", [ManagerController::Class, "add"])->name("managers.add");
//            Route::post("insert", [ManagerController::Class, "insert"])->name("managers.insert");

            Route::post("changeRole", [ManagerController::Class, "changeRole"])->name("managers.changeRole");

        });
        #################################   Super Admin Tasks End    #############################################################

        #################################   Editor Tasks Begin    ################################################################
        Route::middleware(["auth:admin", "isEditor"])->group(function () {


        });
        #################################   Editor Tasks Begin    ################################################################

        #################################   Moderator Tasks Begin  ###############################################################

        Route::prefix("servers")->group(function (){

            Route::get("/all",[ServerController::class,"index"])->name("server.index");
            Route::get("/",[ServerController::class,"index"])->name("server.index");
            Route::get("/add",[ServerController::class,"create"])->name("server.create");
            Route::post("/store-server",[ServerController::class,"store"])->name("server.store");
            Route::get("/edit-server/{id}",[ServerController::class,"edit"])->name("server.edit");
            Route::post("/update-server/{id}",[ServerController::class,"update"])->name("server.update");
            Route::get("/destroy/{id}",[ServerController::class,"destroy"])->name("server.destroy");
        });

        Route::prefix("packages")->group(function (){

            Route::get("/all",[PackageController::class,"index"])->name("package.index");
            Route::get("/",[PackageController::class,"index"])->name("package.index");
            Route::get("/add",[PackageController::class,"create"])->name("package.create");
            Route::post("/store-package",[PackageController::class,"store"])->name("package.store");
            Route::get("/edit-package/{id}",[PackageController::class,"edit"])->name("package.edit");
            Route::post("/update-package/{id}",[PackageController::class,"update"])->name("package.update");
            Route::get("/destroy/{id}",[PackageController::class,"destroy"])->name("package.destroy");
        });
    });
});



#######################################################################################################
                                           ## admin tasks##
#######################################################################################################
Route::namespace("Admin")->prefix("admin")->name("admin.")->group(function () {
    Route::middleware("auth:admin")->group(function () {

        Route::get("dashboard/{name?}", [AdminController::Class, "index"])->name("dashboard");
        Route::get("/projects",[AdminController::class, "displayProjects"])->name("projects");
        Route::get('/managers',[AdminController::class, "displayManagers"])->name("managers");
        Route::get('/analysts',[AdminController::class, "displayAnalysts"])->name("analysts");
        Route::post("/managers/projects",[AdminController::class,"affectationDesProjets"])->name("projects.to.managers");
        Route::post("/projects/submit",[AdminController::class,"projectsSubmit"])->name("projects.submit");
        Route::post("/managers/quota",[AdminController::class,"affectationQuota"])->name("manager.quota");
        Route::post("/managers/quota/change",[AdminController::class,"quotaChange"])->name("manager.change.quota");
        Route::post("/analysts/managers",[AdminController::class,"affectationDesManagers"])->name("managers.to.analysts");
        Route::post("/managers/submit",[AdminController::class,"managersSubmit"])->name("managers.submit");

    });
});


#######################################################################################################
                           ##general tasks##
#######################################################################################################
Route::namespace("Admin")->prefix("general")->name('general.')->group(function(){
    Route::middleware("auth")->group( function(){

        Route::get("logout", [GeneralController::Class, "logout"])->name("logout");
        Route::get("profile", [GeneralController::Class, "profile"])->name("profile");
        Route::post("update/general", [GeneralController::Class, "updateGeneral"])->name("update.general");
        Route::post("picture/reset", [GeneralController::Class, "resetPicture"])->name("picture.reset");
        Route::post("picture/change", [GeneralController::Class, "changePicture"])->name("picture.change");
        Route::post("changePass", [GeneralController::Class, "changePass"])->name("change_password");
    });
});

require __DIR__.'/auth.php';
