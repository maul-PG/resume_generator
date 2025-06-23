<?php
// File: ai_helper.php

header('Content-Type: application/json');

try {
    // Memuat file konfigurasi yang berisi token rahasia
    require_once __DIR__ . '/config/api.php';

    // Ambil data dari request JavaScript
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        throw new Exception('Input dari form tidak valid.');
    }

    $nama = htmlspecialchars($input['nama'] ?? 'seseorang');
    $posisi = htmlspecialchars($input['posisi'] ?? 'profesional');
    $skills_string = implode(', ', ($input['skills'] ?? []));
    
    // Gunakan token dari konstanta yang sudah kita definisikan di config/api.php
    require_once __DIR__ . '/config/api.php';
    $hf_token = HF_API_TOKEN;

    if (empty($hf_token) || strpos($hf_token, 'hf_') !== 0) {
        throw new Exception('Token Hugging Face tidak valid atau belum diatur di config/api.php.');
    }

    $prompt = "Tugas Anda adalah membuat paragraf 'Tentang Saya' untuk CV berdasarkan data yang diberikan. JANGAN memberikan penjelasan, komentar, atau pengantar. LANGSUNG tuliskan hasil paragrafnya saja.### CONTOH INPUT:Nama: Budi SantosoMelamar sebagai: Social Media SpecialistKeahlian utama: Content Creation, SEO, Copywriting, Meta Ads### CONTOH OUTPUT:Seorang Social Media Specialist yang bersemangat dengan pengalaman dalam mengembangkan strategi konten yang menarik dan mengelola kampanye iklan di platform Meta. Terampil dalam SEO dan copywriting untuk meningkatkan jangkauan organik dan konversi. Mencari kesempatan untuk menerapkan keahlian dalam menciptakan pertumbuhan brand yang signifikan.---### DATA ANDA:Nama: $namaMelamar sebagai: $posisiKeahlian utama: $skills_string### PARAGRAF TENTANG SAYA ANDA:";

    $options = [ 'http' => [ 'method'  => 'POST', 'header'  => "Authorization: Bearer $hf_token\r\nContent-Type: application/json\r\n", 'content' => json_encode([ 'inputs' => $prompt, 'parameters' => [ 'max_new_tokens' => 150, 'temperature' => 0.7 ] ]), 'ignore_errors' => true ] ];
    $context = stream_context_create($options);
    $response = @file_get_contents("https://api-inference.huggingface.co/models/HuggingFaceH4/zephyr-7b-beta", false, $context);

    if ($response === false) {
        throw new Exception('Gagal terhubung ke API Hugging Face. Periksa koneksi internet Anda.');
    }

    $res = json_decode($response, true);

    if (isset($res[0]['generated_text'])) {
        $generated_text = $res[0]['generated_text'];
        $parts = explode("### PARAGRAF TENTANG SAYA ANDA:", $generated_text);
        $clean_text = trim(end($parts));
        echo json_encode(['success' => true, 'text' => $clean_text]);
    } elseif (isset($res['error'])) {
        throw new Exception('Error dari API Hugging Face: ' . $res['error']);
    } else {
        throw new Exception('Gagal memproses respons dari AI. Respons mentah: ' . json_encode($res));
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}