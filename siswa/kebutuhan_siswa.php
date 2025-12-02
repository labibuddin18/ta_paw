<?php
    require_once 'cekLoginSiswa.php';
    require_once '../database.php';
    $kebutuhan=kebutuhan();
    require_once '../includes/header.php';
    require_once '../includes/navbarSiswa.php';
?>
<div class="kebutuhan_siswa">
    <div>
    <h1>Daftar Kebutuhan SMA Bakti Wiyata</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Kebutuhan</th>
        </tr>
        <?php $no=1; foreach($kebutuhan as $data):?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $data['NAMA_KEBUTUHAN']?></td>
        </tr>
        <?php $no+=1; endforeach; ?>
    </table>
    </div>
</div>