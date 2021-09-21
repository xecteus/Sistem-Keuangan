<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/supplier"><?= $breadcrumb; ?></a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb2; ?></li>
</ul>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Supplier</h6>
    </div>
    <div class="card-body">
        <form action=/supplier/save method="post">

            <div class="form-group row">
                <label for="idSupplier" class="col-sm-2 col-form-label">ID Supplier</label>
                <div class="col-sm-2">
                    <input type="text" value=<?= $kodeSupplier; ?> class="form-control" id="idSupplier" name="idSupplier" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="namaSupplier" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control <?= ($validation->hasError('namaSupplier')) ? 'is-invalid' : ''; ?>" id="namaSupplier" name="namaSupplier" value="<?= old('namaSupplier'); ?>">
                    <div class="invalid-feedback">
                        <?php $validation->getError('namaSupplier') ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="noHp" class="col-sm-2 col-form-label">No. HP</label>
                <div class="col-sm-4">
                    <input type="number" min="0" class="form-control <?= ($validation->hasError('noHp')) ? 'is-invalid' : ''; ?>" id="noHp" name="noHp" value="<?= old('noHp'); ?>">
                    <div class="invalid-feedback">
                        <?php $validation->getError('noHp') ?>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" value="<?= old('alamat'); ?>">
                    <div class="invalid-feedback">
                        <?php $validation->getError('alamat') ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-success btn-block">Tambah</button>
        </form>
    </div>
</div>

<?= $this->endsection(); ?>