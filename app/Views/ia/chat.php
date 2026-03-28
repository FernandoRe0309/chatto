<?= view('layout/header') ?>

<style>
    .ia-container {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 60px);
        max-width: 900px;
        margin: 0 auto;
        background: var(--bg-secondary);
    }
    
    .ia-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: var(--bg-secondary);
        border-bottom: 1px solid var(--border-color);
    }
    
    .ia-avatar {
        width: 44px;
        height: 44px;
        border-radius: 0.75rem;
        background: linear-gradient(135deg, #22c55e, #14b8a6);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .ia-avatar svg {
        width: 24px;
        height: 24px;
        color: white;
    }
    
    .ia-info h2 {
        font-size: 1rem;
        font-weight: 600;
    }
    
    .ia-info p {
        font-size: 0.75rem;
        color: var(--success);
    }
    
    .ia-messages {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        background: var(--bg-primary);
    }
    
    .ia-message {
        max-width: 80%;
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .ia-message.user {
        align-self: flex-end;
    }
    
    .ia-message.assistant {
        align-self: flex-start;
    }
    
    .ia-message-content {
        padding: 0.875rem 1.25rem;
        border-radius: 1rem;
        font-size: 0.9375rem;
        line-height: 1.6;
    }
    
    .ia-message.user .ia-message-content {
        background: var(--accent);
        color: white;
        border-bottom-right-radius: 0.25rem;
    }
    
    .ia-message.assistant .ia-message-content {
        background: var(--bg-tertiary);
        color: var(--text-primary);
        border-bottom-left-radius: 0.25rem;
    }
    
    .ia-message.assistant .ia-message-content pre {
        background: var(--bg-primary);
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 0.75rem 0;
        font-family: 'Fira Code', monospace;
        font-size: 0.8125rem;
    }
    
    .ia-message.assistant .ia-message-content code {
        background: var(--bg-primary);
        padding: 0.125rem 0.375rem;
        border-radius: 0.25rem;
        font-family: 'Fira Code', monospace;
        font-size: 0.8125rem;
    }
    
    .ia-welcome {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
    }
    
    .ia-welcome .icon {
        width: 80px;
        height: 80px;
        border-radius: 1.5rem;
        background: linear-gradient(135deg, #22c55e, #14b8a6);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .ia-welcome .icon svg {
        width: 40px;
        height: 40px;
        color: white;
    }
    
    .ia-welcome h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    
    .ia-welcome p {
        font-size: 0.875rem;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .ia-suggestions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-top: 1.5rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .ia-suggestion {
        padding: 0.75rem 1rem;
        background: var(--bg-tertiary);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        font-size: 0.8125rem;
        color: var(--text-secondary);
        cursor: pointer;
        transition: all 0.2s;
        text-align: left;
        font-family: inherit;
    }
    
    .ia-suggestion:hover {
        background: var(--bg-hover);
        border-color: var(--accent);
        color: var(--text-primary);
    }
    
    .ia-input-area {
        padding: 1rem 1.5rem;
        background: var(--bg-secondary);
        border-top: 1px solid var(--border-color);
    }
    
    .ia-input-form {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }
    
    .ia-input {
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
    
    .ia-input:focus {
        outline: none;
        border-color: var(--accent);
    }
    
    .ia-input::placeholder {
        color: var(--text-muted);
    }
    
    .ia-send-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--success);
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .ia-send-btn:hover {
        background: #16a34a;
        transform: scale(1.05);
    }
    
    .ia-send-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }
    
    .ia-send-btn svg {
        width: 20px;
        height: 20px;
    }
    
    .typing-dots {
        display: flex;
        gap: 4px;
        padding: 0.875rem 1.25rem;
        background: var(--bg-tertiary);
        border-radius: 1rem;
        width: fit-content;
    }
    
    .typing-dots span {
        width: 8px;
        height: 8px;
        background: var(--text-muted);
        border-radius: 50%;
        animation: bounce 1.4s infinite;
    }
    
    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }
    
    @keyframes bounce {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-8px); }
    }
</style>

<div class="ia-container">
    <header class="ia-header">
        <div class="ia-avatar">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 8V4H8"/>
                <rect width="16" height="12" x="4" y="8" rx="2"/>
                <path d="M2 14h2"/>
                <path d="M20 14h2"/>
                <path d="M15 13v2"/>
                <path d="M9 13v2"/>
            </svg>
        </div>
        <div class="ia-info">
            <h2>Asistente IA</h2>
            <p>Disponible</p>
        </div>
    </header>
    
    <div class="ia-messages" id="iaMessages">
        <div class="ia-welcome" id="welcomeScreen">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 8V4H8"/>
                    <rect width="16" height="12" x="4" y="8" rx="2"/>
                    <path d="M2 14h2"/>
                    <path d="M20 14h2"/>
                    <path d="M15 13v2"/>
                    <path d="M9 13v2"/>
                </svg>
            </div>
            <h3>Hola, soy tu asistente IA</h3>
            <p>Puedo ayudarte con preguntas, explicaciones, codigo y mucho mas. Escribe lo que necesites!</p>
            
            <div class="ia-suggestions">
                <button class="ia-suggestion" onclick="useSuggestion('Explicame que es la programacion orientada a objetos')">
                    Que es POO?
                </button>
                <button class="ia-suggestion" onclick="useSuggestion('Como puedo mejorar mi productividad?')">
                    Tips productividad
                </button>
                <button class="ia-suggestion" onclick="useSuggestion('Escribe un ejemplo de funcion en PHP')">
                    Codigo PHP
                </button>
                <button class="ia-suggestion" onclick="useSuggestion('Dame 5 ideas para proyectos de programacion')">
                    Ideas proyectos
                </button>
            </div>
        </div>
    </div>
    
    <div class="ia-input-area">
        <form class="ia-input-form" id="iaForm" onsubmit="enviarMensaje(event)">
            <input 
                type="text" 
                id="iaInput"
                class="ia-input" 
                placeholder="Escribe tu mensaje..."
                autocomplete="off"
            >
            <button type="submit" class="ia-send-btn" id="sendBtn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    const iaMessages = document.getElementById('iaMessages');
    const iaInput = document.getElementById('iaInput');
    const sendBtn = document.getElementById('sendBtn');
    const welcomeScreen = document.getElementById('welcomeScreen');
    
    function useSuggestion(text) {
        iaInput.value = text;
        enviarMensaje(new Event('submit'));
    }
    
    function scrollToBottom() {
        iaMessages.scrollTop = iaMessages.scrollHeight;
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    function addMessage(content, role) {
        if (welcomeScreen) {
            welcomeScreen.style.display = 'none';
        }
        
        const div = document.createElement('div');
        div.className = `ia-message ${role}`;
        div.innerHTML = `<div class="ia-message-content">${formatMessage(content)}</div>`;
        iaMessages.appendChild(div);
        scrollToBottom();
    }
    
    function formatMessage(text) {
        text = escapeHtml(text);
        text = text.replace(/```(\w+)?\n([\s\S]*?)```/g, '<pre><code>$2</code></pre>');
        text = text.replace(/`([^`]+)`/g, '<code>$1</code>');
        text = text.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
        text = text.replace(/\n/g, '<br>');
        return text;
    }
    
    function showTyping() {
        const div = document.createElement('div');
        div.className = 'ia-message assistant';
        div.id = 'typingIndicator';
        div.innerHTML = `<div class="typing-dots"><span></span><span></span><span></span></div>`;
        iaMessages.appendChild(div);
        scrollToBottom();
    }
    
    function hideTyping() {
        const typing = document.getElementById('typingIndicator');
        if (typing) typing.remove();
    }
    
    async function enviarMensaje(e) {
        e.preventDefault();
        
        const mensaje = iaInput.value.trim();
        if (!mensaje) return;
        
        addMessage(mensaje, 'user');
        iaInput.value = '';
        sendBtn.disabled = true;
        
        showTyping();
        
        try {
            const response = await fetch('/ia/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'mensaje=' + encodeURIComponent(mensaje)
            });
            
            const data = await response.json();
            hideTyping();
            addMessage(data.respuesta || 'No hubo respuesta', 'assistant');
        } catch (error) {
            hideTyping();
            addMessage('Error al conectar con la IA. Por favor intenta de nuevo.', 'assistant');
        }
        
        sendBtn.disabled = false;
        iaInput.focus();
    }
    
    iaInput.focus();
</script>

<?= view('layout/footer') ?>
