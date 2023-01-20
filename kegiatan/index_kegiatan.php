 <?php

    session_start();
    if (($_SESSION['login'] == false)) {
        header(("location: ../login/index_login.php"));
    }
    require '../config/koneksi.php';
    // $getKode = mysqli_query($conn, "SELECT max(id_kegiatan)  from kegiatan");
    // $rs = mysqli_fetch_array($getKode);
    // $hasil = $rs['kode'];
    // $noUrut = (int) substr($hasil, 3, 3);
    // $noUrut++;
    // $hurup = 'DFT';
    // $id_kegiatan = $hurup . sprintf("%03s", $noUrut);

    $kegiatan = query("SELECT * FROM kegiatan ORDER BY id_kegiatan DESC");

    $id_kegiatan = $_POST['id_kegiatan'];
    if (isset($_POST["hapus"])) {
        if (hapus($id_kegiatan) >= 0) {
            echo '
        <script>
            alert("data barhasil dihapus!");
            document.location.href ="index_kegiatan.php";
        </script>
    ';
        } else {
            echo '
    <script>
        alert("data gagal dihapus!");
        document.location.href ="index_kegiatan.php";
    </script>
';
        }
    }

    if (isset($_POST["update"])) {
        // var_dump($_POST);

        if (ubah_kegiatan($_POST) >= 0) {
            echo "
        <script>
            alert('data barhasil diubah!');
            document.location.href ='index_kegiatan.php';
        </script>
    ";
        } else {
            echo "
        <script>
            alert('data gagal diubah!);
            document.location.href = index_kegiatan.php';
        </script>
    ";
        }
    }


    if (isset($_POST["tambah"])) {
        // var_dump($_POST);

        if (tambah_kegiatan($_POST) >= 0) {
            echo "
        <script>
            alert('data barhasil ditambahkan!');
            document.location.href ='index_kegiatan.php';
        </script>
    ";
        } else {
            echo "
        <script>
            alert('data gagal ditambahkan!);
            document.location.href = index_kegiatan.php';
        </script>
    ";
        }
    }
    ?>

 <?php include('../template/header.php'); ?>
 <h3 class="mb-4"><strong>Data Kegiatan</strong></h3>

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
                 <th scope="col"><strong>ID KEGIATAN</strong></th>
                 <th scope="col"><strong>NAMA KEGIATAN</strong></th>
                 <th scope="col"><strong>LOKASI KEGIATAN</strong></th>
                 <th scope="col"><strong>TANGGAL KEGIATAN</strong></th>
                 <th scope="col"><strong>Aksi</strong></th>
             </tr>
         </thead>
         <?php $i = 1; ?>
         <?php foreach ($kegiatan as $row) : ?>
             <tbody class="text-center text-white">
                 <tr>
                     <td><?= $i++; ?></td>
                     <td><?= $row["id_kegiatan"]; ?></td>
                     <td><?= $row["nama_kegiatan"]; ?></td>
                     <td><?= $row["lokasi_kegiatan"]; ?></td>
                     <td><?= $row["tanggal_kegiatan"]; ?></td>
                     <td>
                         <button type="button" class="btn btn-info " data-toggle="modal" data-target="#update<?= $row['id_kegiatan']; ?>">
                             <i class="mdi mdi-grease-pencil" style="font-size: 1.5rem;"></i>
                         </button>
                         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $row['id_kegiatan']; ?>">
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
                             <label for="" class="form-label">ID KEGIATAN</label>
                             <input type="text" name="id_kegiatan" class="form-control" value="<?= $id_kegiatan; ?>">

                             <label for="" class="form-label">NAMA KEGIATAN</label>
                             <input type="text" name="nama_kegiatan" class="form-control" required>

                             <label for="" class="form-label">LOKASI KEGIATAN</label>
                             <input type="text" name="lokasi_kegiatan" class="form-control" required>

                             <label for="" class="form-label">TANGGAL KEGIATAN</label>
                             <input type="date" name="tanggal_kegiatan" class="form-control" required>
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
 <?php foreach ($kegiatan as $row) : ?>
     <?php $kgt = query("SELECT * FROM kegiatan WHERE id_kegiatan = " . $row['id_kegiatan'])[0]; ?>
     <div class="modal fade" id="update<?= $row['id_kegiatan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <form action="" method="post">
                     <div class="modal-body">
                         <div class="row">
                             <div class="col">
                                 <label for="" class="form-label">ID KEGIATAN</label>
                                 <input type="text" name="id_kegiatan" class="form-control" value="<?= $kgt['id_kegiatan']; ?>">

                                 <label for="" class="form-label">NAMA KEGIATAN</label>
                                 <input type="text" name="nama_kegiatan" class="form-control" value="<?= $kgt["nama_kegiatan"]; ?>">

                                 <label for="" class="form-label">LOKASI KEGIATAN</label>
                                 <input type="text" name="lokasi_kegiatan" class="form-control" value="<?= $kgt["lokasi_kegiatan"]; ?>">

                                 <label for="" class="form-label">TANGGAL KEGIATAN</label>
                                 <input type="date" name="tanggal_kegiatan" class="form-control" value="<?= $kgt["tanggal_kegiatan"]; ?>">
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

 <?php foreach ($kegiatan as $row) : ?>
     <div class="modal fade" id="hapus<?= $row['id_kegiatan']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                 <input type="hidden" name="id_kegiatan" value="<?= $row['id_kegiatan']; ?>">
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