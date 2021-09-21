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

<div class="row">
    <div class="col-sm-12">
        <div class="form-row">
            <div class="form-group col-md">
                <div class="input-group mb-2">
                    <div class="col-sm">
                        <a href="/jadwal/jadwalselesai" class="btn btn-primary">Data Jadwal Selesai</a>
                    </div>
                    <a href="/jadwal/create" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Jadwal</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jadwal Kedatangan Supplier</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>No HP</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Kedatangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>No. HP</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Kedatangan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($jadwal as $j) : ?>
                        <tr>
                            <td><?= $j['namaSupp']; ?></td>
                            <td><?= $j['noHP']; ?></td>
                            <td><?= $j['nama_barang']; ?></td>
                            <td><?= $j['tanggal']; ?></td>
                            <td>
                                <a href="#" class="sampai fas fa-box-open mr-2" style="color:green; text-decoration:none" data-toggle="editModal" data-kodejadwal="<?= $j['kode_jadwal'] ?>" data-idbarang="<?= $j['id_barang'] ?>" data-namabrg="<?= $j['nama_barang'] ?>" data-tanggal="<?= $j['tanggal'] ?>"></a>
                                <a href="#" class="edit fas fa-pen mr-2" style="color:orange; text-decoration:none" data-toggle="editModal" data-kodejadwal="<?= $j['kode_jadwal'] ?>" data-idbarang="<?= $j['id_barang'] ?>" data-namabrg="<?= $j['nama_barang'] ?>" data-tanggal="<?= $j['tanggal'] ?>"></a>
                                <a href="#" class="delete fas fa-trash" style="color:red; text-decoration:none" data-toggle="deleteModal" data-kodejadwal="<?= $j['kode_jadwal'] ?>" data-idbarang="<?= $j['id_barang'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Product-->
<form action="/jadwal/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control namabrg" name="namabrg" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kedatangan</label>
                        <input type="date" class="form-control tanggal" name="tanggal">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control kodejadwal" name="kodejadwal" readonly>
                    <input type="hidden" class="form-control idbarang" name="idbarang" readonly>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="/jadwal/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h6>Anda yakin ingin menghapus jadwal ?</h6>

                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control kodejadwal" name="kodejadwal">
                    <input type="hidden" class="form-control idbarang" name="idbarang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<!-- Modal Sampai Product-->
<form action="/jadwal/delivered" method="post">
    <div class="modal fade" id="sampaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Penerimaan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control namabrg" name="namabrg" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kedatangan</label>
                        <input type="date" class="form-control tanggal" name="tanggal" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control kodejadwal" name="kodejadwal" readonly>
                    <input type="hidden" class="form-control idbarang" name="idbarang" readonly>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Barang Diterima</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="<?= base_url(); ?>/sbadmin/js/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {

        // get sampai Product
        $('.sampai').on('click', function() {
            // get data from button sampai
            const kodejadwal = $(this).data('kodejadwal');
            const idbarang = $(this).data('idbarang');
            const namabrg = $(this).data('namabrg');
            const tanggal = $(this).data('tanggal')
            // Set data to Form sampai
            $('.kodejadwal').val(kodejadwal);
            $('.idbarang').val(idbarang);
            $('.namabrg').val(namabrg);
            $('.tanggal').val(tanggal);
            // Call Modal sampai

            $('#sampaiModal').modal('show');
        });

        // get Edit Product
        $('.edit').on('click', function() {
            // get data from button edit
            const kodejadwal = $(this).data('kodejadwal');
            const idbarang = $(this).data('idbarang');
            const namabrg = $(this).data('namabrg');
            const tanggal = $(this).data('tanggal')
            // Set data to Form Edit
            $('.kodejadwal').val(kodejadwal);
            $('.idbarang').val(idbarang);
            $('.namabrg').val(namabrg);
            $('.tanggal').val(tanggal);
            // Call Modal Edit

            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.delete').on('click', function() {
            // get data from button edit
            const kodejadwal = $(this).data('kodejadwal');
            const idbarang = $(this).data('idbarang');
            // Set data to Form Edit
            $('.kodejadwal').val(kodejadwal);
            $('.idbarang').val(idbarang);

            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>
<?= $this->endsection(); ?>