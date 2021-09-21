<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($pemasukanHarian as $ph) : ?>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pemasukan (Hari Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($ph['jumlah_pemasukan'], 0, ',', '.'); ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($pemasukanBulanan as $pb) : ?>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pemasukan (Bulan Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($pb['jumlah_pemasukan'], 0, ',', '.'); ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($pengeluaranHarian as $ph) : ?>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pengeluaran (Hari Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($ph['jumlah_pengeluaran'], 0, ',', '.'); ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($pengeluaranBulanan as $pb) : ?>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pengeluaran (Bulan Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($pb['jumlah_pengeluaran'], 0, ',', '.'); ?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>