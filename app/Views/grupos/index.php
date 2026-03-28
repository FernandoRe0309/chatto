<?= view('layout/header') ?>

<div class="container mt-4">

<h3>Grupos</h3>

<a href="/grupos/crear" class="btn btn-success mb-3">
➕ Crear grupo
</a>

<hr>

<?php if(empty($grupos)): ?>

<p>No hay grupos aún</p>

<?php else: ?>

<ul class="list-group">

<?php foreach($grupos as $g): ?>

<li class="list-group-item d-flex justify-content-between">

<?= esc($g['nombre']) ?>

<a href="/grupo_chat/<?= $g['id'] ?>" class="btn btn-primary btn-sm">
Entrar
</a>

</li>

<?php endforeach; ?>

</ul>

<?php endif; ?>

</div>

<?= view('layout/footer') ?>
