<?php
$hasil = false;

if (isset($_POST['tambah'])) {
    $n = $_POST['n'];
}

if (isset($_POST['simpan'])) {
    $hasil = true;
    $n = $_POST['n'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web 2 | Pertemuan 2 | Nurdiansah</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</head>

<body>
    <nav class="navbar navbar-light bg-primary">
        <a class="navbar-brand mb-0 h1" href="index.php">Home</a>
        <a class="nav-link text-dark float-left" href="profile.php">Profile</a>
    </nav>
    <div class="container">
        <h2 class="text-center mt-3">Form Pemesanan Peralatan Kantor</h2>
        <?php if (isset($n) || $hasil == true) { ?>
            <div class="alert alert-success mt-3" role="alert">
                Berhasil!
            </div>
        <?php } ?>
        <div class="row">
            <!-- Form -->
            <div class="col-sm-12 col-md-3 mt-3">
                <div class="card">
                    <div class="card-header bg-warning">
                        Pengajuan
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class=" form-group">
                                <label>Jumlah yang akan di ajukan</label>
                                <input type="text" class="form-control" name="n" value="<?= $n ?>">
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php if (isset($n) && $n != 0 || $n != "") { ?>
                <form action="" method="POST">
                    <input type="hidden" name="n" value="<?= $n ?>">
                    <div class="col-sm-12 col-md-12 mt-3">
                        <table class="table table-striped">
                            <caption>Masukan Pesanan Peralatan</caption>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Peralatan</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 1; $i <= $n; $i++) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><input type="tipe-objek" class="form-control" name="nm_item[]"></td>
                                        <td><input type="tipe-objek" class="form-control" name="jml_item[]"></td>
                                        <td><input type="tipe-objek" class="form-control" name="harga[]"></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary float-right">Tambah</button>
                </form>
            <?php } ?>
        </div>

        <?php if ($hasil == true) { ?>
            <!-- Table -->
            <div class="col-sm-12 col-md-12 mt-3">
                <table class="table table-striped">
                    <caption>Daftar Pemesanan Peralatan Kantor</caption>
                    <thead>
                        <tr>
                            <td colspan="5" class="text-center">
                                <h3>Daftar Pemesanan Peralatan Kantor</h3>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Peralatan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalHarga = 0;
                        $ni = $n - 1;
                        for ($i = 0; $i <= $ni; $i++) {
                            $no = $i + 1;
                            $harga = 'Rp. ' . number_format($_POST['harga'][$i], 0, ",", ".");
                            $jml_harga = 'Rp. ' . number_format($_POST['jml_item'][$i] * $_POST['harga'][$i], 0, ",", ".");
                            $totalHarga += $_POST['jml_item'][$i] * $_POST['harga'][$i];
                        ?>
                            <tr>
                                <th scope="row"><?= $no; ?></th>
                                <td><?= $_POST['nm_item'][$i]; ?></td>
                                <td><?= $_POST['jml_item'][$i]; ?></td>
                                <td><?= $harga; ?></td>
                                <td><?= $jml_harga; ?></td>
                            </tr>
                        <?php }
                        $diskon = $totalHarga * 0.05;
                        $grandTotal = $totalHarga - $diskon;
                        ?>
                        <tr>
                            <td colspan="4" class="text-right">Total Harga</td>
                            <td><?= 'Rp. ' . number_format($totalHarga, 0, ",", ".");; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Diskon(5%)</td>
                            <td><?= 'Rp. ' . number_format($diskon, 0, ",", ".");; ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Jumlah harus di bayar </td>
                            <td><?= 'Rp. ' . number_format($grandTotal, 0, ",", ".");; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</body>

</html>