<?php
// File: generate.php (Controller)

function sanitize($data) {
    return is_array($data) ? array_map('sanitize', $data) : htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// PEMROSESAN DATA FORM
$nama = sanitize($_POST['nama'] ?? 'Nama Lengkap');
$posisi = sanitize($_POST['posisi'] ?? 'Posisi yang Dilamar');
$ttl = sanitize($_POST['ttl'] ?? '');
$jk = sanitize($_POST['jk'] ?? '');
$alamat = sanitize($_POST['alamat'] ?? '');
$telepon = sanitize($_POST['telepon'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$linkedin = sanitize($_POST['linkedin'] ?? '');
$hobi = sanitize($_POST['hobi'] ?? []);
$tentang = nl2br(sanitize($_POST['tentang'] ?? ''));
$pendidikan = sanitize($_POST['pendidikan'] ?? []);
$pengalaman = sanitize($_POST['pengalaman'] ?? []);
$referensi = sanitize($_POST['referensi'] ?? []);
$skills_input = $_POST['skills'] ?? '';
$skills = is_string($skills_input) ? array_map('trim', explode(',', $skills_input)) : sanitize($skills_input);
$tema_warna = sanitize($_POST['tema_warna'] ?? '#2563eb');
$font_cv = sanitize($_POST['font_cv'] ?? "'Poppins', sans-serif");

// LOGIKA UPLOAD FOTO
$foto_path = 'assets/img/avatar.png';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0755, true); }
    $file_extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $unique_name = 'foto_' . uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $unique_name;
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto_path = $target_file;
    }
}

// Panggil file template untuk menampilkannya.
include 'template-cv.php';