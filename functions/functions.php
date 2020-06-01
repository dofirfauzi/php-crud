<?php
$conn = mysqli_connect("localhost", "root", "", "phpcrud");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    
    // $cover = htmlspecialchars($data["cover"]);
    // Upload file
    $cover = upload();
    if (!$cover) {
        return false;
    }

    $query = "INSERT INTO books VALUES(
    '',
    '$cover',
    '$judul',
    '$pengarang',
    '$penerbit'
)";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    // ambil data 
    $fileName = $_FILES["cover"]["name"];
    $tmpName = $_FILES["cover"]["tmp_name"];
    $fileSize = $_FILES["cover"]["size"];

    // ekstensi file yang boleh diupload
    $ekstensiFileValid = ['jpg','jpeg','png'];

    // ambil extensi file yang diupload
    $explodeFile = explode('.',$fileName);
    $typeFile =strtolower(end($explodeFile));

    // cek exstensi file yang diupload 
    if (!in_array($typeFile,$ekstensiFileValid)) {
        echo "<script>
            alert('Maaf format file tidak dizinkan! Format file harus berupa jpg, jpeg atau png');
            </script>";
        return false;
    }

    // cek size file tidak boleh lebih dari 5 mb
    if ($fileSize > 5000000) {
        echo "<script>
            alert('Maaf ukuran file terlalu besar! ukuran file maximal 5 MB');
            </script>";
        return false;
    }

    // Generate nama file baru
    $newFileName = uniqid();
    $newFileName .='.';
    $newFileName .=$typeFile;

    // upload file ke direktori
    move_uploaded_file($tmpName,'img/' . $newFileName);
    return $newFileName;

}

function delet($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM books WHERE id = $id");
    
    return mysqli_affected_rows($conn);
}

function edit($data){
    global $conn;
    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $coverLama = htmlspecialchars($data["coverLama"]);

    // cek user upload cover baru atau tidak
    // jika user tidak upload cover baru
    if ($_FILES["cover"]["error"] === 4 ) {
        // cover disii dengan cover lama
        $cover = $coverLama;
    } else {
        // jika user upload cover baru, cover diisi dari hasil fungsi upload
        $cover = upload();
    }
    
    $query = "UPDATE books SET
    cover = '$cover',
    judul = '$judul',
    pengarang = '$pengarang',
    penerbit = '$penerbit'
    WHERE id = $id
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query = "SELECT * FROM books WHERE
                judul LIKE '%$keyword%' OR
                pengarang LIKE '%$keyword%' OR
                penerbit LIKE '%$keyword%'
                ";
    $dataPerPage = 5;
    $jumlahDataPencarian = count(query($query));
    $totalPage = ($jumlahDataPencarian / $dataPerPage);
    $pageAktif = (isset($_GET["page"])) ? $_GET["page"]:1;
    $dataAwal = ($dataPerPage * $pageAktif) - $dataPerPage;
    
    $query = "SELECT * FROM books WHERE
    judul LIKE '%$keyword%' OR
    pengarang LIKE '%$keyword%' OR
    penerbit LIKE '%$keyword%'
    LIMIT $dataAwal, $dataPerPage
    ";
    return $jumlahDataPencarian;
    return query($query);
}

