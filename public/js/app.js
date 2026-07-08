document.addEventListener('DOMContentLoaded', function () {
    const html = document.documentElement;
    const darkToggle = document.getElementById('darkModeToggle');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    // Load saved theme
    const savedTheme = window.localStorage ? localStorage.getItem('theme') : null;
    if (savedTheme) {
        html.setAttribute('data-bs-theme', savedTheme);
    }

    if (darkToggle) {
        darkToggle.addEventListener('click', function () {
            const current = html.getAttribute('data-bs-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', next);
            if (window.localStorage) {
                localStorage.setItem('theme', next);
            }
        });
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
    }
});
