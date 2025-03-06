@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('wo.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .card {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="text-center mb-4">Éditer un Article</h2>
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $article->titre) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $article->description) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="context" class="form-label">Contexte</label>
                        <textarea name="context" id="context" class="form-control" rows="3" required>{{ old('context', $article->context) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="instruction" class="form-label">Instruction</label>
                        <textarea name="instruction" id="instruction" class="form-control" rows="3" required>{{ old('instruction', $article->instruction) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Choisir une nouvelle image (facultatif)</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>

                    @if ($article->image)
                        <div class="mb-3 text-center">
                            <p>Image actuelle :</p>
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success w-100">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
