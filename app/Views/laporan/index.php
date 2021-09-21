<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb; ?></li>
</ul>
<br>

<form action="/laporan/caritanggal" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-row">

                <div class="form-group col-md">
                    <div class="input-group mb-2">
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tanggalawal" name="tanggalawal" value="<?php echo $tanggalawal; ?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tanggalakhir" name="tanggalakhir" value="<?php echo $tanggalakhir; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Cari">
</form>

<div class="col-sm">
    <a href="/laporan" class="btn btn-secondary">Refresh</a>
</div>
<a href="#" class="print btn btn-dark btn-icon-split" data-toggle="printModal" data-target=".bd-example-modal-xl" data-tanggalawal="<?= $tanggalawal; ?>" data-tanggalakhir="<?= $tanggalakhir; ?>">
    <span class="icon text-white-50">
        <i class="fas fa-print"></i>
    </span>
    <span class="text">Cetak</span>
</a>
</div>
</div>
</div>
</div>
</div>

<!-- Modal Print Product-->
<form action="/laporan/cetak" method="post">
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h6>Anda yakin ingin mencetak nota ?</h6>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tanggal_awal" class="tanggal_awal">
                    <input type="hidden" name="tanggal_akhir" class="tanggal_akhir">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal
<div class="modal fade bd-example-modal-xl" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pastikan bahwa : <br>
                <ul>
                    <li>Anda berada pada tanggal 1 bulan baru</li>
                    <li>Tidak ada penambahan transaksi pemasukan dan pengeluaran lagi pada bulan sebelumnya</li>
                    <li>Tidak ada perubahan pada transaksi pemasukan dan pengeluaran pada bulan sebelumnya</li>
                </ul>

                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label">Tanggal Sekarang</label>
                    <div class="col-sm-4">
                        <input type="date" value="" class="form-control" id="tanggalSkrg" name='tanggalSkrg' value="<?php echo $tanggalsekarang ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div> -->


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Arus Kas Pemasukan</h6>
    </div>
    <div class="card-body">
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
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Arus Kas Pengeluaran</h6>
    </div>
    <div class="card-body">
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
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laba / Rugi</h6>
    </div>
    <div class="card-body">
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
    </div>
</div>

<script src="<?= base_url(); ?>/sbadmin/js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {

        // get Print Product
        $('.print').on('click', function() {
            // get data from button edit
            const tanggalawal = $(this).data('tanggalawal');
            const tanggalakhir = $(this).data('tanggalakhir');
            // Set data to Form Edit
            $('.tanggal_awal').val(tanggalawal);
            $('.tanggal_akhir').val(tanggalakhir);
            // Call Modal Edit
            $('#printModal').modal('show');
        });

    });
</script>
<?= $this->endsection(); ?>