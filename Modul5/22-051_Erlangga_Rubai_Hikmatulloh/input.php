<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>FORM SUPPLIER</title>
</head>
<body>
<div class="container">
    <?php
        include "koneksi.php";

        $nama = $telp = $alamat = "";
        $namaErr = $telpErr = $alamatErr = "";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["nama"])) {
                $namaErr = "Nama tidak boleh kosong";
            } elseif (!preg_match("/^[a-zA-Z\s]*$/", $_POST["nama"])) {
                $namaErr = "Nama hanya boleh mengandung huruf dan spasi";
            } else {
                $nama = input($_POST["nama"]);
            }

            if (empty($_POST["telp"])) {
                $telpErr = "Nomor telepon tidak boleh kosong";
            } elseif (!preg_match("/^[0-9]*$/", $_POST["telp"])) {
                $telpErr = "Nomor telepon hanya boleh angka";
            } else {
                $telp = input($_POST["telp"]);
            }

            if (empty($_POST["alamat"])) {
                $alamatErr = "Alamat tidak boleh kosong";
            } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $_POST["alamat"])) {
                $alamatErr = "Alamat harus mengandung minimal 1 huruf dan 1 angka";
            } else {
                $alamat = input($_POST["alamat"]);
            }

            if (empty($namaErr) && empty($telpErr) && empty($alamatErr)) {
                $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: index.php");
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
                }
            }
        }
    ?>
    <br><br>
    <h2 style="color: blue;">Tambah Data Master Supplier</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            Nama 
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Supplier" value="<?php echo $nama; ?>" required />
            <small class="text-danger"><?php echo $namaErr; ?></small>
        </div>
        <div class="form-group">
            Telp 
            <input type="text" name="telp" class="form-control" placeholder="Masukan Nomor Telepon" value="<?php echo $telp; ?>" required/>
            <small class="text-danger"><?php echo $telpErr; ?></small>
        </div>
        <div class="form-group">
            Alamat 
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required><?php echo $alamat; ?></textarea>
            <small class="text-danger"><?php echo $alamatErr; ?></small>
        </div>       

        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
        <button type="button" onclick="window.location.href='index.php'" class="btn btn-danger">Batal</button>
    </form>
</div>
</body>
</html>
