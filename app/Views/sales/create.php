<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/sales"><?= $breadcrumb; ?></a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb2; ?></li>
</ul>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Transaksi Penjualan</h6>
    </div>
    <div class="card-body">
        <form action="/sales/save" method="post">
            <?= csrf_field(); ?>
            <div class="form-group row">
                <label for="kode_trans" class="col-sm-2 col-form-label">Kode Transaksi</label>
                <div class="col-sm-2">
                    <input type="text" value=<?= $kodePenjualan; ?> class="form-control" id="kode_trans" name='kode_trans' readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-4">
                    <input type="text" value="Penjualan" class="form-control" id="kategori" name='kategori' readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-5">
                    <textarea class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : ''; ?>" rows="3" id="keterangan" name='keterangan'></textarea>
                    <div class="invalid-feedback">
                        <?php $validation->getError('keterangan') ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="jumlah" class="col-sm-2 col-form-label">Nominal</label>
                <div class="input-group col-sm-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" min="1" class=" form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : '' ?>" aria-label="Amount (to the nearest dollar)" id="jumlah" name='jumlah' value="<?= old('jumlah'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-3">
                    <input class="form-control" type="date" value="<?php echo $tanggal; ?>" id="tanggal" name='tanggal'>
                </div>
            </div>

            <div class="form-group row">
                <label for="metode_pembayaran" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                <div class="col-sm-4">
                    <select class="form-control" id="metode_pembayaran" name='metode_pembayaran' onchange="changeFunc()">
                        <option value="Lunas">Lunas</option>
                        <option value="Hutang">Hutang</option>
                    </select>
                </div>
            </div>

            <div class="form-group row" id="tanggal_hidden" name='tanggal_hidden' style="display: none">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Jatuh Tempo</label>
                <div class="col-sm-3">
                    <input class="form-control" type="date" value="" id="tanggal_tempo" name='tanggal_tempo'>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-success btn-block">Tambah</button>
        </form>
    </div>
</div>

<script src="<?= base_url(); ?>/sbadmin/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    function changeFunc() {
        var selectBox = document.getElementById("metode_pembayaran");
        var selected_option = $('#metode_pembayaran').val();
        if (selected_option == 'Hutang') {
            $('#tanggal_hidden').show();
        }
        if (selected_option != 'Hutang') {
            $('#tanggal_hidden').hide();
        }
    }
</script>

<?= $this->endsection(); ?>