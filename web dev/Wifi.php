<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "Gundulmu";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk mengimport file SQL
function importDatabase($conn, $filePath) {
    // Membaca file SQL
    $sql = file_get_contents($filePath);

    // Menjalankan perintah SQL
    if ($conn->multi_query($sql)) {
        do {
            // Memeriksa apakah ada hasil
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
        echo "Database berhasil diimport!";
    } else {
        echo "Error mengimport database: " . $conn->error;
    }
}

// Path ke file SQL
$filePath = 'path/to/your/file.sql';

// Memanggil fungsi import
importDatabase($conn, $filePath);

// Menutup koneksi
$conn->close();
?>

