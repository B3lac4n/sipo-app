<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Profil Saya</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-4">
        <div class="card card-outline card-success">
          <div class="card-body box-profile">
            <div class="text-center">
              <img src="<?= base_url() ?>/public/assets/img/user.png" class="profile-user-img img-fluid img-circle" alt="User profile picture">
            </div>

            <h3 class="profile-username pt-3 text-center text-uppercase"><?= $pengguna->fullname ?></h3>

            <p class="text-muted text-center text-uppercase"><?= $pengguna->name ?></p>

            <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success'); ?>
              </div>
            <?php endif; ?>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Username</b> <a class="float-right"><?= $pengguna->username ?></a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?= $pengguna->email ?></a>
              </li>
            </ul>

            <button type="button" data-id="<?= $pengguna->id ?>" class="btn btn-block btn-success ganti-pw" data-toggle="modal" data-target="#modal-ganti-pw">
               Ganti Password
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal Ganti Password -->
<div class="modal fade" id="modal-ganti-pw">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ganti Kata Sandi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form action="<?=base_url() ?>/pengguna/password" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">

          <input type="hidden" name="id" id="id_pengguna">

          <div class="form-group">
              <label for="password"><?=lang('Auth.password')?></label>
              <input type="password" name="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : null ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
              <div class="invalid-feedback">
                <?= $validation->getError('password') ?>
              </div>
          </div>

          <div class="form-group">
              <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
              <input type="password" name="pass_confirm" class="form-control <?= $validation->hasError('pass_confirm') ? 'is-invalid' : null ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
              <div class="invalid-feedback">
                <?= $validation->getError('pass_confirm') ?>
              </div>
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Ganti</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(function () {
    $("#obat").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
    });
  })

  document.addEventListener('DOMContentLoaded', () => {
      btnGanti = document.querySelectorAll('.ganti-pw');

      btnGanti.forEach(btn => {
        btn.addEventListener('click', () => {
          inputId = document.getElementById('id_pengguna');

          inputId.value = btn.getAttribute('data-id');
        });
      });

      // show modal jika ada validation error
      <?php if ($validation->getErrors()) : ?>
            $('#modal-ganti-pw').modal('toggle');
      <?php endif; ?>
  });
</script>
<?= $this->endSection() ?>