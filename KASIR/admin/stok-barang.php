<?php

require('ceklogin.php');

//hitung Jumlah Pesanan
$h1 = mysqli_query($conn, "SELECT * FROM produk");
$h2 = mysqli_num_rows($h1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Data Pesanan</a>
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
                        <a class="nav-link" href="logout.php">
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
                    <h1 class="mt-4">Data Pesanan</h1>
                    <br>
                    <div class="row">

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Jumlah Barang :
                                    <?php echo $h2 ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#myModal">
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
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM produk");
                                    $no = 1;

                                    while ($data = mysqli_fetch_assoc($sql)) {
                                        $namaproduk = $data['namaProduk'];
                                        $deskripsi = $data['deskripsi'];
                                        $harga = $data['harga'];
                                        $stok = $data['stok'];
                                        $idproduk = $data['idproduk'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $namaproduk ?>
                                            </td>
                                            <td>
                                                <?php echo $deskripsi ?>
                                            </td>
                                            <td>
                                                Rp:
                                                <?php echo number_format($harga); ?>
                                            </td>
                                            <td>
                                                <?php echo $stok ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#edit<?php echo $idproduk; ?>">
                                                    Edit Data
                                                </button>

                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#delete<?php echo $idproduk; ?>">
                                                    Delete
                                                </button>

                                            </td>

                                        </tr>
                                        <!-- modal edit stok barang -->
                                        <div class="modal" id="edit<?php echo $idproduk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">ubah
                                                            <?php echo $namaproduk; ?>
                                                        </h4>
                                                        <bu t ton type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </bu>
                                                    </div>

                                                    <form action="" method="post">

                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <input type="text" name="namaProduk" class="form-control mt-4"
                                                                placeholder="Nama
                                                            Produk" value="<?php echo $namaproduk; ?>">
                                                            <input type="text" name="deskripsi" class="form-control  mt-4"
                                                                placeholder="deskripsi" name="deskripsi"
                                                                value="<?php echo $deskripsi ?>">
                                                            <input type="num" name="harga" class="form-control  mt-4"
                                                                placeholder="Harga Produk" value="<?php echo $harga; ?>">

                                                            <input type="hidden" name="idp"
                                                                value="<?php echo $idproduk; ?>">

                                                        </div>


                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success"
                                                                name="editbarang">Edit</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- edit stok barang -->
                                        <div class="modal" id="delete<?php echo $idproduk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data
                                                            <?php echo $namaproduk; ?>
                                                        </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>

                                                    <form action="" method="post">

                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            Apakan Anda ingin Menghapus Data Ini?
                                                            <input type="hidden" name="idp"
                                                                value="<?php echo $idproduk; ?>">

                                                        </div>


                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success"
                                                                name="hapusbarang">hapus</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Close</button>
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

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="text" name="namaProduk" class="form-control mt-4" placeholder="Nama Produk">
                    <input type="text" name="deskripsi" class="form-control  mt-4" placeholder="deskripsi">
                    <input type="num" name="harga" class="form-control  mt-4" placeholder="Harga Produk">
                    <input type="num" name="stok" class="form-control  mt-4" placeholder="Stok Produk">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahbarang">Tambah</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

</html>