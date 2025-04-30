<?php
// Koneksi ke database
try {
    $db = new mysqli("localhost", "root", "", "tracking_db");
    
    // Generate random tracking code
    $original_url = $_POST['original_url'];
    $tracking_code = uniqid();

    // Simpan ke database
    $stmt = $db->prepare("INSERT INTO links (original_url, tracking_code) VALUES (?, ?)");
    $stmt->bind_param("ss", $original_url, $tracking_code);
    $stmt->execute();

    // Tampilkan link tracking
    $tracking_url = "http://localhost/track.php?code=" . $tracking_code;
    echo "Link Tracking Anda: <a href='$tracking_url'>$tracking_url</a>";
    
} catch (mysqli_sql_exception $e) {
    die("Error database: " . $e->getMessage());
}
?>