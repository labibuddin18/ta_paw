<?php
session_start();
if (!isset($_SESSION['isSiswa']) || $_SESSION['isSiswa'] != true) {
    require_once '../cekLogin.inc';
    exit();
}
if (!isset($_SESSION['ID_USER'])) exit();

$idSiswa = $_SESSION['ID_USER'];
require_once "../database.php";
?>

<div class="top-sticky">
    <?php require_once "../includes/header.php"; ?>
    <?php require_once "../includes/navbarSiswa.php"; ?>
</div>

<?php
$stmt = $pdo->prepare("
    SELECT p.*, j.NAMA_JURUSAN
    FROM pendaftaran p
    LEFT JOIN jurusan j ON j.ID_JURUSAN = p.ID_JURUSAN
    WHERE p.ID_SISWA = :id
    ORDER BY p.ID_PENDAFTARAN DESC
");
$stmt->execute([':id' => $idSiswa]);
$list = $stmt->fetchAll(PDO::FETCH_ASSOC);

function e($v){ return htmlspecialchars($v ?? '-', ENT_QUOTES, 'UTF-8'); }

if (!$list) {
?>
<div class="profile-card">
    <h2>Riwayat Pendaftaran</h2>
    <p style="text-align:center;margin-top:10px;">Belum ada data pendaftaran.</p>
    <div class="profile-actions" style="margin-top:20px;">
        <a href="pendaftaran.php" class="btn-link">Daftar</a>
        <a href="profil_siswa.php" class="btn-link btn-danger">Kembali</a>
    </div>
</div>
<?php
require_once "../includes/footer.php";
exit();
}
?>

<?php foreach ($list as $r): ?>
<div class="profile-card">
    <h2>Riwayat Pendaftaran</h2>
    <p style="margin-bottom:20px;color:#555;">
        ID: <?= e($r['ID_PENDAFTARAN']) ?> | <?= e($r['TANGGAL_PENDAFTARAN']) ?>
    </p>

    <div class="profile-label">Nama Lengkap</div>
    <div class="profile-field"><?= e($r['NAMA_LENGKAP']) ?></div>

    <div class="profile-label">Jenis Kelamin</div>
    <div class="profile-field"><?= e($r['GENDER']) ?></div>

    <div class="profile-label">Tempat, Tanggal Lahir</div>
    <div class="profile-field"><?= e($r['TEMPAT_LAHIR']) ?>, <?= e($r['TANGGAL_LAHIR']) ?></div>

    <div class="profile-label">Agama</div>
    <div class="profile-field"><?= e($r['AGAMA']) ?></div>

    <div class="profile-label">Alamat Siswa</div>
    <div class="profile-field"><?= e($r['ALAMAT_SISWA']) ?></div>

    <div class="profile-label">No HP Siswa</div>
    <div class="profile-field"><?= e($r['NO_HP_SISWA']) ?></div>

    <div class="profile-label">Jurusan</div>
    <div class="profile-field"><?= e($r['NAMA_JURUSAN']) ?></div>

    <h3 style="margin-top:30px;margin-bottom:10px;">Dokumen</h3>

    <div class="profile-label">Kartu Keluarga</div>
    <div class="profile-field"><?= e($r['KARTU_KELUARGA']) ?></div>

    <div class="profile-label">Akta Kelahiran</div>
    <div class="profile-field"><?= e($r['AKTA_KELAHIRAN']) ?></div>

    <div class="profile-label">Ijazah</div>
    <div class="profile-field"><?= e($r['IJAZAH']) ?></div>

    <h3 style="margin-top:30px;margin-bottom:10px;">Data Ayah</h3>

    <div class="profile-label">Nama Ayah</div>
    <div class="profile-field"><?= e($r['NAMA_AYAH']) ?></div>

    <div class="profile-label">Keadaan Ayah</div>
    <div class="profile-field"><?= e($r['KEADAAN_AYAH']) ?></div>

    <div class="profile-label">Alamat Ayah</div>
    <div class="profile-field"><?= e($r['ALAMAT_AYAH']) ?></div>

    <div class="profile-label">No HP Ayah</div>
    <div class="profile-field"><?= e($r['NO_HP_AYAH']) ?></div>

    <div class="profile-label">Pekerjaan Ayah</div>
    <div class="profile-field"><?= e($r['PEKERJAAN_AYAH']) ?></div>

    <div class="profile-label">Gaji Ayah</div>
    <div class="profile-field"><?= e($r['GAJI_AYAH']) ?></div>

    <h3 style="margin-top:30px;margin-bottom:10px;">Data Ibu</h3>

    <div class="profile-label">Nama Ibu</div>
    <div class="profile-field"><?= e($r['NAMA_IBU']) ?></div>

    <div class="profile-label">Keadaan Ibu</div>
    <div class="profile-field"><?= e($r['KEADAAN_IBU']) ?></div>

    <div class="profile-label">Alamat Ibu</div>
    <div class="profile-field"><?= e($r['ALAMAT_IBU']) ?></div>

    <div class="profile-label">No HP Ibu</div>
    <div class="profile-field"><?= e($r['NO_HP_IBU']) ?></div>

    <div class="profile-label">Pekerjaan Ibu</div>
    <div class="profile-field"><?= e($r['PEKERJAAN_IBU']) ?></div>

    <div class="profile-label">Gaji Ibu</div>
    <div class="profile-field"><?= e($r['GAJI_IBU']) ?></div>

    <div class="profile-actions" style="margin-top:30px;">
        <a href="../pendaftaran.php" class="btn-link">Edit</a>
        <a href="profil_siswa.php" class="btn-link btn-danger">Kembali</a>
    </div>
</div>
<?php endforeach; ?>

<?php require_once "../includes/footer.php"; ?>
