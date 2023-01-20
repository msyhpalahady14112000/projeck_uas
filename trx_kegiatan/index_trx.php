<?php
session_start();
if (($_SESSION['login'] == false)) {
    header(("location: ../login/index_login.php"));
}
require '../config/koneksi.php';
// var_dump($resault);
$trx = trx_kegiatan("SELECT * FROM trx_kegiatan ORDER BY id_trx DESC");
$kegiatan = query("SELECT * FROM kegiatan");
$daftar = query("SELECT * FROM daftar");
$tutor = query("SELECT * FROM tutor");

if (isset($_POST["tambah"])) {
    // var_dump($_POST);
    if (addtrx($_POST) >= 0) {
        echo "
        <script>
            alert('data barhasil ditambahkan!');
            document.location.href ='index_trx.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!);
            document.location.href = index_trx.php';
        </script>
    ";
    }
}
$data = getTrx();
?>

<?php include('../template/header.php'); ?>
<h3 class="mb-4"><strong>TRANSAKSI KEGIATAN</strong></h3>

<!-- Button trigger modal -->
<div class="row">
    <div class="col text-right">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">
            <i class="mdi mdi-database-plus" style="font-size: 1.5rem;"></i>
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th scope="col"><strong>ID TRX KEGIATAN</strong></th>

                <th scope="col"><strong>NAMA TUTOR</strong></th>

                <th scope="col"><strong>NAMA PESERTA</strong></th>
                <!-- <th scope="col"><strong>USERNAME</strong></th> -->
                <th scope="col"><strong>ID KEGIATAN</strong></th>
                <th scope="col"><strong>TANGGAL KEGIATAN</strong></th>
                <th scope="col"><strong>AKSI</strong></th>
            </tr>
        </thead>
        <?php $i = 1; ?>
        <?php foreach ($data as $row) : ?>
            <tbody class="text-center text-white">
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row["id_trx"]; ?></td>

                    <td><?= $row["nama_tutor"]; ?></td>
                    <td><?= $row["nama"]; ?></td>
                    <td><?= $row["id_kegiatan"]; ?></td>
                    <td><?= $row["tanggal_kegiatan"]; ?></td>
                    <td>
                        <button type="button" class="btn btn-info " data-toggle="modal" data-target=#detail<?= $row['id_trx']; ?>></button>
                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <select class="form-control" name="id_tutor">
                                <option selected disabled hidden>-- Pilih tutor --</option>

                                <?php foreach ($tutor as $tut) : ?>
                                    <option value="<?= $tut['id_tutor']; ?>"><?= $tut['nama_tutor']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="no_daftar">
                                <option selected disabled hidden>-- Pilih no daftar --</option>
                                <?php foreach ($daftar as $daf) : ?>
                                    <option value="<?= $daf['no_daftar']; ?>"><?= $daf['no_daftar']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <input type="hidden" value="<?= $_SESSION['username']; ?>" name="username">
                            <input type="date" name="tgl_kegiatan" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-center">
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Lokasi Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <?php $i = 1; ?>
                                <tbody class="text-center text-white">
                                    <?php foreach ($kegiatan as $keg) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $keg['nama_kegiatan']; ?></td>
                                            <td><?= $keg['lokasi_kegiatan']; ?></td>
                                            <td>
                                                <input class="form-check-input" type="radio" name="id_kegiatan" value="<?= $keg['id_kegiatan']; ?>">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include('../template/footer.php'); ?>