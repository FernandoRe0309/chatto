<?= view('layout/header') ?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4">Crear cuenta</h3>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="/guardar-registro" id="formRegistro">
                    <div class="mb-3">
                        <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            placeholder="Nombre"
                            required>
                    </div>
                    <div class="mb-3">
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Correo"
                            required>
                    </div>
                    <div class="mb-3">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Contraseña"
                            required>
                        <div id="errorEspacios" class="text-danger small mt-1" style="display:none;">
                            ❌ La contraseña no puede contener espacios.
                        </div>
                    </div>
                    <div class="mb-3">
                        <input
                            type="password"
                            name="password_confirm"
                            id="password_confirm"
                            class="form-control"
                            placeholder="Confirmar contraseña"
                            required>
                        <div id="errorCoincide" class="text-danger small mt-1" style="display:none;">
                            ❌ Las contraseñas no coinciden.
                        </div>
                        <div id="okCoincide" class="text-success small mt-1" style="display:none;">
                            ✅ Las contraseñas coinciden.
                        </div>
                    </div>
                    <button class="btn btn-success w-100" id="btnRegistrar">
                        Registrarse
                    </button>
                </form>
                <hr>
                <a href="/login" class="btn btn-primary w-100">
                    Ir al login
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const password        = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirm');
    const errorEspacios   = document.getElementById('errorEspacios');
    const errorCoincide   = document.getElementById('errorCoincide');
    const okCoincide      = document.getElementById('okCoincide');
    const form            = document.getElementById('formRegistro');

    // Validar que no haya espacios mientras escribe
    password.addEventListener('input', () => {
        if (password.value.includes(' ')) {
            password.value = password.value.replace(/ /g, '');
            errorEspacios.style.display = 'block';
        } else {
            errorEspacios.style.display = 'none';
        }
        validarCoincidencia();
    });

    // Validar que las contraseñas coincidan
    passwordConfirm.addEventListener('input', validarCoincidencia);

    function validarCoincidencia() {
        if (passwordConfirm.value === '') {
            errorCoincide.style.display = 'none';
            okCoincide.style.display    = 'none';
            return;
        }
        if (password.value !== passwordConfirm.value) {
            errorCoincide.style.display = 'block';
            okCoincide.style.display    = 'none';
        } else {
            errorCoincide.style.display = 'none';
            okCoincide.style.display    = 'block';
        }
    }

    // Bloquear envío si hay errores
    form.addEventListener('submit', (e) => {
        if (password.value.includes(' ')) {
            e.preventDefault();
            errorEspacios.style.display = 'block';
            return;
        }
        if (password.value !== passwordConfirm.value) {
            e.preventDefault();
            errorCoincide.style.display = 'block';
            return;
        }
    });
</script>

<?= view('layout/footer') ?>