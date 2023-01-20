<?php

session_start();
if (($_SESSION['login'] == false)) {
    header(("location: ../login/index_login.php"));
}
require '../config/koneksi.php';




//end code akhir


$daftar = daftar("SELECT * FROM daftar ");



//  untuk menghapus data
$no_daftar = $_POST['no_daftar'];
if (isset($_POST["hapus_peserta"])) {
    if (hapus_peserta($no_daftar) >= 0) {
        echo '
        <script>
            alert("data barhasil dihapus!");
            document.location.href ="index_daftar.php";
        </script>
    ';
    } else {
        echo '
    <script>
        alert("data gagal dihapus!");
        document.location.href ="index_daftar.php";
    </script>
';
    }
}
//untuk mengupdate atu merubah data
if (isset($_POST["update"])) {
    // var_dump($_POST);


    if (ubah_peserta($_POST) >= 0) {
        echo "
        <script>
            alert('data barhasil Di Ubah!');
            document.location.href ='index_daftar.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('data gagal Di Ubah!');
            document.location.href = 'index_daftar.php';
        </script>
    ";
    }
}

if (isset($_POST["tambah_daftar"])) {
    // var_dump($_POST);


    // $date = new DateTime('2016-02-13 07:44:00');
    // $date->add(new DateInterval('P7H6I'));
    // echo $date->format('Y-m-d H:i:s');

    // $data["tanggal_daftar"] = date("y-m-d H:i:s");

    if (tambah_peserta($_POST) >= 0) {
        echo "
        <script>
            alert('data barhasil ditambahkan!');
            document.location.href ='index_daftar.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!);
            document.location.href = index_daftar.php';
        </script>
    ";
    }
}
?>

<?php include('../template/header.php'); ?>
<h3 class="mb-4"><strong>PESERTA</strong></h3>

<!-- Button trigger modal -->
<div class="row">
    <div class="col text-right">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
            <i class="mdi mdi-database-plus" style="font-size: 1.5rem;"></i>
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th scope="col"><strong>NO DAFTAR</strong></th>
                <th scope="col"><strong>NIM</strong></th>
                <th scope="col"><strong>NAMA</strong></th>
                <th scope="col"><strong>ALAMAT</strong></th>
                <th scope="col"><strong>TELPON</strong></th>
                <th scope="col"><strong>EMIAL</strong></th>
                <th scope="col"><strong>TANGGAL DAFTAR</strong></th>
                <th scope="col"><strong>AKSI</strong></th>
            </tr>
        </thead>
        <?php $i = 1; ?>
        <?php foreach ($daftar as $row) : ?>
            <tbody class="text-center text-white">
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row["no_daftar"]; ?></td>
                    <td><?= $row["nim"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["alamat"]; ?></td>
                    <td><?= $row["telpon"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td><?= $row["tanggal_daftar"]; ?></td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update<?= $row['no_daftar']; ?>">
                            <i class="mdi mdi-grease-pencil" style="font-size: 1.5rem;"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $row['no_daftar']; ?>">
                            <i class="mdi mdi-delete-forever" style="font-size: 1.5rem;"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="" class="form-label">NO DAFTAR</label>
                            <input type="text" name="no_daftar" class="form-control">
                            <label for="" class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" required>
                            <label for="" class="form-label">NAMA</label>
                            <input type="text" name="nama" class="form-control" required>
                            <label for="" class="form-label">ALAMAT</label>
                            <input type="text" name="alamat" class="form-control" required>
                            <label for="" class="form-label">TELPON</label>
                            <input type="text" name="telpon" class="form-control" required>
                            <label for="" class="form-label">EMAIL</label>
                            <input type="text" name="email" class="form-control" required>
                            <label for="" class="form-label">TANGGAL DAFTAR</label>
                            <input type="date" name="tanggal_daftar" class="form-control" required>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="tambah_daftar">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Ubah-->
<?php foreach ($daftar as $row) : ?>
    <?php $dpr = query("SELECT * FROM daftar WHERE no_daftar = " . $row['no_daftar'])[0]; ?>
    <div class="modal fade" id="update<?= $row['no_daftar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col">
                                <label for="" class="form-label">NO DAFTAR</label>
                                <input type="text" name="no_daftar" class="form-control" value="<?= $dpr['no_daftar']; ?>">

                                <label for="" class="form-label">NIM</label>
                                <input type="text" name="nim" class="form-control" value="<?= $dpr["nim"]; ?>">

                                <label for="" class="form-label">NAMA</label>
                                <input type="text" name="nama" class="form-control" value="<?= $dpr["nama"]; ?>">

                                <label for="" class="form-label">ALAMAT</label>
                                <input type="text" name="alamat" class="form-control" value="<?= $dpr["alamat"]; ?>">

                                <label for="" class="form-label">TELPON</label>
                                <input type="text" name="telpon" class="form-control" value="<?= $dpr["telpon"]; ?>">

                                <label for="" class="form-label">EMAIL</label>
                                <input type="text" name="email" class="form-control" value="<?= $dpr["email"]; ?>">

                                <label for="" class="form-label">TANGGAL DAFTAR</label>
                                <input type="datetime" name="tanggal_daftar" class="form-control" value="<?= $dpr["tanggal_daftar"]; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="update">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- End Modal -->

<!-- Modal Hapus -->

<?php foreach ($daftar as $row) : ?>
    <div class="modal fade" id="hapus<?= $row['no_daftar']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center" style="font-size: 5rem;">
                            <i class="mdi mdi-exclamation text-warning"></i>
                            <p><strong>Apakah Anda Yakin Ingin Menghapus Data ??</strong></p>
                        </div>
                        <div class="col-12 text-center">
                            <form action="" method="post" class="forms-sample">
                                <input type="hidden" name="no_daftar" value="<?= $row['no_daftar']; ?>">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Canncel</button>
                                <button type="submit" class="btn btn-success" name="hapus_peserta">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Modal -->
<?php include('../template/footer.php'); ?>