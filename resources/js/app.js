// Bootstrap bawaan Laravel
import "./bootstrap";

// Bootstrap core JS
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

/* Sneat Core */
import "../sneat/js/helpers.js";
import "../sneat/js/config.js";
import "../sneat/js/menu.js";
import "../sneat/js/ui-toasts.js";
import "../sneat/js/ui-popover.js";
import "../sneat/js/pages-account-settings-account.js";
import "../sneat/js/extended-ui-perfect-scrollbar.js";
import "../sneat/js/main.js";


document.addEventListener("DOMContentLoaded", () => {
    if (
        typeof window.Helpers !== "undefined" &&
        typeof window.Helpers.initSidebarToggle === "function"
    ) {
        window.Helpers.initSidebarToggle();
    }

   
});
