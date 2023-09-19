<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "homework_php";

// Membuat koneksi ke database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Menangani permintaan GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $accountID = isset($_GET['account_id']) ? $_GET['account_id'] : '';

    if (!empty($accountID)) {
        $sql = "SELECT * FROM transactions WHERE account_id = '$accountID' ORDER BY tgl_trans DESC LIMIT 1";

        $result = $conn->query($sql);

        // Memeriksa apakah query berhasil dieksekusi
        if ($result) {
            
            $transaction = $result->fetch_assoc();

            header('Content-Type: application/json');
            echo json_encode($transaction);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Jika nomor rekening tidak diberikan
        http_response_code(400); 
        echo json_encode(array('message' => 'Nomor Account id harus disediakan.'));
    }
} else {
    // Jika metode HTTP bukan GET
    http_response_code(405);
    echo json_encode(array('message' => 'Metode HTTP tidak diizinkan.'));
}

$conn->close();

?>
