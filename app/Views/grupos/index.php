<?= view('layout/header') ?>

<style>
    .groups-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    
    .groups-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    
    .groups-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .groups-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .group-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s;
    }
    
    .group-card:hover {
        background: var(--bg-hover);
        border-color: var(--accent);
        transform: translateX(4px);
    }
    
    .group-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .group-icon-1 { background: linear-gradient(135deg, #3b82f6, #8b5cf6); }
    .group-icon-2 { background: linear-gradient(135deg, #22c55e, #14b8a6); }
    .group-icon-3 { background: linear-gradient(135deg, #f59e0b, #ef4444); }
    .group-icon-4 { background: linear-gradient(135deg, #ec4899, #8b5cf6); }
    .group-icon-5 { background: linear-gradient(135deg, #06b6d4, #3b82f6); }
    
    .group-icon svg {
        width: 24px;
        height: 24px;
        color: white;
    }
    
    .group-info {
        flex: 1;
    }
    
    .group-name {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }
    
    .group-meta {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    
    .group-arrow {
        color: var(--text-muted);
    }
    
    .group-arrow svg {
        width: 20px;
        height: 20px;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
    }
    
    .empty-state svg {
        width: 64px;
        height: 64px;
        color: var(--text-muted);
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .empty-state h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: var(--text-muted);
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }
</style>

<div class="groups-container">
    <header class="groups-header">
        <h1>Grupos</h1>
        <a href="/grupos/crear" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Crear grupo
        </a>
    </header>
    
    <?php if(empty($grupos)): ?>
        <div class="empty-state">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <h3>No hay grupos aun</h3>
            <p>Crea tu primer grupo para comenzar a chatear con multiples personas</p>
            <a href="/grupos/crear" class="btn btn-primary">Crear mi primer grupo</a>
        </div>
    <?php else: ?>
        <div class="groups-list">
            <?php foreach($grupos as $index => $g): ?>
                <a href="/grupo_chat/<?= $g['id'] ?>" class="group-card">
                    <div class="group-icon group-icon-<?= ($index % 5) + 1 ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="group-info">
                        <div class="group-name"><?= esc($g['nombre']) ?></div>
                        <div class="group-meta">Haz clic para entrar al grupo</div>
                    </div>
                    <div class="group-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= view('layout/footer') ?>
