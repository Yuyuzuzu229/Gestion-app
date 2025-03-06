@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('wo.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Arial', sans-serif;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.85);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        margin-top: 50px;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 36px;
    }

    .article-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .article-card img {
        max-width: 200px;
        max-height: 200px;
        margin-right: 20px;
        border-radius: 8px;
    }

    .article-card-info {
        flex: 1;
        margin-top: 10px;
    }

    .article-card-info h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .article-card-info p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .btn-sticker {
        font-size: 24px;
        padding: 8px;
        margin: 5px;
        border-radius: 50%;
        background-color: #007bff;
        color: white;
        display: inline-block;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
    }

    .btn-sticker:hover {
        background-color: #0056b3;
    }

    #scan-qr-btn {
        background-color: #28a745;
        border: none;
        color: white;
        padding: 12px 25px;
        font-size: 18px;
        border-radius: 5px;
        display: block;
        width: 100%;
        margin-top: 20px;
        cursor: pointer;
        text-align: center;
    }

    #scan-qr-btn:hover {
        background-color: #218838;
    }
</style>

<div class="container">
    <div class="table-container">
        <h1>Liste des Articles</h1>

        @foreach ($articles as $article)
            <div class="article-card">
                <div class="article-card-info">
                    <h3>{{ $article->titre }}</h3>
                    <p><strong>Description:</strong> {{ $article->description }}</p>
                    <p><strong>Contexte:</strong> {{ $article->context }}</p>
                    <p><strong>Instructions:</strong> {{ $article->instruction }}</p>
                </div>
                <div class="article-card-img">
                    @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article">
                    @else
                        <span>Aucune image</span>
                    @endif
                </div>
                <div class="article-card-actions">
                    <a href="{{ route('articles.show', $article->id) }}" class="btn-sticker" title="Voir l'article">👁️</a>
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn-sticker" title="Modifier l'article">✏️</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-sticker" title="Supprimer l'article">🗑️</button>
                    </form>
                </div>
            </div>
        @endforeach

        <button id="scan-qr-btn">Scanner le QR Code</button>
    </div>
</div>

@endsection
