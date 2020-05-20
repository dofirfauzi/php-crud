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
    $cover = htmlspecialchars($data["cover"]);
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);

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
