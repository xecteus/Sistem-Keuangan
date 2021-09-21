<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan2')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('pesan2'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb; ?></li>
</ul>
<br>

<div class="d-flex justify-content-end mb-3">
    <!-- <a href="/piutang/create" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Piutang</span>
    </a> -->
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Piutang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Piutang</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Jatuh Tempo</th>
                        <th>Telah Dibayar</th>
                        <th>Sisa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Piutang</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Jatuh Tempo</th>
                        <th>Telah Dibayar</th>
                        <th>Sisa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($piutang as $p) : ?>
                        <tr>
                            <td><?= $p['kode_piutang']; ?></td>
                            <td><?= $p['kategori']; ?></td>
                            <td><?= $p['keterangan']; ?></td>
                            <td>Rp <?= number_format($p['jumlah'], 0, ',', '.'); ?></td>
                            <td><?= $p['tanggal2']; ?></td>
                            <td>Rp <?= number_format($p['dibayar'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($p['sisa'], 0, ',', '.'); ?></td>
                            <td><?= $p['status']; ?></td>
                            <td>
                                <a href="#" class="edit far fa-money-bill-alt mr-2" style="color:green; text-decoration:none" data-toggle="editModal" data-id="<?= $p['kode_piutang'] ?>" data-kodetrans="<?= $p['kode_trans'] ?>" data-tanggal="<?= $p['tanggal2']; ?>" data-keterangan="<?= $p['keterangan']; ?>" data-jumlah="<?= $p['jumlah'] ?>" data-dibayar="<?= $p['dibayar'] ?>" data-sisa="<?= $p['sisa'] ?>" data-status="<?= $p['status']; ?>"></a>
                                <a href="#" class="edit2 fas fa-pen mr-2" style="color:orange; text-decoration:none" data-toggle="editModal" data-id="<?= $p['kode_piutang'] ?>" data-kodetrans="<?= $p['kode_trans'] ?>" data-tanggal="<?= $p['tanggal2']; ?>" data-keterangan="<?= $p['keterangan']; ?>" data-jumlah="<?= $p['jumlah'] ?>" data-dibayar="<?= $p['dibayar'] ?>" data-sisa="<?= $p['sisa'] ?>" data-status="<?= $p['status']; ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Bayar Piutang-->
<form action="/piutang/bayarPiutang" method="post">

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar Piutang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kode piutang</label>
                        <input type="text" class="form-control kode_piutang" name="kode_piutang" readonly>
                    </div>

                    <input type="hidden" class="form-control kode_trans" name="kode_trans" readonly>

                    <div class="form-group">
                        <label>Tanggal Jatuh Tempo</label>
                        <input class="form-control tanggal" type="date" value="" name='tanggal' readonly>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control keterangan" name="keterangan" readonly>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control jumlah" name="jumlah" readonly>
                    </div>

                    <div class="form-group">
                        <label>Bayar</label>
                        <input type="text" class="form-control bayar" name='bayar'>
                    </div>

                    <input type="hidden" name="dibayar" class="dibayar">
                    <input type="hidden" name="sisa2" class="sisa2">
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="kode_piutang" class="kode_piutang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<form action="/piutang/update" method="post">

    <div class="modal fade" id="edit2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Piutang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Kode Hutang</label>
                        <input type="text" class="form-control kode_piutang" name="kode_piutang" readonly>
                    </div>

                    <input type="hidden" class="form-control kode_trans" name="kode_trans" readonly>

                    <div class="form-group">
                        <label>Tanggal Jatuh Tempo</label>
                        <input class="form-control tanggal" type="date" value="" name='tanggal'>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control keterangan" name="keterangan" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="kode_hutang" class="kode_hutang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Delete Product
<form action="/piutang/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete piutang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h6>Anda yakin ingin menghapus piutang ?</h6>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kode_piutang" class="kode_piutang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form> -->
<!-- End Modal Delete Product-->

<script src="<?= base_url(); ?>/sbadmin/js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {

        // get Edit Product
        $('.edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const kodetrans = $(this).data('kodetrans');
            const tanggal = $(this).data('tanggal')
            const keterangan = $(this).data('keterangan')
            const jumlah = $(this).data('jumlah')
            const dibayar = $(this).data('dibayar')
            const sisa = $(this).data('sisa')
            // Set data to Form Edit
            $('.kode_piutang').val(id);
            $('.kode_trans').val(kodetrans);
            $('.tanggal').val(tanggal);
            $('.keterangan').val(keterangan);
            $('.jumlah').val(sisa);
            $('.dibayar').val(dibayar);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Edit Product
        $('.edit2').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const kodetrans = $(this).data('kodetrans');
            const tanggal = $(this).data('tanggal')
            const keterangan = $(this).data('keterangan')
            const jumlah = $(this).data('jumlah')
            const dibayar = $(this).data('dibayar')
            const sisa = $(this).data('sisa')
            // Set data to Form Edit
            $('.kode_piutang').val(id);
            $('.kode_trans').val(kodetrans);
            $('.tanggal').val(tanggal);
            $('.keterangan').val(keterangan);
            $('.jumlah').val(sisa);
            $('.dibayar').val(dibayar);
            // Call Modal Edit
            $('#edit2Modal').modal('show');
        });

        // get Delete Product
        $('.delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.kode_piutang').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

        //Mengurangi dibayar dengan jumlah bayar
        $('.bayar').on('change', function() {
            // Set data to Form Edit
            let jumlah2 = $('.jumlah').val();
            let bayar2 = $('.bayar').val();
            let sisa = jumlah2 - bayar2;
            $('.sisa2').val(sisa);
        });

    });
</script>
<?= $this->endsection(); ?>