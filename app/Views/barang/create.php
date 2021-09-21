<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/barang"><?= $breadcrumb; ?></a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb2; ?></li>
</ul>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
    </div>
    <div class="card-body">
        <form action=/barang/save method="post">

            <div class="form-group row">
                <label for="idBarang" class="col-sm-2 col-form-label">ID Barang</label>
                <div class="col-sm-2">
                    <input type="text" value=<?= $kodeBarang; ?> class="form-control" id="idBarang" name="idBarang" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control <?= ($validation->hasError('namaBarang')) ? 'is-invalid' : '' ?>" id="namaBarang" name="namaBarang">
                    <div class="invalid-feedback">
                        <?= $validation->getError('namaBarang'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Habis</label>
                <div class="col-sm-3">
                    <input class="form-control" type="date" value="<?php echo $tanggal; ?>" id="tanggal" name="tanggal">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-success btn-block">Tambah</button>
        </form>
    </div>
</div>

<?= $this->endsection(); ?>