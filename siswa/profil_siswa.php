<?php
session_start();

// Pastikan yang login adalah siswa
if (!isset($_SESSION['login']) || empty($_SESSION['isSiswa'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil ID siswa dari session (di-set di login.php sebagai ID_USER)
if (!isset($_SESSION['ID_USER'])) {
    echo "<p>Session ID siswa tidak ditemukan. Silakan login ulang.</p>";
    exit();
}

$idSiswa = $_SESSION['ID_USER'];

require_once "../database.php";
require_once "../includes/header.php";      // kalau header.php sudah include <html> dll, biarkan
require_once "../includes/navbarSiswa.php"; // navbar siswa (kalau ada)

// Ambil data siswa dari database
try {
    $stmt = $pdo->prepare("SELECT * FROM siswa WHERE ID_SISWA = :id LIMIT 1");
    $stmt->execute([':id' => $idSiswa]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Terjadi kesalahan saat mengambil data siswa: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

// Kalau data tidak ditemukan
if (!$user) {
    echo "<p>Data siswa tidak ditemukan di database.</p>";
    exit();
}
$nama  = htmlspecialchars($user['USERNAME_SISWA'] ?? '-');
$email = htmlspecialchars($user['EMAIL'] ?? '-');
$foto  = $user['FOTO'] ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profil - <?php echo $nama; ?></title>

    <!-- CSS khusus profil siswa -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="profile-wrapper">
    <div class="profile-card">

        <div class="avatar-wrap">
            <?php if ($foto && file_exists("uploads/$foto")): ?>
                <img src="uploads/<?php echo htmlspecialchars($foto); ?>" class="avatar">
            <?php else: ?>
                <div class="avatar-placeholder">
                    <?php echo strtoupper(substr($nama, 0, 1)); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Username -->
        <div class="profile-label">Username</div>
        <div class="profile-field"><?php echo $nama; ?></div>

        <!-- Email -->
        <div class="profile-label">Email</div>
        <div class="profile-field"><?php echo $email; ?></div>

        <!-- Password -->
        <div class="profile-label">Password (terenkripsi)</div>
        <div class="profile-field">******</div>

        <!-- Tombol -->
        <div class="profile-actions">
            <a href="edit_siswa.php" class="btn-link">Edit Profil</a>
            <a href="../logout.php" class="btn-link btn-danger">Logout</a>
        </div>

    </div>
</div>
<?php
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";
?>
