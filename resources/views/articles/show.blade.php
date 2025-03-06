@extends('layouts.app')

@section('content')
<style>
    body {
        background: url('{{ asset('wo.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Arial', sans-serif;
    }

    .content-container {
        background: rgba(255, 255, 255, 0.85);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        max-width: 800px;
        margin: auto;
    }

    .content-container h1 {
        text-align: center;
    }

    .content-container img {
        max-width: 100%;
        border-radius: 10px;
    }

    .qr-code {
        text-align: center;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        font-size: 18px;
        width: 100%;
        border-radius: 5px;
        text-align: center;
    }
</style>

<div class="container mt-5">
    <div class="content-container">
        <h1>{{ $article->titre }}</h1>
        <p><strong>Description:</strong> {{ $article->description }}</p>
        <p><strong>Contexte:</strong> {{ $article->context }}</p>
        <p><strong>Instructions:</strong> {{ $article->instruction }}</p>

        @if ($article->image)
            <div>
                <h3>Image de l'article</h3>
                <img src="{{ asset('storage/' . $article->image) }}" alt="Image de l'article">
            </div>
        @else
            <p>Aucune image disponible.</p>
        @endif

        <div class="qr-code">
            <h3>Scannez le QR Code pour accéder à cet article</h3>
            {!! QrCode::size(200)->generate(route('articles.show', $article->id)) !!}
        </div>

        <button id="download-pdf" class="btn btn-primary">Télécharger le PDF</button>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
        <script>
            document.getElementById('download-pdf').addEventListener('click', function () {
                const element = document.body;
                html2pdf().from(element).save("article_{{ $article->id }}.pdf");
            });
        </script>
    </div>
</div>

@endsection
