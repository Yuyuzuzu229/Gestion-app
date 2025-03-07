<?php
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Redirection vers la page de connexion si l'utilisateur n'est pas authentifié
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');  // Redirige vers le tableau de bord si l'utilisateur est connecté
    } else {
        return redirect()->route('login');  // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    }
});

// Utilisation de Route::resource pour générer toutes les routes CRUD
Route::resource('articles', ArticleController::class);

// Route pour générer le PDF
Route::get('/articles/{id}/pdf', [ArticleController::class, 'generatePDF'])->name('articles.pdf');

// Routes d'authentification
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirection vers la page 'liste' après connexion réussie
Route::get('/dashboard', function () {
    return redirect()->route('articles.index');  // Redirige vers la page des articles
})->middleware('auth')->name('dashboard');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Vérification de l'authentification de l'utilisateur
Route::get('/check-auth', function () {
    return response()->json(['authenticated' => Auth::check()]);
});
