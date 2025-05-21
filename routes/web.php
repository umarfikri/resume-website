<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainResume;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CmsResume;
use App\Http\Middleware\CheckLoginSession;

Route::get('/', [MainResume::class, 'mainResume'])->name('mainResume');
route::post('/contactStore', [MainResume::class, 'contactStore'])->name('contactStore');

// Login
Route::get('/loginPage', [LoginController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Cms Side
Route::middleware('CheckLoginSession:viewer,editor,admin')->group(function () { /** Admin, Editor and Viewer access */
    Route::get('/cms', [CmsResume::class, 'mainCms'])->name('cms');
    // Contact
    Route::get('/cms/contact', [CmsResume::class, 'contact'])->name('contact');
    // Profile
    Route::get('/cms/profileSetting', [CmsResume::class, 'profileSetting'])->name('profileSetting');
    Route::post('/updateProfile', [CmsResume::class, 'updateProfile']);
});

Route::middleware('CheckLoginSession:admin,editor')->group(function () { /** Admin and Editor access */
    // Document
    Route::get('/cms/resumePortfolio', [CmsResume::class, 'resumePortfolio'])->name('resumePortfolio');
    Route::post('/updateDocument/{document}', [CmsResume::class, 'updateDocument'])->name('updateDocument');
    // Contact (Delete Only)
    Route::delete('/deleteContact/{contact}', [CmsResume::class, 'deleteContact'])->name('deleteContact');
    // Project
    Route::get('/cms/project', [CmsResume::class, 'project'])->name('project');
    Route::delete('/deleteProject/{projectid}', [CmsResume::class, 'deleteProject'])->name('deleteProject');
    Route::get('/cms/addProject', [CmsResume::class, 'addProject'])->name('addProject'); //Page Only
    Route::post('/addProjectSubmit', [CmsResume::class, 'addProjectSubmit']);
    Route::get('/cms/editProject/{projectid}', [CmsResume::class, 'editProject'])->name('editProject'); //Page Only
    Route::post('/editProjectSubmit', [CmsResume::class, 'editProjectSubmit']);
    Route::delete('/deleteImage/{projectid}/mainImage', [CmsResume::class, 'deleteMainImage'])->name('deleteMainImage'); // Delete Main Image
    Route::delete('/deleteImage/{projectid}/galleryImage/{imageFilename}', [CmsResume::class, 'deleteGalleryImage'])->name('deleteGalleryImage'); // Delete Gallery Image
});    

// Account
Route::middleware('CheckLoginSession:admin')->group(function () { /** Admin access */
    Route::get('/cms/accountList', [CmsResume::class, 'accountList'])->name('accountList');
    Route::post('/addAccount', [CmsResume::class, 'addAccount']);
    Route::post('/editAccount', [CmsResume::class, 'editAccount']);
    Route::delete('/deleteAccount/{userid}', [CmsResume::class, 'deleteAccount'])->name('deleteAccount');
});

