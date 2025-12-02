<?php
    require_once 'cekLoginAdmin.php';
    require_once "../database.php";
    require_once "../validasi.php";
    
    $errors=[];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        // validasi nama kebutuhan
        val_required($errors,"nama_k",$_POST["nama_kebutuhan"],"Nama kebutuhan wajib diisi.");
        val_alphanumeric($errors,"nama_k",$_POST["nama_kebutuhan"],"Nama kebutuhan harus berupa huruf dan angka.");
        // jika tidak ada error, masukkan data ke database
        if(empty($errors)){
            $stmnt=$pdo->prepare("INSERT INTO kebutuhan (NAMA_KEBUTUHAN) VALUES (:NAMA_KEBUTUHAN)");
            $stmnt->execute([
                ":NAMA_KEBUTUHAN"=> $_POST["nama_kebutuhan"]
            ]);
            header("Location:kebutuhan.php");
        }
    }
    require_once "../includes/header.php";
    require_once "../includes/navbarAdmin.php";
?>
<div class="tambah_kebutuhan_container">
    <div>
        <form method="POST">
            <h2>Tambah Kebutuhan</h2>

            <div class="form-group">
                <label for="nama_kebutuhan">Nama Kebutuhan:</label>
                <input type="text" id="nama_kebutuhan" name="nama_kebutuhan" value="<?= htmlspecialchars($_POST["nama_kebutuhan"] ?? '') ?>"> 
                <span class='error'><?= $errors["nama_k"] ?? ""; ?></span>
            </div>
            
            <div class="form-actions">
                <button class="btn_kebutuhan btn-submit" type="submit">Tambah</button>
                <a class="btn_kebutuhan btn-back" href="kebutuhan.php">Kembali</a>
            </div>
        </form>
    </div>
</div>
