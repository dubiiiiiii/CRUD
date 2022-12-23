<?php
$host = '';
$user = "root";
$pass = "";
$db = "db_buku";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    # code...
    die("tidak bisa koneksi ke database");
}
$judul_buku = "";
$pengarang = "";
$penerbit = "";
$tahun = "";
$harga = "";
$stok = "";
$foto = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id_buku = $_GET['id_buku'];
    $sql1 = "delete from buku where id_buku = '$id_buku'";
    $q1 = mysqli_query($koneksi, $sql1);

    if ($q1) {
        $sukses = "Berhasil Hapus Data";
    } else {
        $error = "Tidak dapat dihapus!";
    }
}


if ($op == 'edit') {
    $id_buku = $_GET['id_buku'];
    $sql1 = "select * from buku where id_buku = '$id_buku'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);

    $judul_buku = $r1['judul_buku'];
    $pengarang = $r1['pengarang'];
    $penerbit = $r1['penerbit'];
    $tahun = $r1['tahun'];
    $harga = $r1['harga'];
    $stok = $r1['stok'];
    $foto = $r1['foto'];

    if ($judul_buku == '') {
        $error = "Data tidak ditemukan";
    }
}

// create
if (isset($_POST['submit'])) {
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $foto = $_POST['foto'];

    if ($judul_buku && $pengarang && $penerbit && $tahun && $harga && $stok && $foto) {
        // update
        if ($op == 'edit') {
            $sql1 = "update user set buku='$judul_buku','$pengarang','$penerbit', '$tahun', '$harga', '$stok', '$foto' where id_buku = '$id_buku'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data telah berubah!";
            } else {
                $error = "Data tidak dapat dirubah!";
            }
            // delete
        } else {
            $sql1 = "insert into buku(judul_buku, pengarang, penerbit, tahun, harga, stok, foto) values('$judul_buku','$pengarang','$penerbit', '$tahun', '$harga', '$stok', '$foto' )";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "berhasil input data!";
            } else {
                $error = "gagal input data!";
            }
        }
    } else {
        $error = "Please input data!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <ul class="nav nav-tabs text-bg-dark justify-content-center">
            <!-- <li class="nav-item">
                <a class="nav-link" aria-current="page" href="main.php">Main</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link active" href="#">Data Buku</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link " href="data.php">Data Lokasi</a>
            </li> -->
        </ul>
    </div>
    <div class="bd-1">
        <div class="mx-auto">
            <!-- input data -->
            <div class="card">
                <div class="card-header">
                    Create / Edit Data
                </div>
                <div class="card-body">
                    <!-- error msg -->
                    <?php
                    if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                        header("refresh:5;url=new_buku.php");
                    }
                    ?>

                    <!-- succed msg -->
                    <?php
                    if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                        header("refresh:5;url=new_buku.php");
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="judul_buku" class="col-sm-2 col-form-label">judul_buku</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul_buku" id="judul_buku"
                                    value="<?php echo $judul_buku ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pengarang" id="pengarang"
                                    value="<?php echo $pengarang ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                            <div class="col-sm-10">
                                <input type="penerbit" class="form-control" name="penerbit" id="penerbit"
                                    value="<?php echo $penerbit ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                                <input type="tahun" class="form-control" name="tahun" id="tahun"
                                    value="<?php echo $tahun ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="harga" class="form-control" name="harga" id="harga"
                                    value="<?php echo $harga ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="stok" class="form-control" name="stok" id="stok"
                                    value="<?php echo $stok ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="foto" class="form-control" name="foto" id="foto"
                                    value="<?php echo $foto ?>">
                            </div>
                        </div>
                        <!-- button -->
                        <div class="col-12">
                            <input type="submit" name="submit" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            <!-- output data. -->
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Peminjaman Buku
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Pengarang</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Option</th>
                            </tr>
                        <tbody>
                            <?php
                            $sql2 = "select * from buku order by id_buku desc";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urut = 1;
                            while ($r2 = mysqli_fetch_array($q2)) {
                                $id_buku = $r2['id_buku'];
                                $pengarang = $r2['pengarang'];
                                $penerbit = $r2['penerbit'];
                                $tahun = $r2['tahun'];
                                $harga = $r2['harga'];
                                $stok = $r2['stok'];
                                $foto = $r2['foto'];

                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $urut++ ?>
                                </th>
                                <td scope="row">
                                    <?php echo $judul_buku ?>
                                </td>
                                <td scope="row">
                                    <?php echo $pengarang ?>
                                </td>
                                <td scope="row">
                                    <?php echo $penerbit ?>
                                </td>
                                <td scope="row">
                                    <?php echo $tahun ?>
                                </td>
                                <td scope="row">
                                    <?php echo $harga ?>
                                </td>
                                <td scope="row">
                                    <?php echo $stok ?>
                                </td>
                                <td scope="row">
                                    <?php echo $foto ?>
                                </td>

                                <td scope="row">
                                    <a href="new_buku.php?op=edit&id=<?php echo $id_buku ?>"><button type="button"
                                            class="btn btn-warning">Edit</button></a>
                                    <a href="new_buku.php?op=delete&id=<?php echo $id_buku ?>"
                                        onclick="return confirm('Delete ?')"><button type="button"
                                            class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>