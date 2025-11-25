<?php
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarSiswa.php';
    $jurusan=jurusan();
?>
<div class="jurusan_siswa">
    <h1>Daftar Jurusan SMA Bakti Wiyata</h1>
    <table>
        <tr>
            <th>Nomor</th>
            <th>Nama Jurusan</th>
            <th>Kouta</th>
        </tr>
        <?php foreach($jurusan as $data):?>
        <tr>
            <td><?= $data['ID_JURUSAN'] ?></td>
            <td><?= $data['NAMA_JURUSAN'] ?></td>
            <td><?= $data['KUOTA_JURUSAN'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>