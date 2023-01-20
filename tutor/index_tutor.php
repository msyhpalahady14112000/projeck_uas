<?php

session_start();
if (($_SESSION['login'] == false)) {
    header(("location: ../login/index_login.php"));
}

require '../config/koneksi.php';

$tutor = tutor("SELECT * FROM tutor ORDER BY id_tutor DESC");

$id_tutor = $_POST['id_tutor'];
if (isset($_POST["hapus"])) {
    if (hapus_tutor($id_tutor) >= 0) {
        echo '
        <script>
            alert("data barhasil dihapus!");
            document.location.href ="index_tutor.php";
        </script>
    ';
    } else {
        echo '
    <script>
        alert("data gagal dihapus!");
        document.location.href ="index_tutor.php";
    </script>
';
    }
}

if (isset($_POST["update"])) {
    var_dump($_POST);

    if (ubah_tutor($_POST) >= 0) {
        echo "
        <script>
            alert('data barhasil diubah!');
            document.location.href ='index_tutor.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!);
            document.location.href = index_tutor.php';
        </script>
    ";
    }
}


if (isset($_POST["tambah"])) {
    // var_dump($_POST);

    if (tambah_tutor($_POST) >= 0) {
        echo "
        <script>
            alert('data barhasil ditambahkan!');
            document.location.href ='index_tutor.php';
        </script>
    ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!);
            document.location.href = index_tutor.php';
        </script>
    ";
    }
}

?>

<?php include('../template/header.php'); ?>
<h3 class="mb-4"><strong>Data TUTOR</strong></h3>

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
                <th scope="col"><strong>ID TUTOR</strong></th>
                <th scope="col"><strong>NAMA TUTOR</strong></th>
                <th scope="col"><strong>TELPON</strong></th>
                <th scope="col"><strong>EMAIL</strong></th>
                <th scope="col"><strong>Aksi</strong></th>
            </tr>
        </thead>
        <?php $i = 1; ?>
        <?php foreach ($tutor as $row) : ?>
            <tbody class="text-center text-white">
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row["id_tutor"]; ?></td>
                    <td><?= $row["nama_tutor"]; ?></td>
                    <td><?= $row["telpon"]; ?></td>
                    <td><?= $row["email"]; ?></td>
                    <td>
                        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#update<?= $row['id_tutor']; ?>">
                            <i class="mdi mdi-grease-pencil" style="font-size: 1.5rem;"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $row['id_tutor']; ?>">
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
                            <label for="" class="form-label">ID TUTOR</label>
                            <input type="text" name="id_tutor" class="form-control" required>

                            <label for="" class="form-label">NAMA TUTOR</label>
                            <input type="text" name="nama_tutor" class="form-control" required>

                            <label for="" class="form-label">TELPON</label>
                            <input type="text" name="telpon" class="form-control" required>

                            <label for="" class="form-label">EMAIL</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Modal Ubah-->
<?php foreach ($tutor as $row) : ?>
    <?php $ttr = query("SELECT * FROM tutor WHERE id_tutor = " . $row['id_tutor'])[0]; ?>
    <div class="modal fade" id="update<?= $row['id_tutor']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="" class="form-label">ID TUTOR</label>
                                <input type="text" name="id_tutor" class="form-control" value="<?= $ttr['id_tutor']; ?>">

                                <label for="" class="form-label">NAMA TUTOR</label>
                                <input type="text" name="nama_tutor" class="form-control" value="<?= $ttr["nama_tutor"]; ?>">

                                <label for="" class="form-label">TELPON</label>
                                <input type="text" name="telpon" class="form-control" value="<?= $ttr["telpon"]; ?>">

                                <label for="" class="form-label">EMIAL</label>
                                <input type="text" name="email" class="form-control" value="<?= $ttr["email"]; ?>">
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

<?php foreach ($tutor as $row) : ?>
    <div class="modal fade" id="hapus<?= $row['id_tutor']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <input type="hidden" name="id_tutor" value="<?= $row['id_tutor']; ?>">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Canncel</button>
                                <button type="submit" class="btn btn-success" name="hapus">Delete</button>
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