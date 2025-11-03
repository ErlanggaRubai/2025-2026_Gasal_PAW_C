<!DOCTYPE html>
<html>
<head>
    <title>UPDATE DATA</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_GET['id'])) {
        $id = input($_GET["id"]);

        $sql = "SELECT * FROM supplier WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($result);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = htmlspecialchars($_POST["id"]);
        $nama = input($_POST["nama"]);
        $telp = input($_POST["telp"]);
        $alamat = input($_POST["alamat"]);

        $sql = "UPDATE supplier SET
                nama='$nama',
                telp='$telp',
                alamat='$alamat'
                WHERE id=$id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <br><br>
    <h2 style="color: blue;">Edit Data Master Supplier</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            Nama <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Supplier" required value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" />
        </div>
        <div class="form-group">
            Telp <input type="text" name="telp" class="form-control" placeholder="Masukan Nomor Telepon" required value="<?php echo isset($data['telp']) ? $data['telp'] : ''; ?>" />
        </div>
        <div class="form-group">
            Alamat <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required value="<?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?>" />
        </div>

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
        <button type="submit" name="submit" class="btn btn-success">Update</button>
        <button type="button" onclick="batal()" class="btn btn-danger">Batal</button>
    </form>
</div>

<script>
    function batal() {
        window.location.href = "index.php";
    }
</script>
</body>
</html>
