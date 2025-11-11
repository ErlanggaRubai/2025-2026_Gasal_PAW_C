<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the item is used in transaksi_detail
    $checkQuery = "SELECT COUNT(*) AS count FROM transaksi_detail WHERE barang_id = '$id'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['count'] > 0) {
        // Item is in use in transaksi_detail, show alert and redirect
        echo "<script>
                alert('Barang tidak dapat dihapus karena sudah digunakan dalam transaksi detail');
                window.location.href='index.php';
            </script>";
    } else {
        // Item is not in use, show confirmation dialog before deletion
        echo "<script>
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    window.location.href = 'delete_barang.php?id=$id&confirm=true';
                } else {
                    window.location.href = 'index.php';
                }
            </script>";
    }
} elseif (isset($_GET['confirm']) && $_GET['confirm'] == 'true' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the item if confirmed
    $deleteQuery = "DELETE FROM barang WHERE id = '$id'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>
                alert('Barang berhasil dihapus.');
                window.location.href='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menghapus barang.');
                window.location.href='index.php';
            </script>";
    }
} else {
    // Redirect to index if no valid action
    header("Location: index.php");
    exit;
}
?>
