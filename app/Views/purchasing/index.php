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

<form action="/purchasing/caritanggal" method="post">
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
                        <div class="col-sm">
                            <a href="/purchasing" class="btn btn-secondary">Refresh</a>
                        </div>
                        <a href="/purchasing/create" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Pembelian</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Pembelian</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Transaksi</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($pembelian as $p) : ?>
                        <tr>
                            <td><?= $p['kode_trans']; ?></td>
                            <td><?= $p['kategori']; ?></td>
                            <td><?= $p['keterangan']; ?></td>
                            <td>Rp <?= number_format($p['jumlah'], 0, ',', '.'); ?></td>
                            <td><?= $p['metode']; ?></td>
                            <td><?= $p['tanggal']; ?></td>
                            <td>
                                <!--<a href="#" class="edit fas fa-pen mr-2" style="color:orange; text-decoration:none" data-toggle="editModal" data-id="<?= $p['kode_trans'] ?>" data-kategori="<?= $p['kategori']; ?>" data-keterangan="<?= $p['keterangan']; ?>" data-jumlah="<?= $p['jumlah'] ?>" data-metode="<?= $p['metode']; ?>" data-tanggal="<?= $p['tanggal']; ?>"></a>-->
                                <a href="#" class="print fas fa-print" style="color:blue; text-decoration:none" data-toggle="printModal" data-id="<?= $p['kode_trans'] ?>" data-metode="<?= $p['metode'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Print Product-->
<form action="/purchasing/invoice" method="post">
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
                    <input type="hidden" name="kode_trans" class="kode_trans">
                    <input type="hidden" name="metode" class="metode">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script src="<?= base_url(); ?>/sbadmin/js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {

        // get Print Product
        $('.print').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const metode = $(this).data('metode');
            // Set data to Form Edit
            $('.kode_trans').val(id);
            $('.metode').val(metode);
            // Call Modal Edit
            $('#printModal').modal('show');
        });

    });
</script>
<?= $this->endsection(); ?>