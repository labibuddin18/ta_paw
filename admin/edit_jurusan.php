<?php
require_once '../database.php';
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
    $id=$_GET["ID_JURUSAN"];
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        edit_kuota($id);
    }
?>
<div>
    <form action="" method="POST">
        <fieldset>
            <legend>Edit Jurusan</legend>
            <label for="">Kuota :</label>
            <input type="text" name="KUOTA_JURUSAN">
            <button type="submit">Submit</button>
        </fieldset>
    </form>
</div>