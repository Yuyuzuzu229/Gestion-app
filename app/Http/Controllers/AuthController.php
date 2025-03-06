<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Gérer l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'pseudo' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'avatar' => 'nullable|image|max:2048'
        ]);

        // Gestion de l'avatar
        $avatarPath = $request->file('avatar') ? $request->file('avatar')->store('avatars', 'public') : null;

        User::create([
            'pseudo' => $request->pseudo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('login')->with('success', 'Inscription réussie ! Connecte-toi.');
    }

    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }
// Dans AuthController.php
public function login(Request $request)
{
    // Validation des données
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Authentifier l'utilisateur
    if (Auth::attempt($request->only('email', 'password'))) {
        // Redirige l'utilisateur vers la liste des articles après une connexion réussie
        return redirect()->route('articles.index');
    }

    // Si l'authentification échoue, redirige avec un message d'erreur
    return back()->with('error', 'Les identifiants sont incorrects');
}

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
