<?php

// agar kode kita rapi dan enak di baca kita akan menaruh
// query databases di dalam file function.php ini.


// code koneksi untuk untuk koneksi ke databases
session_start();
$conn = mysqli_connect("localhost", "root", "", "kasir");


// query register

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = mysqli_query($conn, "INSERT INTO user(username ,email,password)
    VALUES ('$username','$email','$password')");


    if ($data > 0) {
        // jika berhasil arahkan ke login
        header('Location:login.php');
    } else {
        // jika berhasil beri esan kesalahan
        echo "data gagal masuk";
    }


    // query  login

}


if (isset($_POST['login'])) {

    // ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check apakah  Username dan password sudah sesuai dari databases
    $sql = mysqli_query($conn, "SELECT * FROM user
    WHERE username='$username' AND password='$password'");

    //untuk menghitung jumlah baris jika ada baris yang berubah maka berhasil
    $data = mysqli_num_rows($sql);

    if ($data > 0) {
        // jika data yang temukan
        // maka berhasi login
        $_SESSION['login'] = 'true';
        header('Location:home.php');

    } else {
        // jika data tidak di temukan

        echo "<script>
               alert(' username dan password salah');
               window.location.href('login.php');
             </script>";

    }

}


// query tambah data barang


if (isset($_POST['tambahbarang'])) {
    $namaproduk = $_POST['namaProduk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $insert = mysqli_query($conn, "INSERT INTO produk(namaProduk,deskripsi,harga,stok)
    VALUES ('$namaproduk','$deskripsi','$harga','$stok')");


    if ($insert > 0) {
        header('Location:stok-barang.php');
    } else {
        echo "<script>
               alert(' username dan password salah');
               window.location.href('login.php');
             </script>";

    }

}

// query tambah data pelanggan

if (isset($_POST['tambahpelanggan'])) {
    $namapelanggan = $_POST['nama_pelanggan'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];


    $insert = mysqli_query($conn, "INSERT INTO pelanggan(nama_pelanggan,telepon,alamat)
    VALUES ('$namapelanggan','$telepon','$alamat')");


    if ($insert > 0) {
        header('Location:pelanggan.php');
    } else {
        echo "<script>
               alert('data gagal masuk');
               window.location.href('login.php');
             </script>";

    }

}

// query tambah data pesanan

if (isset($_POST['tambahpesanan'])) {
    $idpelanggan = $_POST['idpelanggan'];



    $insert = mysqli_query($conn, "INSERT INTO pesanan(idpelanggan)
    VALUES ('$idpelanggan')");


    if ($insert > 0) {
        header('Location:home.php');
    } else {
        echo "<script>
               alert('data gagal masuk');
               window.location.href('login.php');
             </script>";

    }

}

// query tambah data produk

if (isset($_POST['addproduk'])) {
    $idproduk = $_POST['idproduk'];
    $idp = $_POST['idp'];
    $qty = $_POST['qty'];


    $hitung1 = mysqli_query($conn, "SELECT * FROM produk WHERE idproduk='$idproduk'");
    $hitung2 = mysqli_fetch_assoc($hitung1);
    $stoksekarang = $hitung2['stok']; //stok barang saat ini

    if ($stoksekarang >= $qty) {

        // kurangi stok dengan jumlah yang akan di keluarkan
        $selisih = $stoksekarang - $qty;

        $insert = mysqli_query($conn, "INSERT INTO detailpesanan(idpesanan,idproduk,qty)
    VALUES ('$idp','$idproduk','$qty')");

        $update = mysqli_query($conn, "UPDATE produk SET stok='$selisih' where idproduk='$idproduk'");


        if ($insert > 0) {
            header('Location:view.php?idp=' . $idp);
        } else {
            echo '<script>
               alert("gagal menambah pesanan");
              window,location.href="view.php?idp=' . $idp . '"
             </script>';

        }
    } else {
        echo '<script>
        alert("stok barang tidak cukup");
       window,location.href="view.php?idp=' . $idp . '"
      </script>';


    }




}

// tambah barang masuk

if (isset($_POST['tambahbarangmasuk'])) {
    $idproduk = $_POST['idproduk'];
    $qty = $_POST['qty'];


    $caristok = mysqli_query($conn, "SELECT * FROM produk where idproduk='$idproduk'");
    $caristok1 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok1['stok'];

    // hitung

    $newstok = $stoksekarang + $qty;

    $insertb = mysqli_query($conn, "INSERT INTO masuk(idproduk , qty)
    VALUES ('$idproduk' , '$qty')");
    $updatetb = mysqli_query($conn, "UPDATE produk SET stok='$newstok' where idproduk='$idproduk'");


    if ($insertb && $updatetb) {
        header('Location:masuk.php');
    } else {
        echo "<script>
               alert('data gagal masuk');
               window.location.href('login.php');
             </script>";

    }

}


// query hapus Data produk
if (isset($_POST['hapusproduk'])) {
    $idp = $_POST['idp']; // id detail pesanan
    $idpr = $_POST['idpr'];
    $idpesanan = $_POST['idpesanan'];

    // check qty sekarang

    $cek1 = mysqli_query($conn, "SELECT * FROM detailpesanan where id_detail_pesanan='$idp'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty'];


    // chek stok sekarang

    $cek3 = mysqli_query($conn, "SELECT * FROM produk  where idproduk='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);
    $stoksekarang = $cek4['stok'];


    $hitung = $stoksekarang + $qtysekarang;

    $update = mysqli_query($conn, "UPDATE produk SET stok='$hitung' WHERE idproduk='$idpr'");
    $delete = mysqli_query($conn, "DELETE FROM detailpesanan where idproduk='$idpr' and id_detail_pesanan='$idp'");


    if ($update && $delete > 0) {
        header('Location:view.php?idp=' . $idpesanan);

    } else {
        echo '<script>
               alert("gagal menghapus data");
              window,location.href="view.php?idp=' . $idpesanan . '"
             </script>';


    }

}


// query update barang
if (isset($_POST['editbarang'])) {

    $namaproduk = $_POST['namaProduk'];
    $desk = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp']; //id produk


    $update = mysqli_query($conn, "UPDATE produk SET namaProduk='$namaproduk',
    deskripsi='$desk',harga='$harga' where  idproduk='$idp' ");

    if ($update > 0) {
        header('Location:stok-barang.php');
    } else {
        echo '<script>
        alert("gagal mengubah pesanan");
       window.location.href="stok-barang.php";
      </script>';

    }

}


// query data delete barang


if (isset($_POST['hapusbarang'])) {
    $idp = $_POST['idp'];

    $hapus = mysqli_query($conn, "DELETE FROM produk WHERE idproduk='$idp'");

    if ($hapus > 0) {
        header('Location:stok-barang.php');

    } else {
        echo '<script>
        alert("gagal menghapus data barang");
       window.location.href="stok-barang.php";
      </script>';

    }

}

//query edit data pelanggan
if (isset($_POST['editpelanggan'])) {
    $namapelanggan = $_POST['nama_pelanggan'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $idpel = $_POST['idpel'];

    $update = mysqli_query($conn, "UPDATE pelanggan SET nama_pelanggan='$namapelanggan',
    telepon='$telepon',alamat='$alamat' where idpelanggan='$idpel' ");

    if ($update > 0) {
        header('Location:pelanggan.php');

    } else {
        echo '<script>
        alert("gagal mengubah data pelanggan");
       window.location.href="stok-barang.php";
      </script>';

    }

}

//query hapus data pelanggan

if (isset($_POST['hapuspelanggan'])) {
    $idpel = $_POST['idpel'];

    $hapus = mysqli_query($conn, "DELETE FROM pelanggan WHERE idpelanggan='$idpel'");

    if ($hapus > 0) {
        header('Location:pelanggan.php');

    } else {
        echo '<script>
        alert("gagal menghapus data pelanggan");
       window.location.href="stok-barang.php";
      </script>';


    }

}

if (isset($_POST['editbarangmasuk'])) {
    $qty = $_POST['qty'];
    $idm = $_POST['idm']; // id masuk
    $idp = $_POST['idp']; // id produk


    // cari tahu qty yang sekarang

    $caritahu = mysqli_query($conn, "SELECT * FROM masuk where idmasuk='$idm'");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    // cari tahu stok sekarang ada berapa
    $caristok = mysqli_query($conn, "SELECT * FROM produk where idproduk='$idp'");
    $caristok1 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok1['stok'];

    if ($qty >= $qtysekarang) {
        // kalau inputan user lebih besar dari pada qty yang tercatat
        //hitung selisih

        $selisih = $qty - $qtysekarang;
        $newstok = $stoksekarang + $selisih;

        $query1 = mysqli_query($conn, "UPDATE masuk SET qty='$qty' where idmasuk='$idm'");
        $query2 = mysqli_query($conn, "UPDATE produk SET stok='$newstok' where idproduk='$idp'");

        if ($query1 && $query2) {
            header('Location:masuk.php');

        } else {
            echo '<script>
            alert("gagal masuk");
           window.location.href="masuk.php";
          </script>';

        }

    } else {
        // kalau lebih kecil
        // hitung selisih
        $selisih = $qtysekarang - $qty;
        $newstok = $stoksekarang - $selisih;


        $query1 = mysqli_query($conn, "UPDATE masuk SET qty='$qty' where idmasuk='$idm'");
        $query2 = mysqli_query($conn, "UPDATE produk SET stok='$newstok' where idproduk='$idp'");


        if ($query1 && $query2) {
            header('Location:masuk.php');

        } else {
            echo '<script>
            alert("gagal masuk");
           window.location.href="stok-barang.php";
          </script>';

        }


    }




}

// hapus data barang masuk

if (isset($_POST['hapusbarangmasuk'])) {
    $idp = $_POST['idp'];
    $idm = $_POST['idm'];



    // cari tahu qty yang sekarang

    $caritahu = mysqli_query($conn, "SELECT * FROM masuk where idmasuk='$idm'");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    // cari tahu stok sekarang ada berapa
    $caristok = mysqli_query($conn, "SELECT * FROM produk where idproduk='$idp'");
    $caristok1 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok1['stok'];

    // kalau lebih kecil
    // hitung selisih

    $newstok = $stoksekarang - $qtysekarang;


    $query1 = mysqli_query($conn, "DELETE  FROM masuk where idmasuk='$idm'");
    $query2 = mysqli_query($conn, "UPDATE produk SET stok='$newstok' where idproduk='$idp'");


    if ($query1 && $query2) {
        header('Location:masuk.php');

    } else {
        echo '<script>
            alert("gagal masuk");
           window.location.href="stok-barang.php";
          </script>';

    }




}

if (isset($_POST['hapuspesanan'])) {
    $idpesanan = $_POST['idpesanan'];

    $cekdata = mysqli_query($conn, "SELECT * FROM detailpesanan dp where idpesanan='$idpesanan'");

    while ($data = mysqli_fetch_assoc($cekdata)) {

        // balikin stoknya
        $qty = $data['qty'];
        $idproduk = $data['idproduk'];
        $iddp = $data['id_detail_pesanan'];


        // cari tahu stok sekarang ada berapa
        $caristok = mysqli_query($conn, "SELECT * FROM produk where idproduk='$idproduk'");
        $caristok1 = mysqli_fetch_array($caristok);
        $stoksekarang = $caristok1['stok'];

        $newstok = $stoksekarang + $qty;

        $queryupdate = mysqli_query($conn, "UPDATE produk SET stok=' $newstok ' where idproduk='$idproduk'");

        $querydelete = mysqli_query($conn, "DELETE FROM detailpesanan WHERE id_detail_pesanan='$iddp'");



    }

    $query = mysqli_query($conn, "DELETE FROM pesanan where idpesanan='$idpesanan'");

    if ($queryupdate && $querydelete && $querry) {
        header('Location:home.php');
    } else {
        echo '<script>
           window.location.href="home.php";
          </script>';
    }


}




if (isset($_POST['editdetailpemesanan'])) {
    $qty = $_POST['qty'];
    $iddp = $_POST['iddp']; // id masuk
    $idpr = $_POST['idpr']; // id produk



    // cari tahu qty yang sekarang

    $caritahu = mysqli_query($conn, "SELECT * FROM detailpesanan where id_detail_pesanan ='$iddp'");
    $caritahu2 = mysqli_fetch_array($caritahu);
    $qtysekarang = $caritahu2['qty'];

    // cari tahu stok sekarang ada berapa
    $caristok = mysqli_query($conn, "SELECT * FROM produk where idproduk='$idpr'");
    $caristok1 = mysqli_fetch_array($caristok);
    $stoksekarang = $caristok1['stok'];

    if ($qty >= $qtysekarang) {
        // kalau inputan user lebih besar dari pada qty yang tercatat
        //hitung selisih

        $selisih = $qty - $qtysekarang;
        $newstok = $stoksekarang - $selisih;

        $query1 = mysqli_query($conn, "UPDATE detailpesanan SET qty='$qty' where id_detail_pesanan
        ='$iddp'");
        $query2 = mysqli_query($conn, "UPDATE produk SET stok='$newstok' where idproduk='$idpr'");

        if ($query1 && $query2) {
            header('Location:view.php');

        } else {
            echo '<script>
            alert("gagal masuk");
           window.location.href="masuk.php";
          </script>';

        }

    } else {
        // kalau lebih kecil
        // hitung selisih
        $selisih = $qtysekarang - $qty;
        $newstok = $stoksekarang + $selisih;


        $query1 = mysqli_query($conn, "UPDATE detailpesanan SET qty='$qty' where id_detail_pesanan
        ='$iddp'");
        $query2 = mysqli_query($conn, "UPDATE produk SET stok='$newstok' where idproduk='$idpr'");


        if ($query1 && $query2) {
            header('Location:view.php');

        } else {
            echo '<script>
            alert("gagal masuk");
           window.location.href="stok-barang.php";
          </script>';

        }


    }




}