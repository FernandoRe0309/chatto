<?= view('layout/header') ?>

<style>
    .create-group-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        transition: color 0.2s;
    }
    
    .back-link:hover {
        color: var(--text-primary);
    }
    
    .back-link svg {
        width: 16px;
        height: 16px;
    }
    
    .create-group-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        padding: 2rem;
    }
    
    .create-group-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .create-group-header .icon {
        width: 64px;
        height: 64px;
        border-radius: 1rem;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .create-group-header .icon svg {
        width: 32px;
        height: 32px;
        color: white;
    }
    
    .create-group-header h1 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .create-group-header p {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }
</style>

<div class="create-group-container">
    <a href="/grupos" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6"/>
        </svg>
        Volver a grupos
    </a>
    
    <div class="create-group-card">
        <div class="create-group-header">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <h1>Crear nuevo grupo</h1>
            <p>Crea un grupo para chatear con varias personas a la vez</p>
        </div>
        
        <form method="post" action="/grupos/guardar">
            <div class="form-group">
                <label class="form-label">Nombre del grupo</label>
                <input 
                    type="text" 
                    name="nombre" 
                    class="form-control" 
                    placeholder="Ej: Proyecto Final, Amigos, Trabajo..."
                    required
                    autofocus
                >
            </div>
            
            <button type="submit" class="btn btn-primary w-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Crear grupo
            </button>
        </form>
    </div>
</div>

<?= view('layout/footer') ?>
