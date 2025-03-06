@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('wo.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Arial', sans-serif;
    }

    .form-container {
        max-width: 500px;
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
</style>

<div class="container mt-5">
    <div class="form-container">
        <h2>Ajouter un Article</h2>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="context">Contexte</label>
                <textarea name="context" id="context" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="instruction">Instruction</label>
                <textarea name="instruction" id="instruction" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Enregistrer l'Article</button>
            </div>
        </form>
    </div>
</div>

@endsection
