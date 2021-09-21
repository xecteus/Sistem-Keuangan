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
    <div style="font-size:64px; color:'#dddddd'; text-align: center; ">Laporan Laba Rugi</div>
    <p style="font-size:20px; color:'#dddddd'; text-align: center;">
        <i style="font-size:24px; font-weight: bold; color:'#dddddd'; text-align: center;">Maju Jaya</i>
        <br><br>
        Periode
    <p style="font-size:16px; color:'#dddddd'; text-align: center;"><?php echo $tanggalawal ?> - <?php echo $tanggalakhir ?></p>
    </p>

    <center><button style="text-align: center;" id="printPageButton" class="" onclick="window.print()">Cetak</button></center>
    <hr>


    <h2 class="m-0 font-weight-bold text-primary">Arus Kas Pemasukan</h2>
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;">No.</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pemasukan as $pm) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $i++; ?></td>
                        <td style="text-align: center;"><?= $pm['kategori_pemasukan']; ?></td>
                        <td style="text-align: center;">Rp <?= number_format($pm['jumlah_pemasukan'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <?php foreach ($totalpemasukan as $tp) : ?>
                    <th colspan="2" style="text-align: center;">TOTAL PEMASUKAN</th>
                    <th style="text-align: center;">Rp <?= number_format($tp['jumlah_pemasukan'], 0, ',', '.'); ?></th>
                <?php endforeach; ?>
            </tfoot>
        </table>
    </div>


    <h2 class="m-0 font-weight-bold text-primary">Arus Kas Pengeluaran</h2>
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;">No.</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($pengeluaran as $pg) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $i++; ?></td>
                        <td style="text-align: center;"><?= $pg['kategori_pengeluaran']; ?></td>
                        <td style="text-align: center;">Rp <?= number_format($pg['jumlah_pengeluaran'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <?php foreach ($totalpengeluaran as $tp) : ?>
                    <th colspan="2" style="text-align: center;">TOTAL PENGELUARAN</th>
                    <th style="text-align: center;">Rp <?= number_format($tp['jumlah_pengeluaran'], 0, ',', '.'); ?></th>
                <?php endforeach; ?>
            </tfoot>
        </table>
    </div>

    <h2 class="m-0 font-weight-bold text-primary">Laba / Rugi</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;">No.</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($totalsemua as $t) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $i++; ?></td>
                        <td style="text-align: center;">Laba/Rugi </td>
                        <td style="text-align: center;"><?= $t['TotalSemua']; ?></td>
                    </tr>
            </tbody>
            <tfoot>
                <th colspan="2" style="text-align: center;">TOTAL LABA/RUGI</th>
                <th style="text-align: center;">Rp <?= number_format($t['TotalSemua'], 0, ',', '.'); ?></th>
            <?php endforeach; ?>
            </tfoot>
        </table>
    </div>
    <br>


</body>

</html>