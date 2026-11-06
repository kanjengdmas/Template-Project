// auth.js - Custom JS for login and registration forms

// 1. Show Password Toggle Action
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
const eyeIcon = document.querySelector('#eyeIcon');

if (togglePassword && password && eyeIcon) {
    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye-slash');
        eyeIcon.classList.toggle('fa-eye');
    });
}

// 1.2. Show Password Confirm Toggle Action
const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
const passwordConfirm = document.querySelector('#password_confirm');
const eyeIconConfirm = document.querySelector('#eyeIconConfirm');

if (togglePasswordConfirm && passwordConfirm && eyeIconConfirm) {
    togglePasswordConfirm.addEventListener('click', function (e) {
        const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirm.setAttribute('type', type);
        eyeIconConfirm.classList.toggle('fa-eye-slash');
        eyeIconConfirm.classList.toggle('fa-eye');
    });
}

// 2. Loading Button / Submit Forms
const loginForm = document.getElementById('loginForm');
const btnLogin = document.getElementById('btnLogin');

if (loginForm && btnLogin) {
    loginForm.addEventListener('submit', function() {
        btnLogin.disabled = true;
        btnLogin.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Memproses...';
    });
}

const registerForm = document.getElementById('registerForm');
const btnRegister = document.getElementById('btnRegister');

if (registerForm && btnRegister) {
    registerForm.addEventListener('submit', function() {
        btnRegister.disabled = true;
        btnRegister.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Mendaftarkan...';
    });
}

// 3. SweetAlert2 Flash Notifications via HTML Data Attributes
const flashDataEl = document.getElementById('flash-data');
if (flashDataEl && typeof Swal !== 'undefined') {
    const errorMsg = flashDataEl.getAttribute('data-error');
    const successMsg = flashDataEl.getAttribute('data-success');
    if (errorMsg && errorMsg.trim() !== '') {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: errorMsg,
            confirmButtonColor: '#0A3FD6'
        });
    }
    if (successMsg && successMsg.trim() !== '') {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: successMsg,
            confirmButtonColor: '#0A3FD6'
        });
    }
}

// 4. Password Strength Meter
if (password) {
    const pwStrengthContainer = document.getElementById('pw-strength-container');
    const pwStrengthBar = document.getElementById('pw-strength-bar');
    const pwStrengthText = document.getElementById('pw-strength-text');

    if (pwStrengthContainer && pwStrengthBar && pwStrengthText) {
        password.addEventListener('input', function() {
            const val = password.value;
            if (val.length === 0) {
                pwStrengthContainer.classList.add('d-none');
                return;
            }
            pwStrengthContainer.classList.remove('d-none');
            
            let score = 0;
            if (val.length >= 6) score += 20;
            if (/[a-z]/.test(val)) score += 20;
            if (/[A-Z]/.test(val)) score += 20;
            if (/[0-9]/.test(val)) score += 20;
            if (/[^a-zA-Z0-9]/.test(val)) score += 20;

            pwStrengthBar.style.width = score + '%';
            if (score <= 40) {
                pwStrengthBar.className = 'progress-bar bg-danger';
                pwStrengthText.innerText = 'Kekuatan: Sangat Lemah';
                pwStrengthText.style.color = '#dc3545';
            } else if (score <= 60) {
                pwStrengthBar.className = 'progress-bar bg-warning';
                pwStrengthText.innerText = 'Kekuatan: Lemah';
                pwStrengthText.style.color = '#ffc107';
            } else if (score <= 80) {
                pwStrengthBar.className = 'progress-bar bg-info';
                pwStrengthText.innerText = 'Kekuatan: Sedang';
                pwStrengthText.style.color = '#0dcaf0';
            } else {
                pwStrengthBar.className = 'progress-bar bg-success';
                pwStrengthText.innerText = 'Kekuatan: Kuat';
                pwStrengthText.style.color = '#198754';
            }
        });
    }
}

// 5. Konfirmasi Password Real-Time
if (password && passwordConfirm) {
    const pwMatchMessage = document.getElementById('pw-match-message');
    if (pwMatchMessage) {
        function checkPasswordMatch() {
            const pw = password.value;
            const pwConfirm = passwordConfirm.value;
            if (pwConfirm.length === 0) {
                pwMatchMessage.innerText = '';
                passwordConfirm.closest('.input-group-wrapper').style.borderColor = '#dee2e6';
                return;
            }
            if (pw === pwConfirm) {
                pwMatchMessage.innerText = '✓ Password cocok';
                pwMatchMessage.style.color = '#198754';
                passwordConfirm.closest('.input-group-wrapper').style.borderColor = '#198754';
            } else {
                pwMatchMessage.innerText = '✗ Password tidak cocok';
                pwMatchMessage.style.color = '#dc3545';
                passwordConfirm.closest('.input-group-wrapper').style.borderColor = '#dc3545';
            }
        }
        password.addEventListener('input', checkPasswordMatch);
        passwordConfirm.addEventListener('input', checkPasswordMatch);
    }
}

// 6. Cek Username AJAX (Debounced)
const usernameInput = document.getElementById('username');
const usernameFeedback = document.getElementById('username-feedback');
const usernameSpinner = document.getElementById('username-spinner');
const baseUrlInput = document.getElementById('base_url');
const baseUrl = baseUrlInput ? baseUrlInput.value : '';

if (usernameInput && usernameFeedback) {
    let debounceTimer;
    usernameInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const username = usernameInput.value.trim();
        if (username.length === 0) {
            usernameFeedback.innerText = '';
            usernameInput.closest('.input-group-wrapper').style.borderColor = '#dee2e6';
            return;
        }
        if (username.length < 3) {
            usernameFeedback.innerText = 'Username minimal 3 karakter';
            usernameFeedback.style.color = '#dc3545';
            usernameInput.closest('.input-group-wrapper').style.borderColor = '#dc3545';
            return;
        }
        
        if (usernameSpinner) usernameSpinner.classList.remove('d-none');
        usernameFeedback.innerText = '';
        
        debounceTimer = setTimeout(() => {
            const formData = new FormData();
            formData.append('username', username);
            
            fetch(baseUrl + 'auth/check_username', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (usernameSpinner) usernameSpinner.classList.add('d-none');
                if (data.status === 'taken') {
                    usernameFeedback.innerText = '✗ ' + data.message;
                    usernameFeedback.style.color = '#dc3545';
                    usernameInput.closest('.input-group-wrapper').style.borderColor = '#dc3545';
                } else if (data.status === 'available') {
                    usernameFeedback.innerText = '✓ ' + data.message;
                    usernameFeedback.style.color = '#198754';
                    usernameInput.closest('.input-group-wrapper').style.borderColor = '#198754';
                }
            })
            .catch(err => {
                if (usernameSpinner) usernameSpinner.classList.add('d-none');
                console.error('Error checking username:', err);
            });
        }, 500);
    });
}

// 7. Validasi Email Real-Time
const emailInput = document.getElementById('email');
const emailErrorMsg = document.getElementById('email-error-msg');
if (emailInput && emailErrorMsg) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    emailInput.addEventListener('input', function() {
        const email = emailInput.value.trim();
        if (email.length === 0) {
            emailErrorMsg.innerText = '';
            emailInput.closest('.input-group-wrapper').style.borderColor = '#dee2e6';
            return;
        }
        if (emailRegex.test(email)) {
            emailErrorMsg.innerText = '✓ Format email valid';
            emailErrorMsg.style.color = '#198754';
            emailInput.closest('.input-group-wrapper').style.borderColor = '#198754';
        } else {
            emailErrorMsg.innerText = '✗ Format email tidak valid';
            emailErrorMsg.style.color = '#dc3545';
            emailInput.closest('.input-group-wrapper').style.borderColor = '#dc3545';
        }
    });
}

// 8. Particle Background Halus (login-left / register-left)
const canvas = document.getElementById('login-particles');
if (canvas) {
    const ctx = canvas.getContext('2d');
    let particles = [];

    function resizeCanvas() {
        canvas.width = canvas.parentElement.offsetWidth;
        canvas.height = canvas.parentElement.offsetHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 1;
            this.speedX = Math.random() * 0.3 - 0.15;
            this.speedY = Math.random() * -0.3 - 0.1;
            this.opacity = Math.random() * 0.35 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            if (this.y < 0) {
                this.y = canvas.height;
                this.x = Math.random() * canvas.width;
            }
            if (this.x < 0 || this.x > canvas.width) {
                this.speedX = -this.speedX;
            }
        }
        draw() {
            ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    for (let i = 0; i < 30; i++) {
        particles.push(new Particle());
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            p.update();
            p.draw();
        });
        requestAnimationFrame(animateParticles);
    }
    animateParticles();
}

// 9. Inisialisasi Carousel Secara Manual agar otomatis pindah tanpa digeser
document.addEventListener('DOMContentLoaded', function() {
    const myCarouselElement = document.querySelector('#heroCarousel');
    if (myCarouselElement) {
        const myCarousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 3000,
            ride: 'carousel',
            pause: false
        });
        myCarousel.cycle();
    }
});
