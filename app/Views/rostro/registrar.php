<?= view('layout/header') ?>

<div class="container mt-4">

<h3>Registrar rostro</h3>

<video id="video" width="320" height="240" autoplay></video>

<br><br>

<button class="btn btn-success" onclick="registrarRostro()">
Guardar rostro
</button>

</div>

<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

<script>

async function iniciar() {
    await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
    await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
    await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

    navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        document.getElementById('video').srcObject = stream;
    });
}

iniciar();

async function registrarRostro() {

    const video = document.getElementById('video');

    const detections = await faceapi
        .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceDescriptor();

    if (!detections) {
        alert("No se detectó rostro");
        return;
    }

    const descriptor = Array.from(detections.descriptor);

    fetch('/auth/guardarRostro', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ face: descriptor })
    })
    .then(() => alert("Rostro guardado"));
}

</script>

<?= view('layout/footer') ?>
