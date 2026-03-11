<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectPointController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\ResgateController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EmpresaResgateController;
use App\Http\Controllers\CollectController;

// ============================================================================
// ROTAS GERAIS DA PLATAFORMA (PÚBLICAS)
// ============================================================================

Route::get('/', [AppController::class, 'home'])->name('home');

// Documentos legais
Route::get('/legal/privacy-policy', [AppController::class, 'privacyPolicy'])->name('legal.privacy-policy');
Route::get('/legal/terms', [AppController::class, 'terms'])->name('legal.terms');

// Suporte
Route::get('/support/faq', [AppController::class, 'faq'])->name('support.faq');
Route::get('/support/help-center', [AppController::class, 'support'])->name('support.help-center');

// Sobre a empresa
Route::get('/company/about', [AppController::class, 'about'])->name('company.about');
Route::get('/company/impact', [AppController::class, 'impact'])->name('company.impact');
Route::get('/company/mission', [AppController::class, 'mission'])->name('company.mission');

// Informações institucionais
Route::get('/company/info/scoring', [AppController::class, 'scoring'])->name('company.info.scoring');
Route::get('/company/info/rewards', [AppController::class, 'rewards'])->name('company.info.rewards');
Route::get('/company/info/collects', [AppController::class, 'collects'])->name('company.info.collects');
Route::get('/company/info/partnerships', [AppController::class, 'partnerships'])->name('company.info.partnerships');
Route::get('/company/info/advertisements', [AppController::class, 'advertisements'])->name('company.info.advertisements');

// Páginas informativas
Route::get('/info-pages/how-to-recycle', [AppController::class, 'howToRecycle'])->name('info-pages.how-to-recycle');
Route::get('/info-pages/how-to-score', [AppController::class, 'howToScore'])->name('info-pages.how-to-score');
Route::get('/info-pages/how-to-redeem', [AppController::class, 'howToRedeem'])->name('info-pages.how-to-redeem');
Route::get('/info-pages/games-and-quizzes', [AppController::class, 'gamesAndQuizzes'])->name('info-pages.games-and-quizzes');

// ============================================================================
// ROTAS PÚBLICAS DE RECURSOS
// ============================================================================

// Materiais
Route::get('/materials/dashboard', [MaterialController::class, 'dashboard'])->name('materials.dashboard');
Route::get('/materials/show/{material}', [MaterialController::class, 'show'])->name('materials.show');

// Recompensas
Route::get('/rewards/dashboard', [RewardController::class, 'dashboard'])->name('rewards.dashboard');
Route::get('/rewards/show/{reward}', [RewardController::class, 'show'])->name('rewards.show');

// Anúncios
Route::get('/advertisements/dashboard', [AdvertisementController::class, 'dashboard'])->name('advertisements.dashboard');
Route::get('/advertisements/show/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisements.show');

// Pontos de coleta
Route::get('/collect-points/dashboard', [CollectPointController::class, 'dashboard'])->name('collect-points.dashboard');
Route::get('/collect-points/show/{collectPoint}', [CollectPointController::class, 'show'])->name('collect-points.show');

// Empresas
Route::get('/empresas/dashboard', [EmpresaController::class, 'dashboard'])->name('empresas.dashboard');
Route::get('/empresas/show/{empresa}', [EmpresaController::class, 'show'])->name('empresas.show');

// ============================================================================
// AUTH MIDDLEWARE
// ============================================================================


Route::middleware(['auth'])->group(function () {

    // RANKING
    Route::get('/ranking', [AppController::class, 'ranking'])->name('ranking');
 
    // MY POINTS
    Route::get('/my-points', [UserController::class, 'myPoints'])->name('my-points');

    // RECOMPENSAS
    Route::get('/rewards/create', [RewardController::class, 'create'])->name('rewards.create');
    Route::post('/rewards', [RewardController::class, 'store'])->name('rewards.store');
    Route::get('/rewards/edit/{reward}', [RewardController::class, 'edit'])->name('rewards.edit');
    Route::put('/rewards/update/{reward}', [RewardController::class, 'update'])->name('rewards.update');
    Route::delete('/rewards/delete/{reward}', [RewardController::class, 'destroy'])->name('rewards.destroy');
    Route::get('/my-rewards', [RewardController::class, 'myRewards'])->name('rewards.my');
    Route::post('/rewards/redeem/{reward}', [RewardController::class, 'redeem'])->name('rewards.redeem');

    // COLETAS
    Route::get('/my-collects', [CollectController::class, 'myCollects'])->name('collects.my-collects');
    Route::get('/collects/create', [CollectController::class, 'create'])->name('collects.create');
    Route::post('/collects', [CollectController::class, 'store'])->name('collects.store');
    Route::get('/collects/{collect}', [CollectController::class, 'show'])->name('collects.show');
    Route::post('/collects/{collect}/cancel', [CollectController::class, 'cancel'])->name('collects.cancel');

    // ANÚNCIOS
    Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
    Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store');
    Route::get('/advertisements/edit/{advertisement}', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
    Route::put('/advertisements/update/{advertisement}', [AdvertisementController::class, 'update'])->name('advertisements.update');
    Route::delete('/advertisements/delete/{advertisement}', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');
    Route::get('/my-advertisements', [AdvertisementController::class, 'myAdvertisements'])->name('advertisements.my');

    // EMPRESAS
    Route::get('/empresas/edit/{empresa}', [EmpresaController::class, 'edit'])->name('empresas.edit');
    Route::put('/empresas/update/{empresa}', [EmpresaController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/delete/{empresa}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

    // RESGATES (USUÁRIO CADASTRADO)
    Route::get('/resgates', [ResgateController::class, 'index'])->name('resgates.index');
    Route::get('/resgates/show/{resgate}', [ResgateController::class, 'show'])->name('resgates.show');
    Route::get('/resgates/{resgate}/reembolsar', [ResgateController::class, 'reembolsarPage'])->name('resgates.reembolsar.page');
    Route::post('/resgates/{resgate}/reembolsar', [ResgateController::class, 'reembolsar'])->name('resgates.reembolsar');

    // RESGATES (EMPRESA)
    Route::get('/empresas/resgates', [EmpresaResgateController::class, 'index'])->name('empresas.resgates.index');
    Route::get('/empresas/resgates/validar', [EmpresaResgateController::class, 'validarPage'])->name('empresas.resgates.validar.page');
    Route::post('/empresas/resgates/validar', [EmpresaResgateController::class, 'validarCodigo'])->name('empresas.resgates.validar');
    Route::post('/empresas/resgates/{resgate}/reembolsar', [EmpresaResgateController::class, 'reembolsar'])->name('empresas.resgates.reembolsar');

    // FEEDBACKS
    Route::get('/feedbacks/show/{feedback}', [FeedbackController::class, 'show'])->name('feedbacks.show');
    Route::post('/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');
    Route::put('/feedbacks/update/{feedback}', [FeedbackController::class, 'update'])->name('feedbacks.update');
    Route::delete('/feedbacks/delete/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

    // USUÁRIOS E PERFIL
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/photo-delete', [UserController::class, 'deletePhoto'])->name('user.photo.delete');
});


// ============================================================================
// ADMIN MIDDLEWARE
// ============================================================================


Route::middleware(['admin'])->group(function () {

    // RESGATES
    Route::get('/admin/resgates', [ResgateController::class, 'indexAdmin'])->name('admin.resgates.index');
    Route::get('/admin/resgates/{resgate}', [ResgateController::class, 'showAdmin'])->name('admin.resgates.show');
    Route::post('/admin/resgates/reembolsar-expirados', [ResgateController::class, 'reembolsarExpirados'])->name('admin.resgates.reembolsar-expirados');

    // GESTÃO DE USUÁRIOS
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/show/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UserController::class, 'updateByAdmin'])->name('users.update');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // PONTOS DE COLETA 
    Route::get('/collect-points', [CollectPointController::class, 'index'])->name('collect-points.index');
    Route::get('/collect-points/create', [CollectPointController::class, 'create'])->name('collect-points.create');
    Route::post('/collect-points', [CollectPointController::class, 'store'])->name('collect-points.store');
    Route::get('/collect-points/edit/{collectPoint}', [CollectPointController::class, 'edit'])->name('collect-points.edit');
    Route::put('/collect-points/update/{collectPoint}', [CollectPointController::class, 'update'])->name('collect-points.update');
    Route::delete('/collect-points/delete/{collectPoint}', [CollectPointController::class, 'destroy'])->name('collect-points.destroy');

    // MATERIAIS
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/edit/{material}', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/update/{material}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/delete/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

    // ANÚNCIOS
    Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');

    // EMPRESAS
    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::get('/empresas/create', [EmpresaController::class, 'create'])->name('empresas.create');
    Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresas.store');
    Route::put('/admin/empresas/update/{empresa}', [EmpresaController::class, 'updateByAdmin'])->name('admin.empresas.update');

    // FEEDBACKS
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');

    // COLETAS
    Route::get('/collects', [CollectController::class, 'index'])->name('collects.index');
    Route::post('/collects/{collect}/validate', [CollectController::class, 'validateCollect'])->name('collects.validate');

    // RECOMPENSAS
    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
});



// ============================================================================
// DASHBOARD JETSTREAM
// ============================================================================


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
