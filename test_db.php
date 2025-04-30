<?php
$db = new mysqli("localhost", "root", "", "tracking_db");
if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
} else {
    echo "Koneksi database berhasil!";
}
?>