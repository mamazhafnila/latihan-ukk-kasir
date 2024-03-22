<?php
require('ceklogin.php');

//hitung Jumlah Pesanan
$h1 = mysqli_query($conn, "SELECT * FROM pesanan");
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
    <title>Data pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Data Pesanan</a>
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
                        <div class="sb-sidenav-menu-heading">Kelola Pelangan</div>
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
                                <div class="card-body">Jumlah Pesanan :
                                    <?php echo $h2 ?>
                                </div>

                            </div>
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#myModal">
                                Tambah Data Pesanan
                            </button>


                        </div>


                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Pesanan
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="dataTable" width="150px" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jumlah yang di beli</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM pesanan p ,
                                     pelanggan pl WHERE p.idpelanggan=pl.idpelanggan ");
                                    $no = 1;

                                    //hitung jumlah
                                    

                                    while ($data = mysqli_fetch_assoc($sql)) {
                                        $idpesanan = $data['idpesanan'];
                                        $tanggal = $data['tanggal'];
                                        $namapelanggan = $data['nama_pelanggan'];
                                        $alamat = $data['alamat'];


                                        $hitungjumlah = mysqli_query($conn, "SELECT * FROM detailpesanan where 
                                    idpesanan='$idpesanan'");
                                        $jumlah = mysqli_num_rows($hitungjumlah);

                                        ?>
                                    <tr>
                                        <th>
                                            <?php echo $idpesanan; ?>
                                        </th>
                                        <th>
                                            <?php echo $tanggal; ?>
                                        </th>
                                        <th>
                                            <?php echo $namapelanggan; ?>-
                                            <?php echo $alamat; ?>
                                        </th>
                                        <th>
                                            <?php echo $jumlah ?>
                                        </th>
                                        <td>
                                            <a href="view.php?idp=<?php echo $idpesanan; ?>"
                                                class="btn btn-secondary">Tampilkan</a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete<?php echo $idpesanan; ?>">
                                                Delete
                                            </button>
                                        </td>


                                    </tr>
                                    <div class="modal" id="delete<?php echo $idpesanan; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Data
                                                        Pesanan
                                                    </h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>

                                                <form action="" method="post">

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                        Apakan Anda ingin Menghapus Data Ini?
                                                        <input type="hidden" name=" idpesanan"
                                                            value="<?php echo $idpesanan ?>">

                                                    </div>


                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success"
                                                            name="hapuspesanan">hapus</button>
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
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
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
                <h4 class="modal-title">Tambah Pesanan Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    pilihan Pelanggan
                    <select name="idpelanggan">

                        <?php
                        $dtpelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ");

                        while ($p1 = mysqli_fetch_array($dtpelanggan)) {
                            $namapelanggan = $p1['nama_pelanggan'];
                            $idpelanggan = $p1['idpelanggan'];
                            $alamat = $p1['alamat'];

                            ?>

                        <option value="<?php echo $idpelanggan ?>">
                            <?php echo $namapelanggan ?>-
                            <?php echo $alamat ?>
                        </option>

                        <?php
                        }
                        ?>

                    </select>




                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahpesanan">Tambah pesanan</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

</html>