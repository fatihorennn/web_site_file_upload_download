# web_site_file_upload_download

# Dosya Yükleme Sistemi

Bu proje, kullanıcıların oturum açarak çeşitli türlerde dosya yükleyebildiği basit bir web tabanlı dosya yönetim sistemidir. 
Proje, öğrenme ve kişisel gelişim amacıyla PHP, JavaScript ve HTML/CSS teknolojileri kullanılarak geliştirilmiştir.

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
- Apache

## 📁 Proje Yapısı
dosya_yukle/

├── mainpage.html

├── login.html / register.html / uploadpage.html

├── style.css / script.js

├── db.php / auth_check.php / login.php / logout.php / register.php / upload.php

├── yuklenenler/ # Yüklenen dosyaların tutulduğu klasör. Bu klasörü /var/www dizinin altında tutabilirsiniz.

├── jpg-folder/ # Görsel dosyalar (arka plan vs.)

## ⚙️ Kurulum ve Kullanım

### APACHE İÇİN (Ubuntu-Server)
0. Apache yi indir ve kur.
1. Proje klasörünü `/var/www/html` dizinine kopyala.
2. `dosya_yukle.sql` dosyasını MySQL veritabanına içe aktar.
3. `db.php` içinde veritabanı erişim bilgilerini düzenle. Yorum satırlarıyla ilgili satırlar işaretlendi.
4. `https://www.google.com/recaptcha/admin/create` adresinden yeni site kaydı yapın.
5. Site kaydı yaparken  Domain Name (Alan Adı) kısmına çalıştıracağınız IP adresi ya da Alan adını yazınız.
6. Kaydı tamamladıktan sonra `site-key` ve `secret-key` leri alın.
7. `login.html`, `login.php`, `register.html`, `register.php` sayfalarına bu keyleri girin. Hangi keyi nereye gireceğiniz belirtimiştir.
8. `/var/www` dizinine `yuklenenler` isimli bir dizin oluşturun.
9. Dosya sahipliği `chown www-data:www-data /var/www/html/*` ya ait olmalı. Dosya izinlerini ayarlayın `chmod 755 /var/www/html/*` komutunu kullanabilirsiniz. 
10. `/var/www/yuklenenler` dizini  `chown www-data:www-data /var/www/yuklenenler` komutu ile dosya sahibi değişmeli. Bu klasöre çalışma izni vermeyin.
11. Test edin.
