> **Aplikasi CRUD Data Kontak Menggunakan PHP Native dan MySQL**

---

## 📘 **README.md**

````markdown
# 📇 Aplikasi CRUD Data Kontak Menggunakan PHP Native dan MySQL

Aplikasi ini merupakan proyek CRUD (Create, Read, Update, Delete) sederhana untuk mengelola data kontak menggunakan **PHP Native** dan **MySQL** dengan koneksi berbasis **PDO**.  
Dibuat untuk memenuhi tugas individu pemrograman web dasar serta melatih penerapan koneksi database, validasi input, dan sanitasi data.

---

## ⚙️ Fitur yang Tersedia
- ➕ **Create:** Tambah data kontak baru dengan validasi input.
- 📋 **Read:** Tampilkan seluruh data kontak dalam tabel yang terurut berdasarkan waktu input.
- 🔍 **Search:** Cari data berdasarkan nama atau email.
- 🧾 **Detail:** Lihat informasi lengkap tiap kontak.
- ✏️ **Update:** Edit data kontak dengan prefill form.
- ❌ **Delete:** Hapus data kontak dengan konfirmasi.
- 📄 **Pagination:** Menampilkan 5 data per halaman.
- 🧰 **Validasi & Sanitasi:** Melindungi dari SQL Injection dan XSS.
- ⚠️ **Pesan Error Informatif:** Menampilkan pesan aman tanpa stack trace.

---

## 🧱 Kebutuhan Sistem
| Komponen | Minimum |
|-----------|----------|
| PHP | 8.0+ |
| Database | MySQL / MariaDB |
| Server Lokal | Laragon, XAMPP, atau PHP built-in server |
| Browser | Chrome / Edge / Firefox (terbaru) |

---

## 🚀 Cara Instalasi dan Konfigurasi
1. **Clone atau download** project ini:
   ```bash
   git clone https://github.com/ghesyarhegyta/TUGAS_PEMWEB_CRUD
````

2. **Import database:**

   * Buka phpMyAdmin / MySQL Workbench
   * Jalankan SQL berikut:

     ```sql
     CREATE DATABASE crudsederhana;
     USE crudsederhana;
     CREATE TABLE IF NOT EXISTS contacts (
       id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(150) NOT NULL,
       email VARCHAR(200) NOT NULL,
       phone VARCHAR(40) DEFAULT NULL,
       notes TEXT DEFAULT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP NULL DEFAULT NULL
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
     ```
3. Tambahkan data contoh:

   ```sql
   INSERT INTO contacts (name, email, phone, notes) VALUES
   ('Ghesya Rhegyta', 'ghesyarhegyta@mail.com', '089637355972', 'Presiden'),
   ('Gadis Wulandari', 'naagadis@mail.com', '085822161864', 'Baddie imut'),
   ('Kim Jennie', 'jennie@mail.com', '089512345678', 'Kontak bisnis'),
   ('Meong', 'meong@mail.com', '082112345678', 'Customer loyal'),
   ('Brigita Natania', 'brigita@mail.com', '085245567254', 'Rekan proyek');
   ```
4. **Buka file `config.php`** dan sesuaikan koneksi:

   ```php
   define('DB_HOST', 'localhost');
   define('DB_PORT', '3306');
   define('DB_NAME', 'crudsederhana');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```
5. Jalankan server lokal:

   ```bash
   php -S localhost:8000
   ```
6. Buka di browser:

   ```
   http://localhost:8000
   ```

---

## 🗂️ Struktur Folder

```
crud_sederhana/
├── assets/               # Folder untuk file CSS, JS, atau gambar (termasuk screenshot)
├── config/               # Folder berisi file konfigurasi tambahan (opsional)
├── config.php            # File utama koneksi database menggunakan PDO
├── create.php            # Halaman untuk menambahkan data (Create)
├── delete.php            # Halaman untuk menghapus data (Delete)
├── edit.php              # Halaman untuk mengedit data (Update)
├── functions.php         # Berisi fungsi bantu seperti validasi, query helper, dll
├── header.php            # Template header halaman (bagian atas UI)
├── index.php             # Halaman utama aplikasi (Read + pagination + search)
├── view.php              # Halaman untuk menampilkan detail data (Read detail)
└── readme.md             # Dokumentasi proyek

```

---

## 🧾 Contoh Environment Config

Berikut contoh konfigurasi koneksi database pada file `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'crudsederhana');
define('DB_USER', 'root');
define('DB_PASS', '');
```

---

## 🖼️ Screenshot Aplikasi

![Tampilan Aplikasi](assets/screenshotweb.png)

---

## 👩‍💻 Dibuat Oleh

**Nama:** Ghesya Rhegyta Al Rachman
**NIM:** 2409106023
**Project:** Tugas Individu – CRUD Sederhana PHP Native


```

---

