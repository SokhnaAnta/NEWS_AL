<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article->titre, ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .art {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .art h2 {
            font-size: 2em;
            margin-top: 0;
            color: #007bff;
        }
        .art p {
            line-height: 1.6;
            font-size: 1.2em;
            margin: 0;
        }
        .art .date {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .art {
                padding: 15px;
            }
            .art h2 {
                font-size: 1.5em;
            }
            .art p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="art">
        <h2><?= htmlspecialchars($article->titre, ENT_QUOTES, 'UTF-8'); ?></h2>
        <p class="date"><?= htmlspecialchars(date('d F Y', strtotime($article->dateCreation)), ENT_QUOTES, 'UTF-8'); ?></p>
        <p><?= htmlspecialchars($article->contenu, ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
</body>
</html>
