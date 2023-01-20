<?php
$conn = mysqli_connect("localhost", "root", "10", "projeck_uas");

function query($query)
{

    global $conn;
    $resault = mysqli_query($conn, $query);
    $rows  = [];
    while ($row = mysqli_fetch_assoc($resault)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_kegiatan($data)
{
    global $conn;
    $id_kegiatan = $data['id_kegiatan'];
    $nama_kegiatan = $data["nama_kegiatan"];
    $lokasi_kegiatan = $data["lokasi_kegiatan"];
    $tanggal_kegiatan = $data["tanggal_kegiatan"];


    $query = "INSERT INTO kegiatan
                VALUES
                ($id_kegiatan,'$nama_kegiatan','$lokasi_kegiatan','$tanggal_kegiatan')
                ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}


function hapus($id_kegiatan)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kegiatan 
    WHERE id_kegiatan= $id_kegiatan");

    return mysqli_affected_rows($conn);
}

function ubah_kegiatan($data)
{
    global $conn;
    $id_kegiatan = $data['id_kegiatan'];
    $nama_kegiatan = $data["nama_kegiatan"];
    $lokasi_kegiatan = $data["lokasi_kegiatan"];
    $tanggal_kegiatan = $data["tanggal_kegiatan"];


    $query = "UPDATE kegiatan SET
                
                nama_kegiatan ='$nama_kegiatan',
                lokasi_kegiatan ='$lokasi_kegiatan',
                tanggal_kegiatan ='$tanggal_kegiatan'
                WHERE id_kegiatan = '$id_kegiatan'
                ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}

//endfunction kegiatan

//function for tutor

function tutor($query)
{

    global $conn;
    $resault = mysqli_query($conn, $query);
    $rows  = [];
    while ($row = mysqli_fetch_assoc($resault)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_tutor($data)
{
    global $conn;
    $id_tutor = $data['id_tutor'];
    $nama_tutor = $data["nama_tutor"];
    $telpon = $data["telpon"];
    $email = $data["email"];



    $query = "INSERT INTO tutor
                VALUES
                ($id_tutor,'$nama_tutor','$telpon','$email')
                ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}


function hapus_tutor($id_tutor)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tutor
    WHERE id_tutor= $id_tutor");

    return mysqli_affected_rows($conn);
}

function ubah_tutor($data)
{
    global $conn;
    $id_tutor = $data['id_tutor'];
    $nama_tutor = $data["nama_tutor"];
    $telpon = $data["telpon"];
    $email = $data["email"];


    $query = "UPDATE tutor SET

                nama_tutor ='$nama_tutor',
                telpon ='$telpon',
                email ='$email'
                WHERE id_tutor = '$id_tutor'
                ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}






// //endfunction for tutor


///function daftar

function daftar($query_daftar)
{

    global $conn;
    $resault = mysqli_query($conn, $query_daftar);
    $rows  = [];
    while ($row = mysqli_fetch_assoc($resault)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_peserta($data)
{
    global $conn;
    $no_daftar = $data["no_daftar"];
    $nim = $data["nim"];
    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $telpon = $data["telpon"];
    $email = $data["email"];
    $tanggal_daftar = $data["tanggal_daftar"];


    $query = "INSERT INTO daftar 
        VALUES  
    ('$no_daftar','$nim','$nama','$alamat','$telpon','$email','$tanggal_daftar')
    ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}
function hapus_peserta($no_daftar)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM daftar
    WHERE no_daftar = '$no_daftar'");

    return mysqli_affected_rows($conn);
}

function ubah_peserta($data)
{

    global $conn;
    $no_daftar = $data["no_daftar"];
    $nim = $data["nim"];
    $nama = $data["nama"];
    $alamat = $data["alamat"];
    $telpon = $data["telpon"];
    $email = $data["email"];
    $tanggal_daftar = $data["tanggal_daftar"];


    $query = "UPDATE daftar SET

                nim ='$nim',
                nama ='$nama',
                alamat ='$alamat',
                telpon ='$telpon',
                email ='$email',
                tanggal_daftar ='$tanggal_daftar'
                WHERE no_daftar = '$no_daftar'
                ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}

//end daftar


// untuk login


function registrasi($data)
{
    global $conn;

    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    //cek konfirmasi password

    if ($password != $password2) {
        echo "
            <script>
            alert ('passwor tdk sesuai')
            </script>
        ";
        return false;
    }
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //TAMBAH USERBARU KE DATA BASE
    mysqli_query($conn, "INSERT INTO login VALUES('$username','$password')");


    return mysqli_affected_rows($conn);

    //
}


//end login

function trx_kegiatan($query_trx)
{

    global $conn;
    $resault = mysqli_query($conn, $query_trx);
    $rows  = [];
    while ($row = mysqli_fetch_assoc($resault)) {
        $rows[] = $row;
    }
    return $rows;
}

function addtrx($data)
{

    global $conn;




    $id_tutor = $data["id_tutor"];
    $no_daftar = $data["no_daftar"];
    $id_kegiatan = $data["id_kegiatan"];
    $username = $data["username"];
    $tanggal_kegiatan = $data["tgl_kegiatan"];

    $query = "INSERT INTO trx_kegiatan
          VALUES  
      ('0','$id_tutor','$no_daftar','$id_kegiatan','$username','$tanggal_kegiatan')
      ";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
}

function getTrx()
{
    global $conn;
    $sql = "SELECT trx_kegiatan.*, kegiatan.nama_kegiatan, tutor.nama_tutor,daftar.nama FROM trx_kegiatan INNER JOIN kegiatan ON trx_kegiatan.id_kegiatan = kegiatan.id_kegiatan INNER JOIN tutor ON trx_kegiatan.id_tutor = tutor.id_tutor
    INNER JOIN daftar ON trx_kegiatan.no_daftar = daftar.no_daftar";
    $data = mysqli_query($conn, $sql);
    return $data;
}
