<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Profesional - <?= $nama ?></title>
    <link rel="stylesheet" href="assets/css/resume.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>:root { --theme-color: <?= $tema_warna ?>; --font-family: <?= $font_cv ?>; }</style>
</head>
<body>
    <button id="downloadPDF" class="fab-download-btn" title="Download sebagai PDF" data-filename="CV_<?= preg_replace('/[^a-zA-Z0-9]/', '_', $nama) ?>">
        <i class="fas fa-download"></i>
    </button>
    <div id="cv" class="resume-container">
        <aside class="resume-sidebar">
            <div class="profile-section">
                <img src="<?= $foto_path ?>" alt="Foto Profil <?= $nama ?>" class="profile-pic">
                <h2 class="profile-name"><?= $nama ?></h2>
                <p class="profile-title"><?= $posisi ?></p>
            </div>
            <section class="sidebar-section">
                <h3><i class="fas fa-user-circle fa-fw"></i> Kontak</h3>
                <div class="contact-grid">
                    <i class="fas fa-phone fa-fw"></i> <span><?= $telepon ?></span>
                    <i class="fas fa-envelope fa-fw"></i> <span><?= $email ?></span>
                    <i class="fas fa-map-marker-alt fa-fw"></i> <span><?= $alamat ?></span>
                    <i class="fas fa-birthday-cake fa-fw"></i> <span><?= $ttl ?></span>
                    <i class="fas fa-venus-mars fa-fw"></i> <span><?= $jk ?></span>
                    <?php if (!empty($linkedin)): ?>
                        <i class="fab fa-linkedin fa-fw"></i> <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank"><?= htmlspecialchars(basename($linkedin)) ?></a>
                    <?php endif; ?>
                </div>
            </section>
            <section class="sidebar-section">
                <h3><i class="fas fa-cogs fa-fw"></i> Keahlian</h3>
                <div class="skills-pills">
                    <?php foreach ($skills as $skill): ?>
                        <span><?= $skill ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php if (!empty($hobi)): ?>
            <section class="sidebar-section">
                <h3><i class="fas fa-heart fa-fw"></i> Hobi</h3>
                <p class="hobbies-item"><?= implode(', ', $hobi) ?></p>
            </section>
            <?php endif; ?>
        </aside>
        <main class="resume-main">
            <section class="main-section">
                <h2><i class="fas fa-info-circle"></i> Tentang Saya</h2>
                <p><?= $tentang ?></p>
            </section>
            <section class="main-section">
                <h2><i class="fas fa-briefcase"></i> Pengalaman Kerja</h2>
                <div class="timeline">
                    <?php foreach ($pengalaman as $job): ?>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h4><?= $job['posisi'] ?? '' ?></h4>
                            <p class="timeline-subtitle"><strong><?= $job['perusahaan'] ?? '' ?></strong> | <?= $job['tahun'] ?? '' ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <section class="main-section">
                <h2><i class="fas fa-graduation-cap"></i> Pendidikan</h2>
                <div class="timeline">
                     <?php foreach ($pendidikan as $edu): ?>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h4><?= $edu['institusi'] ?? '' ?></h4>
                            <p class="timeline-subtitle"><strong><?= $edu['gelar'] ?? '' ?></strong> | <?= $edu['tahun'] ?? '' ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php if (!empty($referensi)): ?>
            <section class="main-section">
                <h2><i class="fas fa-address-card"></i> Referensi</h2>
                <?php foreach ($referensi as $ref): ?>
                    <p><strong><?= $ref['nama'] ?></strong> (<?= $ref['relasi'] ?>) - <?= $ref['kontak'] ?></p>
                <?php endforeach; ?>
            </section>
            <?php endif; ?>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="assets/js/generate.js"></script>
</body>
</html>