<?php
// tangkap data dari URL
require('functions/functions.php');

if (!isset($_GET["id"])) {
    header('Location:index.php');
}

$id=$_GET["id"];


$book=query("SELECT * FROM books WHERE id=$id")[0];


// cek apakah tombol submit sudah di klik
if (isset($_POST["submit"])) {
    // buat array untuk menampung error
    $error = [];
    // jalankan form validation
    // jika input judul kosong
    if (empty($_POST["judul"])) {
        // masukan kedalam array erorr judul
        $error["judul"] = "Judul tidak boleh kosong!";
    }
    // jika input pengarang kosong
    if (empty($_POST["pengarang"])) {
        // masukan kedalam array erorr pengarang
        $error["pengarang"] = "Pengarang tidak boleh kosong!";
    }
    if (empty($_POST["penerbit"])) {
        $error["penerbit"] = "Penerbit tidak boleh kosong!";
    }

    // jika array error kosong
    if (count($error) == 0) {
        // jalankan fungsi edit
        if (edit($_POST) > 0) {
            // jika berhasil tampilkan alert
            echo "<script>
            alert('Terimakasih, Data Berhasil diedit');
            document.location.href='index.php';
            </script>";
        } else {
            // jika gagal tampilkan error dari koneksi
            echo mysqli_error($conn);
        }
    }
}
// header
require('template/header.php');
?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4 text-center">Form Edit Data</h1>
    </div>
</div>

<div class="container">
<div class="row">
    <div class="col-md-4 text-center"><img class="img-fluid img-thumbnail mb-3" width="250" src="img/<?php echo $book["cover"]; ?>" alt=""></div>
    <div class="col">
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $book["id"]; ?>">
    <input type="hidden" name="coverLama" value="<?php echo $book["cover"]; ?>">
        <div class="form-group">
            <label for="judul">Judul Buku :</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?php if (!isset($_POST["submit"])) {echo $book["judul"];} else {echo $_POST["judul"];}?>">
            <?php if(isset($error["judul"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["judul"];?></small> <?php } ?>
        </div>
        <div class="form-group">
            <label for="pengarang">Pengarang :</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php if (!isset($_POST["submit"])) {echo $book["pengarang"];} else {echo $_POST["pengarang"];}?>">
            <?php if(isset($error["pengarang"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["pengarang"];?></small> <?php } ?>
        </div>
        <div class="form-group">
            <label for="penerbit">Penerbit :</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php if (!isset($_POST["submit"])) {echo $book["penerbit"];} else {echo $_POST["penerbit"];}?>">
            <?php if(isset($error["penerbit"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["penerbit"];?></small> <?php } ?>
        </div>
        <div class="form-group mb-4">
            <div>
                <label for="cover">Cover :</label></div>
            <input type="file" id="cover" name="cover">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Edit Data</button>
    </form>
    </div>
    </div>
</div>











<?php
require('template/footer.php');
?>