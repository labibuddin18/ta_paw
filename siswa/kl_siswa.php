<?php
    require_once 'cekLoginSiswa.php';
    require_once '../database.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['keluar'])){
            session_destroy();
            header("Location:../index.php");
            exit();
        }else{
            header("Location:profil_siswa.php");
            exit();
        }
    }
    require_once '../includes/header.php';
    require_once '../includes/navbarSiswa.php';
?>
<div class="kl_S">
    <div>
        <h2>Apakah Anda Yakin Mau Keluar Dari Akun Ini</h2>
        <div class="kl_gap">
            <form method="POST" >
                <button class="ya_kl_s" name="keluar">Ya Laogut</button>
                <button class="tdk_kl_s" name="tidak">Tidak</button>
            </form>
        </div>
    </div>
</div>