const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

const togglePasswordConfirmation = document.querySelector('#togglePassword_confirmation');
const passwordConfirmation = document.querySelector('#password_confirmation');

togglePassword.addEventListener('click', function(e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

togglePasswordConfirmation.addEventListener('click', function(e) {
    const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirmation.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
