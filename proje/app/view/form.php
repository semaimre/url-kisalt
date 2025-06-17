<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>URL Kısalt</title>
</head>
<body>
<h1>URL Kısalt</h1>
<form action="" method="POST">
    <input name="url" type="url" placeholder="https://example.com" required>
    <input type="submit" value="Kısalt">
</form>

<?php if (isset($error)): ?>
    <p style="color:red"><?= htmlentities($error) ?></p>
<?php endif ?>
</body>
</html>
