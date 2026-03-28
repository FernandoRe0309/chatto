<?= view('layout/header') ?>

<style>
    .profile-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }
    
    .profile-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        padding: 2rem;
        text-align: center;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 2rem;
        font-weight: 700;
        color: white;
        border: 3px solid rgba(255, 255, 255, 0.3);
    }
    
    .profile-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.25rem;
    }
    
    .profile-email {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .profile-body {
        padding: 1.5rem;
    }
    
    .profile-info {
        margin-bottom: 1.5rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--bg-tertiary);
        border-radius: 0.75rem;
        margin-bottom: 0.75rem;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 0.5rem;
        background: var(--bg-hover);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
    }
    
    .info-icon svg {
        width: 20px;
        height: 20px;
    }
    
    .info-content {
        flex: 1;
    }
    
    .info-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 0.125rem;
    }
    
    .info-value {
        font-size: 0.9375rem;
        font-weight: 500;
    }
    
    .profile-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .profile-actions .btn {
        justify-content: flex-start;
        padding: 0.875rem 1.25rem;
    }
    
    .profile-actions .btn svg {
        width: 18px;
        height: 18px;
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <?= strtoupper(substr($usuario['nombre'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="profile-name"><?= esc($usuario['nombre']) ?></div>
            <div class="profile-email"><?= esc($usuario['email']) ?></div>
        </div>
        
        <div class="profile-body">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; padding: 0.875rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <div class="profile-info">
                <div class="info-item">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Nombre completo</div>
                        <div class="info-value"><?= esc($usuario['nombre']) ?></div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Correo electronico</div>
                        <div class="info-value"><?= esc($usuario['email']) ?></div>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Miembro desde</div>
                        <div class="info-value"><?= date('d/m/Y', strtotime($usuario['created_at'])) ?></div>
                    </div>
                </div>
            </div>
            
            <div class="profile-actions">
                <a href="/usuarios" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                    Ir a mis chats
                </a>
                <a href="/grupos" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    Mis grupos
                </a>
                <a href="/logout" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Cerrar sesion
                </a>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
