<?= view('layout/header') ?>

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card shadow">

<div class="card-body">

<h3 class="text-center mb-4">Iniciar sesión</h3>

<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger">
<?= session()->getFlashdata('error') ?>
</div>

<?php endif; ?>

<form method="post" action="/validar-login">
    
    <hr>

<h5>O inicia con rostro</h5>

<video id="video" width="320" height="240" autoplay></video>

<br><br>

<button type="button" onclick="loginRostro()" class="btn btn-dark">
Iniciar con rostro
</button>


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
class="form-control" 
placeholder="Contraseña"
required>
</div>

<button class="btn btn-primary w-100">
Ingresar
</button>


<a href="/login_facial">
    <button type="button">Iniciar con rostro</button>
</a>



</form>

<hr>

<a href="/registro" class="btn btn-success w-100">
Crear cuenta
</a>

</div>
</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

<script>

async function iniciarCamara() {

    await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
    await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
    await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

    navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        document.getElementById('video').srcObject = stream;
    });
}

iniciarCamara();

async function loginRostro() {

    const video = document.getElementById('video');

    const detections = await faceapi
        .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceDescriptor();

    if (!detections) {
        alert("No se detectó rostro");
        return;
    }

    const descriptor = Array.from(detections.descriptor);

    fetch('/auth/loginRostro', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ face: descriptor })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location = "/usuarios";
        } else {
            alert("Rostro no reconocido");
        }
    });
}

</script>


<?= view('layout/footer') ?>
