<?php

$errors=[];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    // validasi nama jurusan
    $nama_jurusan = $_POST["nama_jurusan"];
    val_required($errors,"nama_j",$nama_jurusan,"Nama jurusan wajib diisi.");
    val_alphanumeric($errors,"nama_j",$nama_jurusan,"Nama jurusan harus berupa huruf dan angka.");
    // validasi kouta
    $kuota = $_POST["kuota"];
    val_required($errors,"kuota",$kuota,"Kuota wajib diisi.");
    val_numeric($errors,"kuota",$kuota,"Kuota harus berupa angka.");
    // jika tidak ada error, masukkan data ke database
    if(empty($errors)){
        $stmnt=$pdo->prepare("INSERT INTO jurusan (NAMA_JURUSAN,KUOTA_JURUSAN) VALUES (:NAMA_JURUSAN,:KUOTA_JURUSAN)");
        $stmnt->execute([
            ":NAMA_JURUSAN"=> $_POST["nama_jurusan"],
            ":KUOTA_JURUSAN"=> $_POST['kuota']
        ]);
        header("Location:jurusan.php");
    }
}
// Mengecek apakah admin sudah login
require_once 'cekLoginAdmin.php';
// Koneksi ke databse dan fungsi Validasi
require_once '../database.php';
require_once "../validasi.php";

// Header dan navbar admin
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';

?>
<div class="tambah_jurusan">
    <div>
        <form method="POST">
            <h2>Tambah jurusan</h2>
            
            <div class="form_group">
                <label for="nama_jurusan">Nama Jurusan:</label>
                <input type="text" id="nama_jurusan" name="nama_jurusan" value="<?= htmlspecialchars($nama_jurusan ?? '') ?>">
                <span class='error'><?= $errors['nama_j'] ?? "" ?></span>
            </div>
            
            <div class="form_group">
                <label for="kuota">Kouta :</label>
                <input type="text" id="kuota" name="kuota" value="<?= htmlspecialchars($kuota ?? '') ?>">
                <span class='error'><?= $errors['kuota'] ?? "" ?></span>
            </div>
            
            <div class="form-actions">
                <button class="btn_jumlah btn-submit" type="submit">Tambah</button>
                <a class="btn_jumlah btn-back" href="jurusan.php">Kembali</a>
            </div>
        </form>
    </div>
</div>
