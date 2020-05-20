<?php
require('functions/functions.php');
if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        echo "
        <script> alert('Terimakasih, data berhasil ditambahkan!');
        document.location.href='index.php';
        </script>
        ";
    } else {
        echo "
        <script> alert('Mohon maaf, data gagal ditambahkan!');
        </script>
        ";
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
            <input type="text" class="form-control" id="judul" name="judul">
            <small id="judul" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="pengarang">Pengarang :</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang">
        </div>
        <div class="form-group">
            <label for="penerbit">Penerbit :</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit">
        </div>
        <div class="form-group mb-4">
            <div>
                <label for="cover">Cover :</label></div>
            <input type="file" id="cover" name="cover">
        </div>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah Data</button>
    </form>
</div>











<?php
require('template/footer.php')
?>