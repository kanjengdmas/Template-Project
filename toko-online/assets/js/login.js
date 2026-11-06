document.addEventListener('DOMContentLoaded', function() {
    // Rate Limiting Logic
    const lockoutTime = typeof LOCKOUT_TIME !== 'undefined' ? LOCKOUT_TIME : 0;
    const currentTime = Math.floor(Date.now() / 1000);
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const errorMessage = document.getElementById('errorMessage');
    const alertBox = document.getElementById('alertBox');
    
    const inputs = loginForm ? loginForm.querySelectorAll('input') : [];

    if (loginForm && lockoutTime > currentTime) {
        let timeLeft = lockoutTime - currentTime;
        
        // Lock the UI
        const lockUI = () => {
            inputs.forEach(input => {
                input.disabled = true;
                input.classList.add('opacity-50', 'cursor-not-allowed');
            });
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                submitBtn.classList.remove('hover:-translate-y-1', 'active:scale-95');
            }
        };

        const unlockUI = () => {
            inputs.forEach(input => {
                input.disabled = false;
                input.classList.remove('opacity-50', 'cursor-not-allowed');
            });
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                submitBtn.classList.add('hover:-translate-y-1', 'active:scale-95');
            }
            if (btnText) btnText.innerText = 'Otorisasi Masuk';
            if (alertBox) alertBox.classList.add('hidden');
        };

        lockUI();

        const timer = setInterval(() => {
            timeLeft--;
            if (errorMessage) {
                errorMessage.innerText = `Terlalu banyak percobaan salah. Akun dikunci selama ${timeLeft} detik.`;
            }
            if (btnText) btnText.innerText = `Terkunci (${timeLeft}s)`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                unlockUI();
            }
        }, 1000);
    }

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
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    if (togglePassword && passwordField && eyeIcon) {
        togglePassword.addEventListener('click', function (e) {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    }
});
