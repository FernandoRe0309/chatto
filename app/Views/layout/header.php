<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatto - Mensajeria Inteligente</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lucide-static@0.321.0/font/lucide.min.css">
    
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
            --warning: #f59e0b;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.5;
        }
        
        /* Navbar */
        .navbar {
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .navbar-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .navbar-brand svg {
            width: 28px;
            height: 28px;
            color: var(--accent);
        }
        
        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        
        .nav-link:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }
        
        .nav-link.active {
            background: var(--accent);
            color: white;
        }
        
        .nav-link svg {
            width: 18px;
            height: 18px;
        }
        
        /* User menu */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        /* Main container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.5rem;
        }
        
        /* Cards */
        .card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
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
        }
        
        .btn-secondary {
            background: var(--bg-tertiary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }
        
        .btn-secondary:hover {
            background: var(--bg-hover);
        }
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-ghost {
            background: transparent;
            color: var(--text-secondary);
        }
        
        .btn-ghost:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }
        
        .btn-icon {
            padding: 0.5rem;
            border-radius: 0.5rem;
        }
        
        /* Forms */
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
            background: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            color: var(--text-primary);
            transition: all 0.2s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }
        
        /* Text utilities */
        .text-center { text-align: center; }
        .text-muted { color: var(--text-muted); }
        .text-secondary { color: var(--text-secondary); }
        
        /* Spacing */
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-3 { margin-top: 1rem; }
        .mt-4 { margin-top: 1.5rem; }
        .mb-1 { margin-bottom: 0.25rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .w-full { width: 100%; }
        
        /* Grid */
        .grid { display: grid; }
        .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
        .gap-4 { gap: 1rem; }
        
        /* Flex */
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        
        /* Auth pages */
        .auth-container {
            min-height: calc(100vh - 60px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .auth-card {
            width: 100%;
            max-width: 400px;
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .auth-header p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
        
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.75rem;
        }
        
        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                display: none;
            }
            
            .main-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php if(session()->get('logueado')): ?>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="/usuarios" class="navbar-brand">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                Chatto
            </a>
            
            <div class="navbar-nav">
                <a href="/usuarios" class="nav-link <?= uri_string() == 'usuarios' ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Chats
                </a>
                <a href="/grupos" class="nav-link <?= strpos(uri_string(), 'grupo') !== false ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Grupos
                </a>
                <a href="/ia" class="nav-link <?= uri_string() == 'ia' ? 'active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8V4H8"/>
                        <rect width="16" height="12" x="4" y="8" rx="2"/>
                        <path d="M2 14h2"/>
                        <path d="M20 14h2"/>
                        <path d="M15 13v2"/>
                        <path d="M9 13v2"/>
                    </svg>
                    IA Chat
                </a>
            </div>
            
            <div class="user-menu">
                <a href="/perfil" class="nav-link">
                    <div class="user-avatar">
                        <?= strtoupper(substr(session()->get('nombre') ?? 'U', 0, 1)) ?>
                    </div>
                </a>
                <a href="/logout" class="btn btn-ghost btn-icon" title="Cerrar sesion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </a>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    
    <main class="<?= session()->get('logueado') ? '' : '' ?>">
