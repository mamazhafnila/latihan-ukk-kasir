<?php

require('ceklogin.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Data Barang Masuk</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>

        <!-- Navbar-->

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">pesanan</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Order
                        </a>
                        <div class="sb-sidenav-menu-heading">Stok</div>
                        <a class="nav-link" href="stok-barang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stok Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Barang Masuk</div>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <div class="sb-sidenav-menu-heading">Kelola Pelanggan</div>
                        <a class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kelola Pelangan
                        </a>



                        <div class="sb-sidenav-menu-heading">Keluar</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Logout
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Barang Masuk</h1>
                    <br>
                    <div class="row">


                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Barang
                        </button>


                    </div>

                    <br>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Barang
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="150px" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk.</th>
                                    <th>Jumlah</th>
                                    <th>tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM masuk m , produk p
                                 where m.idproduk=p.idproduk");
                                $no = 1;

                                while ($data = mysqli_fetch_assoc($sql)) {
                                    $namaproduk = $data['namaProduk'];
                                    $deskripsi = $data['deskripsi'];
                                    $qty = $data['qty'];
                                    $tanggal = $data['tanggal'];
                                    $idmasuk = $data['idmasuk'];
                                    $idproduk = $data['idproduk'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ?>
                                        </td>
                                        <td>
                                            <?php echo $namaproduk ?>--
                                            <?php echo $deskripsi ?>
                                        </td>

                                        <td>
                                            <?php echo $qty ?>
                                        </td>
                                        <td>
                                            <?php echo $tanggal ?>
                                        </td>
                                        <td>
                                        <td>
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#edit<?php echo $idmasuk; ?>">
                                                Edit Data
                                            </button>

                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#delete<?php echo $idmasuk; ?>">
                                                Delete
                                            </button>

                                            </th>

                                    </tr>

                                    <!-- modal edit stok barang -->
                                    <div class="modal" id="edit<?php echo $idmasuk; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">ubah
                                                        Data Masuk
                                                    </h4>
                                                    <bu t ton type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </bu>
                                                </div>

                                                <form action="" method="post">

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                        <input type="text" name="namaProduk" class="form-control mt-4"
                                                            value="<?php echo $namaproduk ?>--<?php echo $deskripsi ?>"
                                                            disabled>
                                                        <input type="number" name="qty" class="form-control  mt-4"
                                                            value="<?php echo $qty; ?>">

                                                        <input type="hidden" name="idm" value="<?php echo $idmasuk; ?>">
                                                        <input type="hidden" name="idp" value="<?php echo $idproduk; ?>">

                                                    </div>


                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success"
                                                            name="editbarangmasuk">Edit</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete stok barang -->
                                    <div class="modal" id="delete<?php echo $idmasuk; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Data barang masuk

                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>

                                                <form action="" method="post">

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                        Apakan Anda yakin Menghapus Data barang masuk Ini?
                                                        <input type="hidden" name="idp" value="<?php echo $idproduk; ?>">
                                                        <input type="hidden" name="idm" value="<?php echo $idmasuk; ?>">

                                                    </div>


                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger"
                                                            name="hapusbarangmasuk">hapus</button>
                                                        <button type="button" class="btn btn-warning"
                                                            data-bs-dismiss="modal">close</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>



                                    <?php
                                }
                                ?>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
        </main>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    pilihan barang
                    <select name="idproduk">

                        <?php
                        $dtproduk = mysqli_query($conn, "SELECT * FROM produk");


                        while ($p1 = mysqli_fetch_array($dtproduk)) {
                            $namaproduk = $p1['nama_pelanggan'];
                            $deskripsi = $p1['deskripsi'];
                            $stok = $p1['stok'];
                            $idproduk = $p1['idproduk'];

                            ?>

                            <option value="<?php echo $idproduk; ?>">
                                <?php echo $namaproduk; ?>
                                <?php echo $deskripsi; ?>-(stok
                                <?php echo $stok ?>)
                            </option>






                            <?php
                        }
                        ?>

                    </select>

                    <input type="number" name="qty" class="form-control mt-2" placeholder="jumlah" min="1" required>




                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahbarangmasuk">
                        Tambah Produk</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

</html>