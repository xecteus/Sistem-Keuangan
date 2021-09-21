<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
        }

        @media print {
            #printPageButton {
                display: none;
            }
        }

        button {
            background-color: #e7e7e7;
            color: black;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div style="font-size:64px; color:'#dddddd' ">Invoice Penjualan</div>
    <p>
        <i style="font-size:20px; font-weight: bold; color:'#dddddd'">Maju Jaya</i><br>
        Jl. Palagan Tentara Pelajar No.112, Waras, Sariharjo, Kec. Ngaglik,<br>
        Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581 <br>
        Nomor Telepon : (0274) 865349
    </p>
    <hr>
    <?php foreach ($penjualan as $p) : ?>
        <p>
            Nomor Invoice : <?= $p['kode_trans'] ?>
            <br>
            Tanggal Transaksi : <?= $p['tanggal'] ?>
            <br>
            Metode Pembayaran : <?= $p['metode'] ?>
            <br>
            <?php
            $db = \Config\Database::connect();
            $kode_trans = $p['kode_trans'];
            if ($metode == 'Hutang') {
                $query2 = $db->query(
                    "SELECT piutang.tanggal AS tanggal2
                FROM piutang JOIN penjualan 
                ON piutang.kode_trans = penjualan.kode_trans WHERE penjualan.kode_trans = '$kode_trans'"
                );
                $row = $query2->getRow();
                echo "Tanggal Jatuh Tempo : ";
                echo $row->tanggal2;
            }
            ?>
        </p>
        <button id="printPageButton" class="" onclick="window.print()">Cetak</button>

        <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center;">Keterangan</th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;"><?= $p['keterangan'] ?></td>
                        <td style="text-align: center;">Rp <?= number_format($p['jumlah'], 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <th colspan="1" style="text-align: center;">TOTAL</th>
                    <th style="text-align: center;">Rp <?= number_format($p['jumlah'], 0, ',', '.'); ?></th>
                </tfoot>
            </table>
        </div>
    <?php endforeach; ?>
    <br>
</body>

</html>