<?php


// koneksikan ke database
$db =  mysqli_connect(
    "localhost",
    "root",
    "",
    "db_peker"
);


$result = mysqli_query(
    $db,
    // OERDER BY id
    // ASC
    // DESC
    // WHERE nik = ''
    "SELECT * FROM pekerja"
);
