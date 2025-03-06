<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Articles')</title>
    <!-- Ajoute ici les liens vers tes styles CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
</head>
<body>
    

    <main>
        @yield('content') <!-- Ici tu injecteras le contenu spécifique à chaque vue -->
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Tous droits réservés</p>
    </footer>

  
    <!-- Conteneur pour la caméra -->
    <div id="qr-reader" style="width: 300px; display: none;"></div>

    <script>
        document.getElementById('scan-qr-btn').addEventListener('click', function() {
            document.getElementById('qr-reader').style.display = 'block';

            function onScanSuccess(decodedText, decodedResult) {
                console.log(`Code QR détecté : ${decodedText}`);

                // Vérifie si l'URL contient "/articles/"
                if (decodedText.includes("/articles/")) {
                    window.location.href = decodedText; // Redirige vers la page de l'article
                } else {
                    alert("Ce QR Code ne correspond pas à un article.");
                }
            }

            function onScanError(errorMessage) {
                console.warn(errorMessage);
            }

            let html5QrCode = new Html5Qrcode("qr-reader");
            html5QrCode.start(
                { facingMode: "environment" }, // Utilise la webcam principale
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 }
                },
                onScanSuccess,
                onScanError
            );
        });
    </script>
</body>
</html>
