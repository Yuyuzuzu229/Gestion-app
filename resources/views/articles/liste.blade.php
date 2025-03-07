<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Articles</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            background: url('{{ asset('wo.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }
        .container {
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            margin-top: 20px;
        }
        .article-container {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding: 15px;
            scroll-behavior: smooth;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            white-space: nowrap;
        }
        .article-container::-webkit-scrollbar {
            display: none;
        }
        .card img {
            height: 180px;
            object-fit: cover;
        }
        .btn-add {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        #qr-reader-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 1050;
        }
        #qr-reader {
            width: 300px;
            height: 300px;
            background: white;
        }
        .btn-close-scanner {
            margin-top: 10px;
            padding: 5px 10px;
            background: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-logout {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <a href="{{ route('articles.create') }}" class="btn btn-success btn-add">➕ Ajouter un article</a>
    <button class="btn btn-info mt-3" onclick="startScanner()">📷 Scanner QR Code</button>
    
    <div class="container text-center">
        <h2 class="mb-4">Liste des Articles</h2>
        
        <div class="d-flex align-items-center justify-content-between w-100">
            <button class="btn btn-outline-secondary" onclick="scrollCarousel(-1)">❮</button>
            <div class="d-flex article-container">
                @foreach($articles as $article)
                <div class="card shadow-sm" style="width: 18rem; flex: 0 0 auto;">
                    <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/default-placeholder.png') }}" class="card-img-top" alt="Image de l'article">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $article->titre }}</h5>
                        <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">👁️</a>
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">✏️</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="btn btn-outline-secondary" onclick="scrollCarousel(1)">❯</button>
        </div>
    </div>
    
    <div id="qr-reader-container">
        <div id="qr-reader"></div>
        <button class="btn-close-scanner" onclick="stopScanner()">❌ Fermer</button>
    </div>
    
    <a href="{{ route('login') }}" class="btn btn-danger btn-logout">🚪 Déconnexion</a>
    
    <script>
        function scrollCarousel(direction) {
            let carousel = document.querySelector('.article-container');
            let scrollAmount = 400;
            carousel.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }

        function startScanner() {
            document.getElementById('qr-reader-container').style.display = 'flex';
            
            const qrCodeScanner = new Html5Qrcode("qr-reader");

            qrCodeScanner.start(
                { facingMode: "environment" }, 
                {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText, decodedResult) => {
                    window.location.href = decodedText; // Rediriger vers l'URL scanné
                },
                (errorMessage) => {
                    console.error(errorMessage);
                }
            ).catch(err => {
                console.error("Erreur lors de l'activation de la caméra", err);
                alert("Impossible d'accéder à la caméra. Veuillez vérifier les autorisations.");
            });
        }

        function stopScanner() {
            document.getElementById('qr-reader-container').style.display = 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
