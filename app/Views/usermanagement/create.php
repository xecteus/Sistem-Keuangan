<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $titlehead; ?></h1>
</div>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="/user"><?= $breadcrumb; ?></a></li>
    <li class="breadcrumb-item active"><?= $breadcrumb2; ?></li>
</ul>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
    </div>
    <div class="card-body">
        <form action="/user/save" method="post">

            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="username" name="username">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="password" name="password">
                </div>
            </div>

            <div class="form-group row">
                <label for="namaUser" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="namaUser" name="namaUser">
                </div>
            </div>

            <div class="form-group row">
                <label for="level" class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-2">
                    <select class="form-control" id="level" name="level">
                        <option>Admin</option>
                        <option>Sales</option>
                        <option>Warehousing</option>
                        <option>Purchasing</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-success btn-block">Tambah</button>
        </form>
    </div>
</div>
<?= $this->endsection(); ?>