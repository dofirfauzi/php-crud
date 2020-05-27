<?php 

require 'functions/functions.php';
$id=$_GET["id"];

if (delet($id) > 0) {
    echo "<script>
            alert('Terimakasih, Data Berhasil didelet');
            document.location.href='index.php';
            </script>";
}else {
    // jika gagal tampilkan error dari koneksi
    echo mysqli_error($conn);
}

?>