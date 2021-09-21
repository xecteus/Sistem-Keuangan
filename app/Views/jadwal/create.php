<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/jadwal"><?= $breadcrumb; ?></a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb2; ?></li>
</ul>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Jadwal Supplier</h6>
    </div>
    <div class="card-body">
        <form action="/jadwal/save" method="post">

            <div class="form-group row">
                <label for="kodeJadwal" class="col-sm-2 col-form-label">Kode Jadwal</label>
                <div class="col-sm-2">
                    <input type="text" value=<?= $kodeJadwal; ?> class="form-control" id="kodeJadwal" name="kodeJadwal" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="noHp" class="col-sm-2 col-form-label">ID Barang</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id_barang" name="id_barang" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="noHp" class="col-sm-2 col-form-label">ID Supplier</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="id_supplier" name="id_supplier" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-2">
                    <select onchange="optBrg()" class="form-control <?= ($validation->hasError('namaBrg')) ? 'is-invalid' : ''; ?>" id="namaBrg" name="namaBrg">
                        <option selected disabled value="">-Pilih Barang-</option>
                        <?php foreach ($brg as $b) : ?>
                            <option value=<?= $b['id_barang']; ?>>
                                <?= $b['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Nama Supplier</label>
                <div class="col-sm-2">
                    <select onchange="optSupp()" class="form-control <?= ($validation->hasError('namaSupp')) ? 'is-invalid' : ''; ?>" id="namaSupp" name="namaSupp">
                        <option selected disabled value="">-Pilih Supplier-</option>
                        <?php foreach ($sup as $s) : ?>
                            <option value=<?= $s['id_supplier']; ?>>
                                <?= $s['nama']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Kedatangan</label>
                <div class="col-sm-3">
                    <input class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" type="date" value="" id="tanggal" name="tanggal">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-success btn-block">Tambah</button>
        </form>
    </div>
</div>

<?= $this->endsection(); ?>