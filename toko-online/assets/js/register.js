document.addEventListener('DOMContentLoaded', function() {
    // Glow Cursor
    const cursor = document.getElementById('cursorGlow');
    if (cursor) {
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });
    }

    // Reveal animations
    const reveals = document.querySelectorAll('.reveal');
    setTimeout(() => {
        reveals.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('active');
            }, index * 200);
        });
    }, 100);

    // Toggle Password
    const toggleButtons = document.querySelectorAll('.togglePassword');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const field = document.getElementById(targetId);
            const icon = this.querySelector('.eyeIcon');
            
            if (field && icon) {
                const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                field.setAttribute('type', type);
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            }
        });
    });
});
