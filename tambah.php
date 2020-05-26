<?php
require('functions/functions.php');
// cek apakah tombol submit sudah di klik
if (isset($_POST["submit"])) {
    // buat array untuk menampung error
    $error = [];
    // jalankan form validation
    // jika input name kosong
    if (empty($_POST["judul"])) {
        // masukan kedalam array erorr nama
        $error["judul"] = "Judul tidak boleh kosong!";
    }
    // jika input username kosong
    if (empty($_POST["pengarang"])) {
        // masukan kedalam array erorr username
        $error["pengarang"] = "Pengarang tidak boleh kosong!";
    }
    if (empty($_POST["penerbit"])) {
        $error["penerbit"] = "Penerbit tidak boleh kosong!";
    }
    if (empty($_POST["cover"])) {
        $error["cover"] = "Cover tidak boleh kosong!";
    }

    // jika array error kosong
    if (count($error) == 0) {
        // jalankan fungsi register
        if (tambah($_POST) > 0) {
            // jika registrasi berhasil tampilkan alert
            echo "<script>
            alert('Selamat Data Berhasil ditambahkan');
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
        <h1 class="display-4 text-center">Form Tambah Data</h1>
    </div>
</div>

<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="judul">Judul Buku :</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?php if (isset($_POST["submit"])) echo $_POST["judul"]; ?>">
            <?php if(isset($error["judul"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["judul"];?></small> <?php } ?>
        </div>
        <div class="form-group">
            <label for="pengarang">Pengarang :</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php if (isset($_POST["submit"])) echo $_POST["pengarang"]; ?>">
            <?php if(isset($error["pengarang"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["pengarang"];?></small> <?php } ?>
        </div>
        <div class="form-group">
            <label for="penerbit">Penerbit :</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php if (isset($_POST["submit"])) echo $_POST["penerbit"]; ?>">
            <?php if(isset($error["penerbit"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["penerbit"];?></small> <?php } ?>
        </div>
        <div class="form-group mb-4">
            <div>
                <label for="cover">Cover :</label></div>
            <input type="file" id="cover" name="cover">
            <?php if(isset($error["cover"])) {?>
            <small id="judul" class="form-text text-danger"><?php echo $error["cover"];?></small> <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Tambah Data</button>
    </form>
</div>











<?php
require('template/footer.php');
?>