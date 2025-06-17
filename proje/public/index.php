<?php
require 'C:\xampp\htdocs\proje\config\db.php';
require 'C:\xampp\htdocs\proje\app\controller\UrlController.php';

$controller = new UrlController($pdo);

$code = $_GET['code'] ?? '';
if ($code) {
    $controller->redirect($code);
    exit;
}

$error = '';
$shortURL = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = trim($_POST['url'] ?? '');

    // Regex ile geçerli URL kontrolü
    if (!preg_match('/^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/\S*)?$/i', $url)) {
        $error = "Lütfen geçerli bir URL giriniz.";
    } else {
        $shortCode = $controller->shorten($url);
        $shortURL = "http://localhost/" . $shortCode;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>URL Kısaltma Uygulaması</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff0f5;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(255, 105, 180, 0.2);
            width: 420px;
            text-align: center;
            border: 2px solid #ffc0cb;
        }
        h1 {
            color: #d63384;
        }
        input[type="url"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: 2px solid #ffb6c1;
            border-radius: 6px;
            background-color: #fff5f7;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #ff69b4;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #d63384;
        }
        .error {
            color: #cc0033;
            margin-top: 15px;
            font-weight: bold;
        }
        .result {
            margin-top: 20px;
            background-color: #ffe6ef;
            padding: 15px;
            border-radius: 6px;
            word-break: break-word;
            text-align: center;
            border: 1px dashed #ffb6c1;
        }
        input#short-url {
            border: 2px solid #ff69b4;
            background-color: #fff0f5;
            color: #d63384;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>URL Kısaltma</h1>
    <form method="POST" action="">
        <input type="url" name="url" placeholder="https://ornek.com/uzun-url" required
               value="<?= htmlentities($_POST['url'] ?? '') ?>">
        <input type="submit" value="Kısalt">
    </form>

    <?php if ($error): ?>
        <div class="error"><?= htmlentities($error) ?></div>
    <?php endif; ?>

    <?php if ($shortURL): ?>
        <div class="result">
            <label for="short-url"><strong>Kısa URL'niz:</strong></label>
            <input type="text" id="short-url" readonly value="<?= htmlentities($shortURL) ?>" onclick="this.select();">
        </div>
    <?php endif; ?>
</div>
</body>
</html>
