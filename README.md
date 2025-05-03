# web_site_file_upload_download

# !!!ŞUANDA GELİŞİM AŞAMASINDADIR VE BU SEBEPLE GÜVENLİK AÇIKLIKLARI MEVCUTTUR!!!

# Dosya Yükleme Sistemi

Bu proje, kullanıcıların oturum açarak çeşitli türlerde dosya yükleyebildiği basit bir web tabanlı dosya yönetim sistemidir. Proje, öğrenme ve kişisel gelişim amacıyla PHP, JavaScript ve HTML/CSS teknolojileri kullanılarak geliştirilmiştir.

## 🚀 Özellikler

- Kullanıcı kayıt ve giriş sistemi (rol bazlı: sadece `low_user`)
- PHP PDO ile güvenli veritabanı bağlantısı
- Oturum kontrolü (`session` tabanlı)
- Drag & Drop ile dosya yükleme (AJAX ile)
- Görsel dosyaların önizlemesi
- Dosya tipi ve uzantı filtreleme
- Responsive arayüz (masaüstü uyumlu)

## 🔧 Kullanılan Teknolojiler

- PHP (PDO ile)
- HTML5 + CSS3
- JavaScript (Fetch API)
- MySQL (veritabanı)
- Apache (localhost ortamı için)

## 📁 Proje Yapısı
dosya_yukle/
├── mainpage.html
├── login.html / register.html / uploadpage.html
├── style.css / script.js
├── db.php / auth_check.php / login.php / logout.php / register.php / upload.php
├── yuklenenler/ # Yüklenen dosyaların tutulduğu klasör
├── jpg-folder/ # Görsel dosyalar (arka plan vs.)

## ⚙️ Kurulum ve Kullanım

1. Proje klasörünü yerel sunucuna (XAMPP / WAMP / LAMP) kopyala.
2. `dosya_yukle.sql` dosyasını MySQL veritabanına içe aktar.
3. `db.php` içinde veritabanı erişim bilgilerini düzenle.
4. Tarayıcında `http://localhost/dosya_yukle/mainpage.html` adresini aç.
5. Kayıt ol ve ardından giriş yaparak dosya yüklemeyi test et.
