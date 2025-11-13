import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import AlpineJS with better error handling
import Alpine from 'alpinejs';

// Ensure window is defined (SSR compatibility)
if (typeof window !== 'undefined') {
    window.Alpine = Alpine;

    // Wait for DOM to be ready before starting Alpine
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            try {
                Alpine.start();
                console.log('✅ Alpine.js started successfully');
            } catch (error) {
                console.error('❌ Failed to start Alpine.js:', error);
            }
        });
    } else {
        // DOM is already ready
        try {
            Alpine.start();
            console.log('✅ Alpine.js started successfully');
        } catch (error) {
            console.error('❌ Failed to start Alpine.js:', error);
        }
    }
}




