[![en](https://img.shields.io/badge/lang-en-blue.svg)](README.md)
[![id](https://img.shields.io/badge/lang-id-green.svg)](README.id.md)

# Simple Helpdesk

Sistem helpdesk sederhana yang dibangun dengan Laravel dan Filament, dirancang untuk kebutuhan helpdesk IT internal atau dukungan pelanggan.

## 🛠️ Stack Teknologi

- Laravel 12.x
- Filament 3.x
- PHP 8.2+
- SQLite

![dashboard](https://nos.jkt-1.neo.id/ombimo/simple-helpdesk/dashboard.png)
![create-ticket](https://nos.jkt-1.neo.id/ombimo/simple-helpdesk/create-ticket.png)

---

## 🚀 Fitur

- 🧾 Membuat dan melacak tiket support  
- 🏷️ Label berdasarkan kategori masalah, departemen, atau lokasi  
- 📎 Lampiran & Lapiran Bukti Pekerjaan  
- 📊 Dashboard dengan ringkasan status tiket  
- 🌍 Multi-bahasa (Bahasa Inggris & Indonesia)  

---

## Demo

- [Beranda](https://simple-helpdesk.ombimo.id/)
- [Panel Admin](https://simple-helpdesk.ombimo.id/admin)  
  user: `admin@domain.com`  
  pass: `admin123`

---

## 📦 Instalasi

```bash
git clone https://github.com/ombimo/simple-helpdesk.git
cd simple-helpdesk
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
---

## 💬 Dukungan Komunitas

Untuk pertanyaan, silakan bergabung di [GitHub Discussions](https://github.com/ombimo/simple-helpdesk/discussions) atau buka issue baru.

---

## 💼 Butuh Dukungan Profesional?

Butuh bantuan profesional atau pengembangan kustom?

- Pengembangan fitur kustom
- Bantuan onboarding & deployment
- Perbaikan bug prioritas

📩 Kontak: hello@ombimo.id

---

## 📄 Lisensi

Proyek ini bersifat open-source dengan lisensi [MIT](LICENSE).

---

## ✨ Pengembang

Dibuat dengan ❤️ oleh Bimo Aji Pamungkas  
GitHub: [@ombimo](https://github.com/ombimo)
