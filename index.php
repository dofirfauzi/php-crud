<?php
require('functions/functions.php');

$books = query("SELECT * FROM books");

if (isset($_POST["cari"])) {
    $books = cari($_POST["keyword"]);
    if (empty($books)) {
        $error = "Mohon maaf data tidak ditemukan";
    }
}

require('template/header.php');
?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Selamat Datang</h1>
        <p class="lead">Aplikasi sederhana untuk pengelolaan data buku perpustakaan</p>
    </div>
</div>
<div class="container databuku">
    <div class="row">
        <div class="col-lg-8 mb-2">
            <a class="btn btn-warning" type="submit" href="tambah.php">Tambah Data</a>
        </div>
        <div class="col-lg-4 mb-2">
        <form action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Find something" id="keyword" name="keyword" autofocus autocomplete="off">
                <div class="input-group-append">
                    <button type="submit" name="cari" class="input-group-text" id="keyword">Search</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <table class="table table-hover table-responsive-sm">
        <thead>
            <tr class="bg-primary text-white">
                <th scope="col">No</th>
                <th scope="col">Cover</th>
                <th scope="col">Judul</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><img class="img-thumbnail" width="40px" src="img\<?= $book["cover"]; ?>" alt=""></td>
                    <td><?= $book["judul"]; ?></td>
                    <td><?= $book["pengarang"]; ?></td>
                    <td><?= $book["penerbit"]; ?></td>
                    <td><a href="edit.php?id=<?php echo $book["id"];?>" class="badge badge-primary mr-2">Edit</a>
                        <a href="delet.php?id=<?php echo $book["id"];?>" onclick="return confirm('Anda akan menghapus data buku, yakin?');" class="badge badge-danger">Delet</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php } ?>
        </tbody>
    </table>
    <?php 
        if (isset($error)) {?>
        <p class="text-danger text-center font-italic"><?php echo $error; ?> </p>
        <?php } ?>
</div>










<?php
require('template/footer.php')
?>