<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Prétraitement de l'Eau</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            color: #00796b;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #004d40;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #b2dfdb;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        button {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #004d40;
        }
        p {
            text-align: justify;
        }
        #reading-time {
            font-size: 14px;
            color: #004d40;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Le Prétraitement de l'Eau</h1>
        <p id="reading-time"></p>
        <p id="content">
            <?php
             require_once "text.php";
        ?>

        </p>
        <button onclick="readContent()">Écouter le contenu</button>
    </div>

    <script>
        function calculateReadingTime(text) {
            const wordsPerMinute = 160; // Vitesse moyenne de lecture à voix haute
            const textLength = text.split(" ").length; // Nombre de mots dans le texte
            const readingTime = Math.ceil(textLength / wordsPerMinute); // Temps en minutes
            return readingTime;
        }

        function readContent() {
            // Récupérer le texte du contenu
            var contentText = document.getElementById('content').innerText;

            // Afficher le temps de lecture estimé
            var readingTime = calculateReadingTime(contentText);
            document.getElementById('reading-time').innerText = `Temps de lecture estimé: environ ${readingTime} minute${readingTime > 1 ? 's' : ''}.`;

            // Créer une nouvelle instance de SpeechSynthesisUtterance
            var speech = new SpeechSynthesisUtterance();
            speech.lang = 'fr-FR'; // Définir la langue en français
            speech.text = contentText; // Définir le texte à lire
            speech.rate = 0.9; // Vitesse de lecture (plus lent pour plus de naturel)
            speech.pitch = 1.0; // Hauteur de la voix (valeur standard)

            // Sélectionner une voix féminine en français
            var voices = window.speechSynthesis.getVoices();
            var selectedVoice = voices.find(voice => voice.lang === 'fr-FR' && voice.name.includes('Google'));
            if (selectedVoice) {
                speech.voice = selectedVoice;
            }

            // Lancer la synthèse vocale
            window.speechSynthesis.speak(speech);
        }

        // Charger les voix (nécessaire dans certains navigateurs)
        window.speechSynthesis.onvoiceschanged = function() {
            readContent(); // Charger les voix et relancer la fonction
        };
    </script>
</body>
</html>
