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
            <br><span>100.000 menjadi 100</span></label>
        <input type="text" name="amount" id="amount" required>
        <br>

        <button type="submit">Transfer Uang</button>
    </form>
</body>

</html>

<style>
    body {
        font-family: Times;
        background-color: #f0f0f0;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #333;
    }

    form {
        width: 300px;
        margin: 0 auto;
        padding: 25px;
        background-color: #fff;
        border-radius: px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
    }

    input {
        width: 100%;
        padding: 8px 3px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button {
        font-family: Times;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
    }
</style>
