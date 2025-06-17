<?php
class Url
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByURL($url)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM urls WHERE original_url = ?");
        $stmt->execute([$url]);
        return $stmt->fetch();
    }

    public function findByCode($code)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM urls WHERE short_code = ?");
        $stmt->execute([$code]);
        return $stmt->fetch();
    }

    public function insert($url, $code)
    {
        $stmt = $this->pdo->prepare("INSERT INTO urls (original_url, short_code) VALUES (?, ?)");
        $stmt->execute([$url, $code]);
    }
}
