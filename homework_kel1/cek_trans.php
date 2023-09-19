<!DOCTYPE html>
<html>
<head>
    <title>Cek Transaksi Terakhir</title>
</head>
<body>
<title>Cek Transaksi Terakhir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <!--Awal navbar-->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">BANGKING APP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#"> Saldo <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
             <a class="nav-link" href="#"> Transfer <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
             <a class="nav-link" href=""> History <span class="sr-only">(current)</span></a>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
    </nav>
  <!--Akhir navbar-->

  <br>  
  <h3 id="history">History Transaksi Terakhir</h3>
    <div>
    <form id="transactionForm">
        <label class="col-sm-1 col-form-label" for="accountID">Account ID:</label>
        <input type="text" id="accountID" name="account_id" required>
        <button class="btn btn-secondary" type="submit">Cek Transaksi</button>
        
    </form>
    </div>
    <br>
    <div class="col-sm-10" id="transactionTable">
        <!-- Tabel  data transaksi -->
    </div>
    <br><button class="btn btn-secondary" id="backButton" style="display: none;">Kembali</button>

    <script>
        document.getElementById("backButton").addEventListener("click", function() {
            window.location.href = 'http://localhost/homework_kel1/cek.php?';
        });

        document.getElementById("transactionForm").addEventListener("submit", function(event) {
            event.preventDefault(); 
            const accountID = document.getElementById("accountID").value;

            // Melakukan permintaan GET ke API dengan menggunakan Fetch API
            fetch(`transactions.php?account_id=${accountID}`)
                .then(response => response.json())
                .then(data => {
                    const transactionTable = document.getElementById("transactionTable");
                    transactionTable.innerHTML = '';

                    if (data) {
                        const table = document.createElement('table');
                        table.border = '1';

                        // header tabel
                        const headerRow = table.insertRow(0);
                        for (const key in data) {
                            const headerCell = document.createElement('th');
                            headerCell.innerHTML = key;
                            headerRow.appendChild(headerCell);
                        }

                        // Menambahkan data transaksi ke dalam tabel
                        const row = table.insertRow(1);
                        for (const key in data) {
                            const cell = row.insertCell();
                            cell.innerHTML = data[key];
                        }

                        transactionTable.appendChild(table);

                        document.getElementById("backButton").style.display = "block";
                    } else {
                        transactionTable.innerHTML = 'Data tidak ditemukan';
                        document.getElementById("backButton").style.display = "none";
                    }
                })
                .catch(error => {
                    console.error("Terjadi kesalahan:", error);
                });
        });
    </script>
</body>
</html>
