<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transfer Uang</title>
</head>

<body>
    <h1>Form Transfer Uang</h1>
    <form action="http://localhost/api/transfer.php" method="POST">
        <label for="sender_account_id">No. Rekening Pengirim:</label>
        <input type="text" name="sender_account_id" id="sender_account_id" required>
        <br>

        <label for="receiver_account_id">No. Rekening Penerima:</label>
        <input type="text" name="receiver_account_id" id="receiver_account_id" required>
        <br>

        <label for="amount">Jumlah Transfer:
            <br><span>500.000 menjadi 500</span></label>
        <input type="text" name="amount" id="amount" required>
        <br>

        <button type="submit">Transfer Uang</button>
    </form>
</body>

</html>

