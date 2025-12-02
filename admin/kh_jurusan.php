<?php
    require_once 'cekLoginAdmin.php';
    require_once '../database.php';
    $id_jurusan=$_GET['ID_JURUSAN'];
    
    $stmnt=$pdo->prepare("SELECT NAMA_JURUSAN FROM jurusan WHERE ID_JURUSAN = :ID_JURUSAN");
    $stmnt->execute([
      ':ID_JURUSAN'=>$id_jurusan
    ]);
    $jurusan=$stmnt->fetch();

    // pengecekan jika ada siswa yang terdaftar di jurusan maka tidak bisa di hapus jurusannya
    
    $stmnt2=$pdo->prepare("SELECT ID_PENDAFTARAN FROM pendaftaran WHERE ID_JURUSAN = :ID_JURUSAN");
    $stmnt2->execute([
      ':ID_JURUSAN'=>$id_jurusan
    ]);
    
    $jumlah=$stmnt2->rowCount();
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';?>
    <?php
    if ($jumlah > 0):
      ?>
<div class="kh_kebutuhan">
  <div>
      <h1>Ada Siswa Mendaftar Jurusan Ini ?</h1>
          <p>Mata Pelajaran <span><?= $jurusan["NAMA_JURUSAN"] ?></span></p>
          <div class="khk_gap">
            <a href="jurusan.php" class="khk_tidak">
              Kembali
            </a>
          </div>
  </div>
</div>

<?php else: ?>

<div class="kh_kebutuhan">
  <div>
      <h1>Apakah Anda Yakin Untuk Menghapus Jurusan Ini?</h1>
        <p>Mata Pelajaran <span><?= $jurusan["NAMA_JURUSAN"] ?></span></p>
          <div class="khk_gap">
            <a href="hapus_jurusan.php?ID_JURUSAN=<?=$id_jurusan?>" class="khk_hapus">
              Hapus
            </a>
            <a href="jurusan.php" class="khk_tidak">
              Tidak
            </a>
          </div>
  </div>
</div>
<?php endif ?>