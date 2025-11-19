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
function siswa_daftar(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTAR_SISWA FROM pendaftaran");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}

function pendaftar(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.ID_PENDAFTAR_SISWA,A.NAMA_AKUN_SISWA,J.NAMA_JURUSAN,S.JENIS_STATUS_SISWA , GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
    FROM pendaftaran P
    JOIN akun_siswa A ON A.ID_AKUN_SISWA = P.ID_AKUN_SISWA
    JOIN status_siswa S ON S.ID_STATUS_SISWA = P.ID_STATUS_SISWA
    JOIN jurusan J ON J.ID_JURUSAN = P.ID_JURUSAN
    JOIN pendaftaran_kebutuhan PK ON PK.ID_PENDAFTAR_SISWA = P.ID_PENDAFTAR_SISWA
    JOIN kebutuhan_siswa K ON K.ID_KEBUTUHAN = PK.ID_KEBUTUHAN
    WHERE P.ID_STATUS_SISWA = 1
    GROUP BY P.ID_PENDAFTAR_SISWA");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function lulus(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.ID_PENDAFTAR_SISWA,A.NAMA_AKUN_SISWA,J.NAMA_JURUSAN,S.JENIS_STATUS_SISWA , GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
    FROM pendaftaran P
    JOIN akun_siswa A ON A.ID_AKUN_SISWA = P.ID_AKUN_SISWA
    JOIN status_siswa S ON S.ID_STATUS_SISWA = P.ID_STATUS_SISWA
    JOIN jurusan J ON J.ID_JURUSAN = P.ID_JURUSAN
    JOIN pendaftaran_kebutuhan PK ON PK.ID_PENDAFTAR_SISWA = P.ID_PENDAFTAR_SISWA
    JOIN kebutuhan_siswa K ON K.ID_KEBUTUHAN = PK.ID_KEBUTUHAN
    WHERE P.ID_STATUS_SISWA = 2
    GROUP BY P.ID_PENDAFTAR_SISWA");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function gagal(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.ID_PENDAFTAR_SISWA,A.NAMA_AKUN_SISWA,J.NAMA_JURUSAN,S.JENIS_STATUS_SISWA , GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
    FROM pendaftaran P
    JOIN akun_siswa A ON A.ID_AKUN_SISWA = P.ID_AKUN_SISWA
    JOIN status_siswa S ON S.ID_STATUS_SISWA = P.ID_STATUS_SISWA
    JOIN jurusan J ON J.ID_JURUSAN = P.ID_JURUSAN
    JOIN pendaftaran_kebutuhan PK ON PK.ID_PENDAFTAR_SISWA = P.ID_PENDAFTAR_SISWA
    JOIN kebutuhan_siswa K ON K.ID_KEBUTUHAN = PK.ID_KEBUTUHAN
    WHERE P.ID_STATUS_SISWA = 3
    GROUP BY P.ID_PENDAFTAR_SISWA");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function siswa_jurusan($jurusan){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTAR_SISWA 
    FROM pendaftaran P,jurusan J,status_siswa S
    WHERE P.ID_JURUSAN = J.ID_JURUSAN
    AND P.ID_STATUS_SISWA = S.ID_STATUS_SISWA 
    AND NAMA_JURUSAN=:NAMA_JURUSAN
    AND P.ID_STATUS_SISWA=2
    ");
    $stmnt->execute([
        ":NAMA_JURUSAN"=>$jurusan
    ]);
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function edit_kuota($id){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE jurusan SET KUOTA_JURUSAN = :KUOTA_JURUSAN WHERE ID_JURUSAN = :id");
    $stmnt->execute([
        ":KUOTA_JURUSAN"=>$_POST["KUOTA_JURUSAN"],
        ":id"=>$id
    ]);
    header("Location:jurusan.php");
}
function jurusan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM jurusan");
    $stmnt->execute();
    $jurusan=$stmnt->fetchAll();
    return $jurusan;
}
function kebutuhan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM kebutuhan_siswa");
    $stmnt->execute();
    $kebutuhan=$stmnt->fetchAll();
    return $kebutuhan;
}
function lastInsertId(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTAR_SISWA FROM pendaftaran ORDER BY ID_PENDAFTAR_SISWA DESC LIMIT 1");
    $stmnt->execute();
    $id=$stmnt->fetch();
    return $id;
}
// function register(array $data){

//     $stmnt=$pdo
// }