<?= view('layout/header') ?>

<style>
    .chat-layout {
        display: grid;
        grid-template-columns: 320px 1fr;
        height: calc(100vh - 60px);
        max-width: 1400px;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .chat-layout {
            grid-template-columns: 1fr;
        }
        .chat-main {
            display: none;
        }
    }
    
    .sidebar {
        background: var(--bg-secondary);
        border-right: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    .sidebar-header {
        padding: 1.25rem;
        border-bottom: 1px solid var(--border-color);
    }
    
    .sidebar-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-box input {
        width: 100%;
        padding: 0.625rem 1rem 0.625rem 2.5rem;
        font-size: 0.875rem;
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        color: var(--text-primary);
    }
    
    .search-box input:focus {
        outline: none;
        border-color: var(--accent);
    }
    
    .search-box svg {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--text-muted);
    }
    
    .user-list {
        flex: 1;
        overflow-y: auto;
        padding: 0.5rem;
    }
    
    .user-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
    }
    
    .user-item:hover {
        background: var(--bg-hover);
    }
    
    .user-item.active {
        background: var(--accent);
    }
    
    .user-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .avatar-1 { background: linear-gradient(135deg, #3b82f6, #8b5cf6); }
    .avatar-2 { background: linear-gradient(135deg, #22c55e, #14b8a6); }
    .avatar-3 { background: linear-gradient(135deg, #f59e0b, #ef4444); }
    .avatar-4 { background: linear-gradient(135deg, #ec4899, #8b5cf6); }
    .avatar-5 { background: linear-gradient(135deg, #06b6d4, #3b82f6); }
    
    .user-info {
        flex: 1;
        min-width: 0;
    }
    
    .user-name {
        font-weight: 500;
        font-size: 0.9375rem;
        margin-bottom: 0.125rem;
    }
    
    .user-status {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    
    .online-indicator {
        width: 10px;
        height: 10px;
        background: var(--success);
        border-radius: 50%;
        border: 2px solid var(--bg-secondary);
    }
    
    .chat-main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: var(--bg-primary);
        color: var(--text-muted);
    }
    
    .chat-main svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    .chat-main h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }
    
    .chat-main p {
        font-size: 0.875rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }
    
    .empty-state svg {
        width: 48px;
        height: 48px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>

<div class="chat-layout">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Conversaciones</h2>
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.3-4.3"/>
                </svg>
                <input type="text" id="searchUsers" placeholder="Buscar usuarios..." oninput="filterUsers()">
            </div>
        </div>
        
        <div class="user-list" id="userList">
            <?php if(empty($usuarios)): ?>
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <p>No hay usuarios disponibles</p>
                </div>
            <?php else: ?>
                <?php foreach($usuarios as $index => $u): ?>
                    <a href="/chat/<?= $u['id'] ?>" class="user-item" data-name="<?= strtolower(esc($u['nombre'])) ?>">
                        <div class="user-avatar avatar-<?= ($index % 5) + 1 ?>">
                            <?= strtoupper(substr($u['nombre'], 0, 1)) ?>
                        </div>
                        <div class="user-info">
                            <div class="user-name"><?= esc($u['nombre']) ?></div>
                            <div class="user-status">Haz clic para chatear</div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </aside>
    
    <div class="chat-main">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
        </svg>
        <h3>Selecciona una conversacion</h3>
        <p>Elige un usuario de la lista para comenzar a chatear</p>
    </div>
</div>

<script>
    function filterUsers() {
        const search = document.getElementById('searchUsers').value.toLowerCase();
        const users = document.querySelectorAll('.user-item');
        
        users.forEach(user => {
            const name = user.getAttribute('data-name');
            if (name.includes(search)) {
                user.style.display = 'flex';
            } else {
                user.style.display = 'none';
            }
        });
    }
</script>

<?= view('layout/footer') ?>
