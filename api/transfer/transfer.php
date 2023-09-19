<?php
$servername = "localhost"; // Ganti dengan nama host MySQL Anda
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$database = "bank_db"; // Ganti dengan nama database Anda

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi ke database gagal: " . $e->getMessage();
    exit;
}
// Tangani permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Baca data dari permintaan
    $senderAccountId = $_POST['sender_account_id'];
    $receiverAccountId = $_POST['receiver_account_id'];
    $amount = $_POST['amount'];

    try {
        // Mulai transaksi MySQL
        $conn->beginTransaction();

        // Periksa apakah akun pengirim dan penerima ada
        $stmtSender = $conn->prepare("SELECT * FROM accounts WHERE id = :id");
        $stmtSender->bindParam(':id', $senderAccountId);
        $stmtSender->execute();
        $senderAccount = $stmtSender->fetch(PDO::FETCH_ASSOC);

        $stmtReceiver = $conn->prepare("SELECT * FROM accounts WHERE id = :id");
        $stmtReceiver->bindParam(':id', $receiverAccountId);
        $stmtReceiver->execute();
        $receiverAccount = $stmtReceiver->fetch(PDO::FETCH_ASSOC);

        if (!$senderAccount || !$receiverAccount) {
            http_response_code(404);
            echo json_encode(['message' => 'Akun tidak ditemukan']);
            exit;
        }

        // Periksa apakah saldo cukup
        if ($senderAccount['balance'] < $amount) {
            http_response_code(400);
            echo json_encode(['message' => 'Saldo tidak cukup untuk transfer ini']);
            exit;
        }

        // Lakukan transfer
        $stmtUpdateSender = $conn->prepare("UPDATE accounts SET balance = balance - :amount WHERE id = :id");
        $stmtUpdateSender->bindParam(':amount', $amount);
        $stmtUpdateSender->bindParam(':id', $senderAccountId);
        $stmtUpdateSender->execute();

        $stmtUpdateReceiver = $conn->prepare("UPDATE accounts SET balance = balance + :amount WHERE id = :id");
        $stmtUpdateReceiver->bindParam(':amount', $amount);
        $stmtUpdateReceiver->bindParam(':id', $receiverAccountId);
        $stmtUpdateReceiver->execute();

        // Mengambil saldo sekarang
        $stmt = $conn->prepare("SELECT balance FROM accounts WHERE id = :id");
        $stmt->bindParam(':id', $senderAccountId);
        $stmt->execute();
        $saldoSekarang = $stmt->fetchColumn();

        // Commit transaksi MySQL
        $conn->commit();

        http_response_code(200);
        // echo json_encode(['message' => 'Transfer berhasil']);
        echo '<script>alert("Transfer berhasil");</script>';
        echo '<script>alert("Sisa saldo Anda: ' . $saldoSekarang . '");</script>';
        echo '<script>window.location.href = "http://localhost/api/";</script>';


    } catch (PDOException $e) {
        // Rollback transaksi jika ada kesalahan
        $conn->rollback();
        http_response_code(500);
        echo json_encode(['message' => 'Terjadi kesalahan dalam transfer']);
        echo '<script>window.location.href = "http://localhost/api/";</script>';
        exit;
    }
}
