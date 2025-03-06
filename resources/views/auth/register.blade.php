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
        <h2>Inscription</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" value="{{ old('pseudo') }}" required>
                @error('pseudo') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe" required>
            </div>

            <div class="form-group">
                <input type="file" name="avatar" accept="image/*" class="form-control">
                @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>

        <p class="text-center mt-3">Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
    </div>
</div>

@endsection
