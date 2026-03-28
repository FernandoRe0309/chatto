<?= view('layout/header') ?>

<style>
    .group-chat-container {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 60px);
        max-width: 900px;
        margin: 0 auto;
        background: var(--bg-secondary);
    }
    
    .group-chat-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
    }
    
    .group-chat-header .back-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 0.5rem;
        background: var(--bg-tertiary);
        color: var(--text-secondary);
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .group-chat-header .back-btn:hover {
        background: var(--bg-hover);
        color: var(--text-primary);
    }
    
    .group-icon {
        width: 44px;
        height: 44px;
        border-radius: 0.75rem;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .group-icon svg {
        width: 22px;
        height: 22px;
        color: white;
    }
    
    .group-chat-info {
        flex: 1;
    }
    
    .group-chat-name {
        font-weight: 600;
        font-size: 1rem;
    }
    
    .group-chat-members {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    
    .group-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        background: var(--bg-primary);
    }
    
    .group-message {
        max-width: 70%;
    }
    
    .group-message.sent {
        align-self: flex-end;
    }
    
    .group-message.received {
        align-self: flex-start;
    }
    
    .message-sender {
        font-size: 0.75rem;
        color: var(--accent);
        margin-bottom: 0.25rem;
        font-weight: 500;
    }
    
    .group-message.sent .message-sender {
        text-align: right;
        color: var(--text-muted);
    }
    
    .message-bubble {
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        font-size: 0.9375rem;
        line-height: 1.5;
    }
    
    .group-message.sent .message-bubble {
        background: var(--accent);
        color: white;
        border-bottom-right-radius: 0.25rem;
    }
    
    .group-message.received .message-bubble {
        background: var(--bg-tertiary);
        color: var(--text-primary);
        border-bottom-left-radius: 0.25rem;
    }
    
    .message-time {
        font-size: 0.625rem;
        opacity: 0.7;
        margin-top: 0.25rem;
        text-align: right;
    }
    
    .group-message.received .message-time {
        text-align: left;
    }
    
    .group-input-area {
        padding: 1rem 1.5rem;
        background: var(--bg-secondary);
        border-top: 1px solid var(--border-color);
    }
    
    .group-input-form {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }
    
    .group-input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        font-size: 0.9375rem;
        font-family: inherit;
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: 1.5rem;
        color: var(--text-primary);
        transition: all 0.2s;
    }
    
    .group-input:focus {
        outline: none;
        border-color: var(--accent);
    }
    
    .group-input::placeholder {
        color: var(--text-muted);
    }
    
    .group-send-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--accent);
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .group-send-btn:hover {
        background: var(--accent-hover);
        transform: scale(1.05);
    }
    
    .group-send-btn svg {
        width: 20px;
        height: 20px;
    }
    
    .empty-group-chat {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        text-align: center;
        padding: 2rem;
    }
    
    .empty-group-chat svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.3;
    }
</style>

<div class="group-chat-container">
    <header class="group-chat-header">
        <a href="/grupos" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </a>
        <div class="group-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
        <div class="group-chat-info">
            <div class="group-chat-name"><?= isset($grupo_nombre) ? esc($grupo_nombre) : 'Grupo' ?></div>
            <div class="group-chat-members">Chat grupal</div>
        </div>
    </header>
    
    <div class="group-messages" id="groupMessages">
        <?php if(empty($mensajes)): ?>
            <div class="empty-group-chat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <p>No hay mensajes aun. Se el primero en escribir!</p>
            </div>
        <?php else: ?>
            <?php foreach($mensajes as $m): ?>
                <div class="group-message <?= $m['remitente_id'] == session()->get('usuario_id') ? 'sent' : 'received' ?>">
                    <div class="message-sender">
                        <?= $m['remitente_id'] == session()->get('usuario_id') ? 'Tu' : (isset($m['nombre_remitente']) ? esc($m['nombre_remitente']) : 'Usuario ' . $m['remitente_id']) ?>
                    </div>
                    <div class="message-bubble">
                        <?= esc($m['mensaje']) ?>
                        <div class="message-time">
                            <?= date('H:i', strtotime($m['created_at'])) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="group-input-area">
        <form class="group-input-form" method="post" action="/grupo/enviar">
            <input type="hidden" name="grupo_id" value="<?= $grupo_id ?>">
            <input 
                type="text" 
                name="mensaje" 
                class="group-input" 
                placeholder="Escribe un mensaje al grupo..."
                autocomplete="off"
                required
                autofocus
            >
            <button type="submit" class="group-send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    // Scroll to bottom
    const groupMessages = document.getElementById('groupMessages');
    groupMessages.scrollTop = groupMessages.scrollHeight;
</script>

<?= view('layout/footer') ?>
