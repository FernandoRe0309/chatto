<?= view('layout/header') ?>

<div class="container mt-4">

<h3>Crear grupo</h3>

<form method="post" action="/grupos/guardar">

<input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre del grupo">

<button class="btn btn-success">Crear</button>

</form>

</div>

<?= view('layout/footer') ?>
