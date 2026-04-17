<?php


use App\Http\Controllers\AboutInfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PerformenceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/documents', [PortfolioController::class, 'documents'])->name('documents');
Route::get('/documents/{document}/download', [DocumentController::class, 'publicDownload'])->name('public.download');
Route::get('/performence/project',[PerformenceController::class, 'project'])->name('performence.project');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('documents', DocumentController::class);
    Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
    Route::patch('/service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::resource('/contact', ContactController::class);
    Route::resource('/information', InformationController::class);
    Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social.index');
    Route::post('/social-links', [SocialLinkController::class, 'store'])->name('social.store');
    Route::get('/admin/images', [ImageController::class, 'index'])->name('images.index');
    Route::post('/admin/images', [ImageController::class, 'store'])->name('images.store');
    Route::resource('services', ServiceController::class);
    Route::resource('formations', FormationController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('stats', StatController::class)->except(['show']);
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/about/edit', [AboutInfoController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about/update', [AboutInfoController::class, 'update'])->name('admin.about.update');
    Route::delete('/admin/about/reset', [AboutInfoController::class, 'reset'])->name('admin.about.reset');
    Route::resource('projects', ProjectController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
