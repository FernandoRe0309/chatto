<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4">Mi Perfil</h3>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre:</label>
                    <p class="form-control-plaintext"><?= esc($usuario['nombre']) ?></p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Correo:</label>
                    <p class="form-control-plaintext"><?= esc($usuario['email']) ?></p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Miembro desde:</label>
                    <p class="form-control-plaintext"><?= date('d/m/Y', strtotime($usuario['created_at'])) ?></p>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <a href="/usuarios" class="btn btn-primary">
                        Ir a Chats
                    </a>
                    <a href="/grupos" class="btn btn-secondary">
                        Mis Grupos
                    </a>
                    <a href="/logout" class="btn btn-danger">
                        Cerrar Sesion
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
