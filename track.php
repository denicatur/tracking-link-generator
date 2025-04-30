<?php
// Koneksi database
$db = new mysqli("localhost", "username", "password", "tracking_db");

// Ambil kode tracking
$tracking_code = $_GET['code'];

// Dapatkan URL asli
$stmt = $db->prepare("SELECT original_url FROM links WHERE tracking_code = ?");
$stmt->bind_param("s", $tracking_code);
$stmt->execute();
$result = $stmt->get_result();
$original_url = $result->fetch_assoc()['original_url'];

// Simpan data tracking (IP, Lokasi, Waktu)
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$time = date('Y-m-d H:i:s');

// Dapatkan lokasi dari IP (gunakan API seperti ip-api.com)
$location = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"), true);

// Simpan ke database
$stmt = $db->prepare("INSERT INTO tracking_data (tracking_code, ip, user_agent, time, location) VALUES (?, ?, ?, ?, ?)");
$location_json = json_encode($location);
$stmt->bind_param("sssss", $tracking_code, $ip, $user_agent, $time, $location_json);
$stmt->execute();

// Redirect ke URL asli
header("Location: $original_url");
exit;
?>