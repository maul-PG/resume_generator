# Resume Generator - Buat CV Profesional dengan Mudah

Selamat datang di **AI Resume Generator**, sebuah aplikasi web interaktif yang dirancang untuk membantu Anda membuat CV profesional dan menarik tanpa ribet. Dengan antarmuka yang intuitif dan bantuan AI, Anda bisa merancang CV impian dalam hitungan menit dan mengunduhnya dalam format PDF yang siap pakai.


![Make easy CV](https://github.com/user-attachments/assets/517d43c3-74e8-44b6-9610-d3389af3ae4e)

---

## ✨ Fitur Utama

-   **Formulir Dinamis:** Isi data pribadi, riwayat pendidikan, dan pengalaman kerja dengan mudah. Tambah atau hapus entri sesuai kebutuhan.
-   **Kustomisasi Tampilan:** Personalisasi CV Anda dengan memilih warna tema dan jenis font yang sesuai dengan gaya Anda.
-   **Bantuan AI Cerdas:** Bingung merangkai kata untuk deskripsi diri? Manfaatkan integrasi AI untuk membuat paragraf "Tentang Saya" yang profesional dan persuasif.
-   **Upload Foto Profil:** Unggah foto terbaik Anda untuk memberikan sentuhan personal pada CV.
-   **Download PDF Siap Kirim:** Unduh hasil akhir CV Anda dalam format PDF ukuran A4 berkualitas tinggi, siap untuk dilampirkan pada lamaran kerja.

---

## 🚀 Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi web standar yang ringan dan andal.

-   **Backend:** **PHP** (Dirancang untuk berjalan pada versi 8.0+)
-   **Frontend:** HTML5, CSS3, dan JavaScript (ES6)
-   **Library & API:**
    -   Font Awesome untuk ikon
    -   Google Fonts untuk tipografi
    -   HuggingFace API untuk fitur generasi teks AI
    -   html2pdf.js untuk fungsionalitas ekspor ke PDF

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/HuggingFace-F9900F?style=for-the-badge&logo=huggingface&logoColor=white" alt="HuggingFace" />
</p>

---

## ⚙️ Cara Instalasi dan Menjalankan Proyek (Lokal)

Untuk menjalankan proyek ini di komputer Anda sendiri, ikuti langkah-langkah berikut:

#### **1. Prasyarat (Yang Harus Anda Punya)**
-   **Web Server Lokal:** Pastikan Anda sudah menginstall **XAMPP**, WAMP, atau Laragon yang menyertakan **PHP versi 8.0 atau lebih baru**.
-   **Git:** Terinstall di komputer Anda untuk mengambil file dari repositori.
-   **Web Browser:** Chrome, Firefox, atau browser modern lainnya.

#### **2. Langkah-langkah Instalasi**

**a. Clone Repositori Ini**
   - Buka terminal atau Command Prompt.
   - Arahkan ke direktori tempat Anda ingin menyimpan proyek, lalu jalankan perintah:
     ```bash
     git clone [https://github.com/maul-PG/resume-generator.git](https://github.com/maul-PG/resume-generator.git)
     ```
     *(Catatan: Pastikan nama repositori Anda adalah `resume-generator`. Jika berbeda, silakan sesuaikan link di atas).*

**b. Pindahkan Proyek ke Folder Web Server**
   - Pindahkan folder proyek yang baru saja di-clone (`resume-generator`) ke dalam folder root web server Anda.
   - Contoh untuk XAMPP: Pindahkan folder ke `C:\xampp\htdocs\`

**c. Konfigurasi API Key (Langkah Penting!)**
   - Proyek ini membutuhkan API key dari HuggingFace agar fitur AI bisa berjalan.
   - Di dalam folder proyek, navigasi ke direktori `config/`.
   - Salin file `api.example.php` dan ubah namanya menjadi `api.php`.
   - Buka file `api.php` yang baru, lalu masukkan API Key Anda.
     ```php
     // File: config/api.php
     define('HF_API_TOKEN', 'hf_...MASUKKAN_TOKEN_ASLI_ANDA_DI_SINI');
     ```

**d. Atur Izin Folder**
   - Folder `uploads/` digunakan untuk menyimpan foto profil yang diunggah. Pastikan folder ini bisa "ditulisi" oleh server.
   - Jika Anda mengalami error saat upload foto, klik kanan pada folder `uploads`, pilih "Properties" > "Security", dan berikan izin "Write" untuk user yang relevan.

**e. Jalankan Aplikasi**
   - Buka XAMPP Control Panel dan pastikan service **Apache** sudah berjalan (berwarna hijau).
   - Buka browser Anda dan akses alamat:
     ```
     http://localhost/resume-generator/
     ```

Sekarang Anda sudah bisa menggunakan aplikasi ini secara lokal!

---

## 📖 Cara Penggunaan Aplikasi

1.  **Isi Formulir:** Lengkapi semua data yang diminta, mulai dari data pribadi hingga referensi.
2.  **Manfaatkan Fitur:** Gunakan tombol "Tambah" untuk menambahkan riwayat pendidikan/pengalaman, dan coba fitur AI untuk deskripsi diri.
3.  **Kustomisasi:** Pilih warna tema dan font yang paling Anda sukai di bagian bawah formulir.
4.  **Buat & Lihat Hasil:** Klik tombol **"Buat CV Sekarang"**. Anda akan diarahkan ke halaman CV yang sudah jadi.
5.  **Unduh PDF:** Jika sudah puas dengan hasilnya, klik tombol download yang melayang di pojok kanan bawah untuk menyimpan CV Anda dalam format PDF.

---

## ⚖️ Lisensi

Proyek ini bersifat **open source** di bawah Lisensi MIT. Bebas untuk digunakan, dimodifikasi, dan didistribusikan.

## 👨‍💻 Kontribusi

Merasa ada yang bisa ditingkatkan? Silakan buat *Pull Request* atau buka *Issue* di [repositori GitHub ini](https://github.com/maul-PG/resume-generator). Semua kontribusi sangat diterima!

Dibuat dengan ❤️ oleh [**Rafi'i Maulana**](https://github.com/maul-PG).
