<?php
    require_once 'database.php';
    require_once 'includes/header.php';
    require_once 'includes/navbar.php';
?>
<div class="register">
    <form action="" method="POST">
            <h1>Register</h1>
            <table>
                <tr>
                    <td>
                        <label for="nama">Nama Lengkap</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="nama" name="nama">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="email" name="email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="pass">Password</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="pass" name="pass">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Sudah punya akun ? <a href="login.php">Login</a></p>
                    </td>
                </tr>
                <tr>
                    <th>
                    <button type="submit" name="submit">Submit</button> 
                    </th> 
                </tr>
            </table> 
    </form>
</div>
<?php
if(isset($_POST['submit'])){
    register($_POST);
    header("Location:login.php");
}