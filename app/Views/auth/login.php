<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesion - Chatto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0a0b;
            --bg-secondary: #111113;
            --bg-tertiary: #18181b;
            --bg-hover: #27272a;
            --border-color: #27272a;
            --text-primary: #fafafa;
            --text-secondary: #a1a1aa;
            --text-muted: #71717a;
            --accent: #3b82f6;
            --accent-hover: #2563eb;
            --success: #22c55e;
            --danger: #ef4444;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .auth-wrapper {
            width: 100%;
            max-width: 420px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }
        
        .logo svg {
            width: 40px;
            height: 40px;
            color: var(--accent);
        }
        
        .logo span {
            font-size: 1.75rem;
            font-weight: 700;
        }
        
        .card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            padding: 2rem;
        }
        
        .card-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .card-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .card-header p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-family: inherit;
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            color: var(--text-primary);
            transition: all 0.2s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: inherit;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-primary {
            background: var(--accent);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: var(--bg-tertiary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }
        
        .btn-secondary:hover {
            background: var(--bg-hover);
        }
        
        .btn-dark {
            background: var(--bg-tertiary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }
        
        .btn-dark:hover {
            background: var(--bg-hover);
        }
        
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }
        
        .alert {
            padding: 0.875rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        
        .face-login-section {
            background: var(--bg-tertiary);
            border-radius: 0.75rem;
            padding: 1.25rem;
            text-align: center;
        }
        
        .face-login-section h3 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .face-login-section h3 svg {
            width: 18px;
            height: 18px;
            color: var(--accent);
        }
        
        #video {
            width: 100%;
            max-width: 280px;
            height: auto;
            border-radius: 0.5rem;
            background: var(--bg-primary);
            margin-bottom: 1rem;
        }
        
        .footer-links {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }
        
        .footer-links a {
            color: var(--accent);
            text-decoration: none;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .mt-3 { margin-top: 1rem; }
        .mb-3 { margin-bottom: 1rem; }
        .text-center { text-align: center; }
        .text-sm { font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            <span>Chatto</span>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h1>Bienvenido de nuevo</h1>
                <p>Inicia sesion en tu cuenta para continuar</p>
            </div>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="/validar-login">
                <div class="form-group">
                    <label class="form-label">Correo electronico</label>
                    <input type="email" name="email" class="form-control" placeholder="tu@email.com" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Contrasena</label>
                    <input type="password" name="password" class="form-control" placeholder="Tu contrasena" required>
                </div>
                
                <div class="text-center mb-3">
                    <a href="/forgot" style="color: var(--accent); font-size: 0.875rem; text-decoration: none;">Olvidaste tu contrasena?</a>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    Iniciar sesion
                </button>
            </form>
            
            <div class="divider">o continua con</div>
            
            <div class="face-login-section">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18V5l12-2v13"/>
                        <circle cx="6" cy="18" r="3"/>
                        <circle cx="18" cy="16" r="3"/>
                    </svg>
                    Reconocimiento facial
                </h3>
                <video id="video" autoplay muted playsinline></video>
                <button type="button" onclick="loginRostro()" class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                        <line x1="12" y1="19" x2="12" y2="23"/>
                        <line x1="8" y1="23" x2="16" y2="23"/>
                    </svg>
                    Iniciar con rostro
                </button>
            </div>
            
            <div class="footer-links">
                No tienes cuenta? <a href="/registro">Crear cuenta</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
    <script>
        async function iniciarCamara() {
            try {
                await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
                await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
                await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
                
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                document.getElementById('video').srcObject = stream;
            } catch (err) {
                console.log('Camara no disponible:', err);
            }
        }
        
        iniciarCamara();
        
        async function loginRostro() {
            const video = document.getElementById('video');
            
            const detections = await faceapi
                .detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
                .withFaceDescriptor();
            
            if (!detections) {
                alert("No se detecto ningun rostro. Por favor, mira directamente a la camara.");
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
                    alert("Rostro no reconocido. Intenta de nuevo o usa tu contrasena.");
                }
            });
        }
    </script>
</body>
</html>
