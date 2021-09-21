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
    <a href="/supplier/create" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Supplier</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Supplier</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID Supplier</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($supplier as $s) : ?>
                        <tr>
                            <td><?= $s['id_supplier']; ?></td>
                            <td><?= $s['nama']; ?></td>
                            <td><?= $s['nohp']; ?></td>
                            <td><?= $s['alamat']; ?></td>
                            <td>
                                <a href="#" class="edit fas fa-pen mr-2" style="color:orange; text-decoration:none" data-toggle="editModal" data-id="<?= $s['id_supplier'] ?>" data-nama="<?= $s['nama']; ?>" data-nohp="<?= $s['nohp']; ?>" data-alamat="<?= $s['alamat'] ?>"></a>
                                <a href="#" class="delete fas fa-trash" style="color:red; text-decoration:none" data-toggle="deleteModal" data-id="<?= $s['id_supplier'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Product-->
<form action="/supplier/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>ID Supplier</label>
                        <input type="text" class="form-control idSupplier" name="idSupplier" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" class="form-control namaSupplier" name="namaSupplier">
                    </div>

                    <div class="form-group">
                        <label>Nomor HP</label>
                        <input type="text" class="form-control noHP" name="noHP">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name='alamat'>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idSupplier" class="idSupplier">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="/supplier/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h6>Anda yakin ingin menghapus data supplier ?</h6>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idSupplier" class="idSupplier">
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
            const nohp = $(this).data('nohp');
            const alamat = $(this).data('alamat')
            // Set data to Form Edit
            $('.idSupplier').val(id);
            $('.namaSupplier').val(nama);
            $('.noHP').val(nohp);
            $('.alamat').val(alamat);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.idSupplier').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>
<?= $this->endsection(); ?>