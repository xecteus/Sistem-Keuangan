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

<div class="d-flex justify-content-end mb-3">
    <a href="/barang/create" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Barang</span>
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tanggal Habis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tanggal Habis</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($barang as $b) : ?>
                        <tr>
                            <td><?= $b['nama']; ?></td>
                            <td><?= $b['status']; ?></td>
                            <td><?= $b['tanggal']; ?></td>
                            <td>
                                <a href="#" class="edit fas fa-pen mr-2" style="color:orange; text-decoration:none" data-toggle="editModal" data-id="<?= $b['id_barang'] ?>" data-nama="<?= $b['nama']; ?>" data-status="<?= $b['status']; ?>" data-tanggal="<?= $b['tanggal']; ?>"></a>
                                <a href="#" class="delete fas fa-trash" style="color:red; text-decoration:none" data-toggle="deleteModal" data-id="<?= $b['id_barang'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Product-->
<form action="/barang/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>ID Barang</label>
                        <input type="text" class="form-control id_barang" name="id_barang" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control nama" name="nama">
                    </div>

                    <div class="form-group">
                        <label>Tanggal Habis</label>
                        <input class="form-control tanggal" type="date" name="tanggal">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_barang" class="id_barang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="/barang/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h6>Anda yakin ingin menghapus barang ?</h6>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_barang" class="id_barang">
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

        // get Edit Product
        $('.edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const status = $(this).data('status');
            const tanggal = $(this).data('tanggal');
            // Set data to Form Edit
            $('.id_barang').val(id);
            $('.nama').val(nama);
            $('.status').val(status);
            $('.tanggal').val(tanggal);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.id_barang').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>
<?= $this->endsection(); ?>