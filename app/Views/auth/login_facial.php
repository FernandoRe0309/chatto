<!DOCTYPE html>
<html>
<head>
    <title>Login Facial</title>
</head>
<body>

<h2>Login con reconocimiento facial</h2>

<video id="video" width="400" autoplay></video>
<br><br>

<button onclick="loginFacial()">Iniciar con rostro</button>
<br><br>

<a href="/login">Volver al login normal</a>

<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

<script>
const video = document.getElementById('video');

// Activar cámara
navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    video.srcObject = stream;
});

// Cargar modelos
Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/models')
]);

async function loginFacial() {
    const detections = await faceapi
        .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceDescriptor();

    if (!detections) {
        alert("No se detectó rostro");
        return;
    }

    const descriptor = Array.from(detections.descriptor);

    fetch('/auth/loginFacial', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ face: descriptor })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'ok') {
            window.location.href = '/chat';
        } else {
            alert("Rostro no reconocido");
        }
    });
}
</script>

</body>
</html>
