@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('wo.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Arial', sans-serif;
    }

    .form-container {
        max-width: 450px;
        margin: auto;
        background: rgba(255, 255, 255, 0.85);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .form-container h2 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        height: 45px;
        font-size: 16px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        width: 100%;
        font-size: 18px;
        border-radius: 5px;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .alert {
        margin-bottom: 15px;
    }

    .text-center a {
        color: #007bff;
        font-weight: bold;
    }

    .text-center a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5">
    <div class="form-container">
        <h2>Connexion</h2>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') 
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password') 
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bouton de connexion -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>

        <p class="text-center mt-3">Pas encore inscrit ? <a href="{{ route('register') }}">S'inscrire</a></p>
    </div>
</div>

@endsection
