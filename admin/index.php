<?php
require_once 'cekLoginAdmin.php';
require_once '../database.php';
$lolos=lulus();
$gagal=gagal();
$pendaftar=siswa_daftar();
$jurusan=jurusan();
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
?>
<div class="container_admin">
    <h1>Informasi Siswa</h1>
    <div class="dashboard_admin">
        <div>
            <h3>Jumlah Pendaftar</h3><hr>
            <h4><?= count($pendaftar) ?></h4> <!-- menghitung jumlah pendaftar -->
        </div>    
        <div>
            <h3>Jumlah Diterima</h3><hr>
            <h4><?= count($lolos) ?></h4> <!-- menghitung jumlah diterima -->
        </div>
        <div>
            <h3>Jumlah Ditolak</h3><hr>
            <h4><?=count($gagal)?></h4> <!-- menghitung jumlah ditolak -->
        </div>
    </div>
    <h1>Jurusan</h1>
    <div class="admin_jurusan">
        <?php foreach($jurusan as $data): ?>
        <div>
            <h3><?=$data['NAMA_JURUSAN']?></h3><hr>

            <h4><?= count(siswa_jurusan($data['NAMA_JURUSAN'])) ?> Siswa</h4> <!-- menghitung jumlah siswa per jurusan yang diterima -->
        </div>
        <?php endforeach; ?>
    </div>
</div>
