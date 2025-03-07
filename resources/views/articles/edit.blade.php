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

    .form-control.textarea {
        height: 120px;
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

    .image-preview {
        max-width: 200px;
        margin-top: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="container mt-5">
    <div class="form-container">
        <h2>Éditer un Article</h2>

        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $article->titre) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control textarea" required>{{ old('description', $article->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="context">Contexte</label>
                <textarea name="context" id="context" class="form-control textarea" required>{{ old('context', $article->context) }}</textarea>
            </div>

            <div class="form-group">
                <label for="instruction">Instruction</label>
                <textarea name="instruction" id="instruction" class="form-control textarea" required>{{ old('instruction', $article->instruction) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Choisir une nouvelle image (facultatif)</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            @if ($article->image)
                <div class="form-group">
                    <label>Image actuelle</label>
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" class="img-thumbnail image-preview">
                </div>
            @endif

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Mettre à jour l'Article</button>
            </div>
        </form>
    </div>
</div>

@endsection
