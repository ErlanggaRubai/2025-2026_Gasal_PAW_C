<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA MASTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <br><br>
    <h4 style="color: blue;">Data Master Supplier</h4>
<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET["id"]);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "DELETE FROM supplier WHERE id='$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location:index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
}
?>

<a href="input.php" class="btn btn-success" role="button" style="float: right;">Tambah Data</a>
<br><br>

<table class="my-3 table table-bordered">
    <thead>
        <tr class="table-primary">           
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "koneksi.php";
        $sql = "SELECT * FROM supplier ORDER BY id ASC"; 

        $result = mysqli_query($conn, $sql);
        $no = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $no++;
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["telp"]; ?></td>
            <td><?php echo $row["alamat"]; ?></td>
            <td>
                <a href="update.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning" role="button">Edit</a>
                <button class="btn btn-danger" onclick="konfirmasiHapus(<?php echo $row['id']; ?>)">Hapus</button>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script>
    function konfirmasiHapus(id) {
        if (confirm("Anda yakin akan menghapus data supplier ini?")) {
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=" + id);
            form.style.display = "hidden";
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
</div>
</body>
</html>
