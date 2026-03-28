<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Cuenta - Chatto</title>
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
        
        .form-control.error {
            border-color: var(--danger);
        }
        
        .form-control.success {
            border-color: var(--success);
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
        
        .form-feedback {
            font-size: 0.75rem;
            margin-top: 0.375rem;
        }
        
        .form-feedback.error {
            color: #fca5a5;
        }
        
        .form-feedback.success {
            color: #86efac;
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
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            background: var(--bg-tertiary);
            margin-top: 0.5rem;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s;
            border-radius: 2px;
        }
        
        .strength-weak { width: 33%; background: var(--danger); }
        .strength-medium { width: 66%; background: var(--warning, #f59e0b); }
        .strength-strong { width: 100%; background: var(--success); }
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
                <h1>Crear cuenta</h1>
                <p>Unete a Chatto y comienza a chatear</p>
            </div>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="/guardar-registro" id="formRegistro">
                <div class="form-group">
                    <label class="form-label">Nombre completo</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Tu nombre" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Correo electronico</label>
                    <input type="email" name="email" class="form-control" placeholder="tu@email.com" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Contrasena</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Minimo 6 caracteres" required>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                    <div id="errorEspacios" class="form-feedback error" style="display:none;">
                        La contrasena no puede contener espacios
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Confirmar contrasena</label>
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Repite tu contrasena" required>
                    <div id="errorCoincide" class="form-feedback error" style="display:none;">
                        Las contrasenas no coinciden
                    </div>
                    <div id="okCoincide" class="form-feedback success" style="display:none;">
                        Las contrasenas coinciden
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" id="btnRegistrar">
                    Crear cuenta
                </button>
            </form>
            
            <div class="footer-links">
                Ya tienes cuenta? <a href="/login">Iniciar sesion</a>
            </div>
        </div>
    </div>
    
    <script>
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirm');
        const errorEspacios = document.getElementById('errorEspacios');
        const errorCoincide = document.getElementById('errorCoincide');
        const okCoincide = document.getElementById('okCoincide');
        const form = document.getElementById('formRegistro');
        const strengthBar = document.getElementById('strengthBar');
        
        function checkStrength(pass) {
            let strength = 0;
            if (pass.length >= 6) strength++;
            if (pass.match(/[A-Z]/)) strength++;
            if (pass.match(/[0-9]/)) strength++;
            if (pass.match(/[^a-zA-Z0-9]/)) strength++;
            
            strengthBar.className = 'password-strength-bar';
            if (strength <= 1) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }
        
        password.addEventListener('input', () => {
            if (password.value.includes(' ')) {
                password.value = password.value.replace(/ /g, '');
                errorEspacios.style.display = 'block';
            } else {
                errorEspacios.style.display = 'none';
            }
            checkStrength(password.value);
            validarCoincidencia();
        });
        
        passwordConfirm.addEventListener('input', validarCoincidencia);
        
        function validarCoincidencia() {
            if (passwordConfirm.value === '') {
                errorCoincide.style.display = 'none';
                okCoincide.style.display = 'none';
                passwordConfirm.classList.remove('error', 'success');
                return;
            }
            if (password.value !== passwordConfirm.value) {
                errorCoincide.style.display = 'block';
                okCoincide.style.display = 'none';
                passwordConfirm.classList.add('error');
                passwordConfirm.classList.remove('success');
            } else {
                errorCoincide.style.display = 'none';
                okCoincide.style.display = 'block';
                passwordConfirm.classList.remove('error');
                passwordConfirm.classList.add('success');
            }
        }
        
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
</body>
</html>
