<?php
$dbHost = getenv('DB_HOST') ?: 'db';
$dbPort = getenv('DB_PORT') ?: '3306';
$dbName = getenv('DB_NAME') ?: 'bandnames';
$dbUser = getenv('DB_USER') ?: 'banduser';
$dbPassword = getenv('DB_PASSWORD') ?: 'bandpass';

$message = null;
$bandnames = [];

function getPdo($host, $port, $dbName, $user, $password)
{
    $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=utf8mb4";
    return new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    if ($action === 'check_db') {
        try {
            $pdo = getPdo($dbHost, $dbPort, $dbName, $dbUser, $dbPassword);
            $message = "Communication avec la base de données établie";
        } catch (Exception $e) {
            $message = "Impossible de se connecter à la base de données";
        }
    }

    if ($action === 'generate') {
        try {
            $pdo = getPdo($dbHost, $dbPort, $dbName, $dbUser, $dbPassword);

            $adjectives = $pdo->query("SELECT label FROM adjectives")->fetchAll(PDO::FETCH_COLUMN);
            $nouns      = $pdo->query("SELECT label FROM nouns")->fetchAll(PDO::FETCH_COLUMN);

            for ($i = 0; $i < 10; $i++) {
                $bandnames[] = "The " .
                    $adjectives[array_rand($adjectives)] . " " .
                    $nouns[array_rand($nouns)];
            }

        } catch (Exception $e) {
            $message = "Impossible de se connecter à la base de données";
        }
    }
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Band Names Generator</title>
</head>
<body>
    <h1>Band Names Generator</h1>

    <form method="post">
        <button type="submit" name="action" value="check_db">Tester la connexion à la base de données</button>
        <button type="submit" name="action" value="generate">Générer 10 noms de groupe</button>
    </form>

    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($bandnames)): ?>
        <h2>Résultats :</h2>
        <ul>
        <?php foreach ($bandnames as $name): ?>
            <li><?= htmlspecialchars($name) ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
