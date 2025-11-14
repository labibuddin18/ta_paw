<?php
$host='localhost';
$user='root';
$password='';
$db='ppdb';
try {
    $pdo=new PDO("mysql:host=$host;dbname=$db",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo 'Koneksi Berhasil';
} catch (PDOException $e) {
    echo 'koneksi gagal'.$e->getMessage();
};

function register(array $data){   
    global $pdo; 
    $stmnt=$pdo->prepare("INSERT INTO akun_siswa (`NAMA_AKUN_SISWA`,`PASSWORD_AKUN_SISWA`,`EMAIL_AKUN_SISWA`)VALUES (:NAMA_SISWA,:PASSWORD,:EMAIL)");
    $stmnt->execute([
        ':NAMA_SISWA'=>$data['nama'],
        ':PASSWORD'=>md5($data['pass']),
        ':EMAIL'=>$data['email']
    ]);
}
function login(array $data){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM 
    (");
    $stmnt->execute([
        ':user'=>$data['user'],
        ':pass'=>$data['pass']
    ]);
    $hasil=$stmnt->fetch(PDO::FETCH_ASSOC);
    if ($hasil) {
        if ($hasil['ket']==0) {
            return "0";
        }elseif ($hasil['ket']==1) {
            return "1";
        }
    }return FALSE;
}
function admin(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT akun_siswa.NAMA_AKUN_SISWA FROM pendaftaran,akun_siswa,status_siswa WHERE pendaftaran.ID_AKUN_SISWA=akun_siswa.ID_AKUN_SISWA AND pendaftaran.ID_STATUS_SISWA=status_siswa.ID_STATUS_SISWA ");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    if (isset($daftar)) {
        print_r($daftar);
    }
}
function status(array $data,$id){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE pendafaran SET status= :status WHERE ID_PENDAFTARAN = :ID");
    $stmnt->execute([
        ':status'=>$data['status'],
        ':ID'=>$id
    ]);
}
// function register(array $data){

//     $stmnt=$pdo
// }