<?php
require('functions/functions.php');

$books = query("SELECT * FROM books");

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
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Find something" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Search</span>
                </div>
            </div>
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
                    <td><?= $book["Judul"]; ?></td>
                    <td><?= $book["Pengarang"]; ?></td>
                    <td><?= $book["Penerbit"]; ?></td>
                    <td><a href="#" class="badge badge-primary mr-2">Edit</a>
                        <a href="#" class="badge badge-danger">Delet</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php } ?>
        </tbody>
    </table>
</div>










<?php
require('template/footer.php')
?>