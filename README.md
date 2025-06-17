# Url Kısaltma Uygulaması

Bu proje, MVC mimarisinde geliştirilmiş basit bir URL kısaltma uygulamasıdır. Uzun URL'leri kısaltarak kolay paylaşılabilir hale getirir ve kısa URL'lere giriş yapan kullanıcıları orijinal uzun URL'lere yönlendirir.

---

## Özellikler

- Uzun URL'leri kısa ve benzersiz kodlarla kısaltma
- URL doğrulama (regex ve PHP filtreleriyle)
- Aynı URL için tekrar kısaltma yapıldığında önceden oluşturulmuş kodu gösterme
- Kısa URL tıklaması ile otomatik yönlendirme
- Kriptografik olarak güvenli ve karmaşık kısa kod üretimi
- MVC yapısına uygun düzen

---

## Gereksinimler

- PHP 7.4 veya üzeri
- MySQL veya MariaDB veritabanı
- Apache veya Nginx web sunucusu (XAMPP veya benzeri localhost paketleri önerilir)
- PDO eklentisi (varsayılan olarak PHP'de bulunur)

---

## Kurulum

1. **Proje dosyalarını kopyala**

   Proje dosyalarını web sunucunuzun kök dizinine (örneğin XAMPP için `htdocs/proje`) kopyalayın.

2. **Veritabanı oluştur**

   MySQL/MariaDB yönetim paneli (phpMyAdmin gibi) kullanarak aşağıdaki sorgu ile veritabanı ve tabloyu oluşturun:

   ```sql
   CREATE DATABASE url_shortener CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

   USE url_shortener;

   CREATE TABLE urls (
       id INT AUTO_INCREMENT PRIMARY KEY,
       long_url TEXT NOT NULL,
       short_code VARCHAR(255) NOT NULL UNIQUE,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```
3. **Veritabanı bağlantı ayarlarını yapılandır**
config/db.php dosyasını açın ve veritabanı erişim bilgilerinizi aşağıdaki gibi düzenleyin:
```php
<?php
$host = 'localhost';
$db   = 'url_shortener';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
```
4. Sunucuyu Başlatın
http://localhost/proje/public adresine gidin


## Linkler
- Kaynak Kodlar:[Tıklayınız]()
- AI sohbeti:[Tıklayınız](https://chatgpt.com/share/68512cde-f72c-8013-a2d6-388ac765dfed)

