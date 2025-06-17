<?php
require __DIR__ . '/../model/Url.php';

class UrlController
{
    private $pdo;
    private $model;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->model = new Url($pdo);
    }

    public function shorten($url)
    {
        $existing = $this->model->findByURL($url);
        if ($existing) {
            return $existing['short_code'];
        }

        // Yeni kısa kod oluştur
        $code = $this->generateCode();
        $this->model->insert($url, $code);
        return $code;
    }

    public function redirect($code)
    {
        $url = $this->model->findByCode($code);
        if ($url) {
            header("Location: " . $url['original_url']);
            exit;
        } else {
            echo "Kısa URL bulunamadı.";
        }
    }

    private function generateCode()
    {
        $allowed = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
        $length = 12;
        $bytes = random_bytes($length);
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $allowed[ord($bytes[$i]) % strlen($allowed)];
        }

        // Çakışma varsa tekrar oluştur
        while ($this->model->findByCode($code)) {
            $code = $this->generateCode();
        }

        return $code;
    }
}
