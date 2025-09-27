// Se você usa o bootstrap.js padrão do Laravel (Axios, Echo, etc.), mantenha:
import './bootstrap';

// Bootstrap JS (bundle inclui Popper)
import * as bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Opcional: expor no escopo global para inicializar tooltips/toasts via JS
window.bootstrap = bootstrap;

// Exemplos de inicialização leve
document.addEventListener('DOMContentLoaded', () => {
  // Tooltips (se houver data-bs-toggle="tooltip")
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  [...tooltipTriggerList].forEach(el => new bootstrap.Tooltip(el));
});
