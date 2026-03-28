<?= view('layout/header') ?>

<style>
    .chat-container {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 60px);
        max-width: 900px;
        margin: 0 auto;
        background: var(--bg-secondary);
    }
    
    .chat-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
    }
    
    .chat-header .back-btn {
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
    
    .chat-header .back-btn:hover {
        background: var(--bg-hover);
        color: var(--text-primary);
    }
    
    .chat-user-info {
        flex: 1;
    }
    
    .chat-user-name {
        font-weight: 600;
        font-size: 1rem;
    }
    
    .chat-user-status {
        font-size: 0.75rem;
        color: var(--success);
    }
    
    .chat-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    
    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        background: var(--bg-primary);
    }
    
    .message {
        max-width: 70%;
        padding: 0.75rem 1rem;
        border-radius: 1rem;
        font-size: 0.9375rem;
        line-height: 1.5;
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .message-sent {
        align-self: flex-end;
        background: var(--accent);
        color: white;
        border-bottom-right-radius: 0.25rem;
    }
    
    .message-received {
        align-self: flex-start;
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
    
    .message-received .message-time {
        text-align: left;
    }
    
    .chat-input-area {
        padding: 1rem 1.5rem;
        background: var(--bg-secondary);
        border-top: 1px solid var(--border-color);
    }
    
    .chat-input-form {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }
    
    .chat-input {
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
    
    .chat-input:focus {
        outline: none;
        border-color: var(--accent);
    }
    
    .chat-input::placeholder {
        color: var(--text-muted);
    }
    
    .send-btn {
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
    
    .send-btn:hover {
        background: var(--accent-hover);
        transform: scale(1.05);
    }
    
    .send-btn svg {
        width: 20px;
        height: 20px;
    }
    
    .empty-chat {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        text-align: center;
        padding: 2rem;
    }
    
    .empty-chat svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.3;
    }
    
    .empty-chat p {
        font-size: 0.875rem;
    }
    
    .typing-indicator {
        display: none;
        align-self: flex-start;
        padding: 0.75rem 1rem;
        background: var(--bg-tertiary);
        border-radius: 1rem;
    }
    
    .typing-indicator span {
        display: inline-block;
        width: 8px;
        height: 8px;
        background: var(--text-muted);
        border-radius: 50%;
        margin: 0 2px;
        animation: typing 1.4s infinite;
    }
    
    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }
    
    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }
    
    @keyframes typing {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-5px); }
    }
</style>

<div class="chat-container">
    <header class="chat-header">
        <a href="/usuarios" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </a>
        <div class="chat-avatar">
            <?= isset($destino_nombre) ? strtoupper(substr($destino_nombre, 0, 1)) : 'U' ?>
        </div>
        <div class="chat-user-info">
            <div class="chat-user-name"><?= isset($destino_nombre) ? esc($destino_nombre) : 'Usuario' ?></div>
            <div class="chat-user-status">En linea</div>
        </div>
    </header>
    
    <div class="chat-messages" id="chatMessages">
        <?php if(empty($mensajes)): ?>
            <div class="empty-chat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <p>No hay mensajes aun. Envia el primero!</p>
            </div>
        <?php else: ?>
            <?php foreach($mensajes as $m): ?>
                <div class="message <?= $m['remitente_id'] == session()->get('usuario_id') ? 'message-sent' : 'message-received' ?>">
                    <?= esc($m['mensaje']) ?>
                    <div class="message-time">
                        <?= date('H:i', strtotime($m['created_at'])) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <div class="typing-indicator" id="typingIndicator">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <div class="chat-input-area">
        <form class="chat-input-form" id="chatForm" method="post" action="/enviar">
            <input type="hidden" name="conversacion_id" value="<?= $conversacion_id ?>">
            <input type="hidden" name="destino_id" value="<?= $destino_id ?>">
            <input 
                type="text" 
                name="mensaje" 
                id="messageInput"
                class="chat-input" 
                placeholder="Escribe un mensaje..."
                autocomplete="off"
                required
            >
            <button type="submit" class="send-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const conversacionId = <?= $conversacion_id ?>;
    let ultimoId = <?= !empty($mensajes) ? end($mensajes)['id'] : 0 ?>;
    
    // Scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    scrollToBottom();
    
    // Focus on input
    messageInput.focus();
    
    // Poll for new messages
    async function checkNewMessages() {
        try {
            const response = await fetch(`/mensajes/${conversacionId}`);
            const mensajes = await response.json();
            
            const newMessages = mensajes.filter(m => m.id > ultimoId);
            
            newMessages.forEach(m => {
                const div = document.createElement('div');
                div.className = `message ${m.remitente_id == <?= session()->get('usuario_id') ?> ? 'message-sent' : 'message-received'}`;
                div.innerHTML = `
                    ${escapeHtml(m.mensaje)}
                    <div class="message-time">${formatTime(m.created_at)}</div>
                `;
                
                const typingIndicator = document.getElementById('typingIndicator');
                chatMessages.insertBefore(div, typingIndicator);
                
                ultimoId = m.id;
            });
            
            if (newMessages.length > 0) {
                scrollToBottom();
                
                // Remove empty state if exists
                const emptyChat = document.querySelector('.empty-chat');
                if (emptyChat) {
                    emptyChat.remove();
                }
            }
        } catch (err) {
            console.log('Error checking messages:', err);
        }
    }
    
    // Check every 3 seconds
    setInterval(checkNewMessages, 3000);
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    function formatTime(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
    }
</script>

<?= view('layout/footer') ?>
