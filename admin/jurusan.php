<?php
    require_once '../database.php';
    // if (isset($_POST['submit'])) {
        $stmnt=$pdo->prepare("SELECT * FROM jurusan");
        $stmnt->execute();
        $jurusan=$stmnt->fetchAll();
    // }
    
    if(isset($_GET["edit"])){
        $stmnt=$pdo->prepare("INSERT INTO jenjang (NAMA_JENJANG) VALUES (:NAMA_JENJANG)");
        $stmnt->bindValue(':NAMA_JENJANG',$data['jenjang']);
        $stmnt->execute();
    }
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
?>
<div class="jurusan">
    <h1>Daftar Jurusan</h1>
    <table>
        <tr>
            <th>Nama Jurusan</th>
            <th>Kouta</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($jurusan as $data):?>
        <tr>
            <td><?php echo $data['NAMA_JURUSAN']?></td>
            <td><?php echo $data['KUOTA_JURUSAN']?></td>
            <td>
                <button name="edit"><a href="edit_jurusan.php?ID_JURUSAN=<?=$data['ID_JURUSAN']?>">edit</a></button>
                <button name="hapus"><a href="hapus_jurusan.php?ID_JURUSAN=<?=$data['ID_JURUSAN']?>">hapus</a></button></button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <button>tambah jurusan</button>
</div>