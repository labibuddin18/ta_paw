<?php
session_start();
require_once 'validasi.php';
require_once 'database.php';
 // Wadah untuk menampung error
$pesan_sukses = ""; // Pesan jika berhasil

$nama = '';
$password = '';


if (isset($_POST['submit'])) {
    //Ambil semua data dari form
            $nama = $_POST['user'];
            $password = $_POST['pass'];
    $errors = [];
    $user= trim($_POST['user']);
    $pass=$_POST['pass'];


    if (empty($nama) ) {
        $errors['user'] = "Username harus diisi.";
    
    }if (empty($password)) {
        $errors['pass'] = "Password harus diisi.";

    }if (empty($errors)) {
         // Nama (Wajib, Alfabet)
            val_required($errors, 'user', $nama, 'Username wajib diisi.');
            val_alpha($errors, 'user', $nama, 'Username harus berupa huruf dan spasi.');
            

            //  Password (Wajib, Format/Panjang Minimal 8)
            val_required($errors, 'pass', $password, 'Password wajib diisi.');
            val_password_format($errors, 'pass', $password, 8, 'Password minimal 8 karakter.'); 


            if (empty($errors)) {
                $pesan_sukses = "SELAMAT! Semua data yang Anda masukkan VALID.";}
            

    $stmnt = $pdo->prepare
    ("SELECT * FROM 
        (SELECT 0 ket,a.NAMA_ADMIN username,a.PASSWORD_ADMIN password FROM `admin` AS a 
    UNION ALL
    SELECT 1 ket,cs.NAMA_AKUN_SISWA username,cs.PASSWORD_AKUN_SISWA password FROM `akun_siswa` AS cs ) AS combind 
    WHERE combind.username = :user AND combind.password = :pass LIMIT 1");
    $stmnt->execute([
        ':user'=>$_POST["user"],
        ':pass'=>md5($_POST["pass"])
    ]);
    $data=$stmnt->fetch();

    if ($stmnt->rowCount()>0) {
        $_SESSION['isUser']=true;
        if ($data["ket"]===0) {
            echo 'admin';
            header('Location: admin');
        }elseif($data["ket"]===1){
            echo 'calon siswa';
            header('Location: siswa');
        }


    }
}
}

 
 require_once 'includes/header.php';
 require_once 'includes/navbar.php';

?>


<div class="login">
	<form action="" method="POST">
			<h1>Login</h1>
            <table>
                <tr>
                    <td><label for="user">Username</label></td>
                </tr>
                <tr>    
                    <td><input type="text" id="user" name="user" placeholder="___________" value="<?php echo htmlspecialchars($nama); ?>">
                        <?php if (!empty($errors['user'])): ?>
                            <span class="error"><?php echo $errors['user']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="pass">Password</label></td>
                </tr>
                <tr>
                    <td><input type="password" id="pass" name="pass" placeholder="___________">
                        <?php if (!empty($errors['pass'])): ?>
                            <span class="error"><?php echo $errors['pass']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <button type="submit" name="submit">Login</button>
                    </th>
                </tr>
                <tr>
                    <td>
                        <p>Belum Punya Akun? <a href="register.php"> Register    </a></p>
                    </td>
                </tr>
            </table>
	</form>
</div>