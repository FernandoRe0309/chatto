    </main>
    
    <script>
        // Utility functions
        function formatTime(date) {
            return new Date(date).toLocaleTimeString('es-ES', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
        }
        
        function formatDate(date) {
            return new Date(date).toLocaleDateString('es-ES', { 
                day: '2-digit', 
                month: 'short',
                year: 'numeric'
            });
        }
        
        // Add smooth transitions
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>
