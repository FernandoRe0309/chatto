<?= view('layout/header') ?>

<div class="container mt-4">

    <h3>💬 Chat del grupo</h3>

    <a href="/grupos" class="btn btn-secondary btn-sm mb-3">
        ← Volver a grupos
    </a>

    <hr>

    <!-- MENSAJES -->
    <div class="border rounded p-3 mb-3 bg-light"
         style="height:350px; overflow-y:auto;">

        <?php if(empty($mensajes)): ?>
            <p class="text-muted">No hay mensajes aún...</p>
        <?php endif; ?>

        <?php foreach($mensajes as $m): ?>

            <div class="mb-2">

                <strong>
                    <?= ($m['remitente_id'] == session()->get('usuario_id')) 
                        ? 'Yo' 
                        : 'Usuario ' . $m['remitente_id'] ?>
                </strong>

                <div class="bg-white p-2 rounded shadow-sm">
                    <?= esc($m['mensaje']) ?>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- FORMULARIO -->
    <form method="post" action="/grupo/enviar">

        <input type="hidden" name="grupo_id" value="<?= $grupo_id ?>">

        <div class="input-group">

            <input type="text"
                   name="mensaje"
                   class="form-control"
                   placeholder="Escribe un mensaje..."
                   required>

            <button class="btn btn-primary">
                Enviar
            </button>

        </div>

    </form>

</div>

<?= view('layout/footer') ?>
