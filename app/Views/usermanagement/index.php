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
    <a href="/user/create" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah User</span>
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <td><?= $u['username']; ?></td>
                            <td><?= $u['password']; ?></td>
                            <td><?= $u['nama']; ?></td>
                            <td><?= $u['level']; ?></td>
                            <td>
                                <a href="#" class="edit fas fa-pen mr-2" style="color:orange; text-decoration:none" data-toggle="editModal" data-id="<?= $u['username'] ?>" data-password="<?= $u['password']; ?>" data-nama="<?= $u['nama']; ?>" data-level="<?= $u['level'] ?>"></a>
                                <a href="#" class="delete fas fa-trash" style="color:red; text-decoration:none" data-toggle="deleteModal" data-id="<?= $u['username'] ?>"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Product-->
<form action="/user/update" method="post">
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
                        <label>Username</label>
                        <input type="text" class="form-control username" name="username" readonly>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control password" name="password">
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control namaUser" name="namaUser">
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control level" name="level">
                            <option>Admin</option>
                            <option>Sales</option>
                            <option>Warehousing</option>
                            <option>Purchasing</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="username" class="username">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal Delete Product-->
<form action="/user/delete" method="post">
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

                    <h6>Anda yakin ingin menghapus data user ?</h6>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="username" class="username">
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
            const password = $(this).data('password');
            const nama = $(this).data('nama');
            const level = $(this).data('level')
            // Set data to Form Edit
            $('.username').val(id);
            $('.password').val(password);
            $('.namaUser').val(nama);
            $('.level').val(level);
            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('.delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.username').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>
<?= $this->endsection(); ?>