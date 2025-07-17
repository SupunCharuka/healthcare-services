const toggleLoginPassword = document.querySelector("#toggleLoginPassword");
const loginPassword = document.querySelector(".password-login");

toggleLoginPassword.addEventListener("click", function (e) {
    const type =
        loginPassword.getAttribute("type") === "password" ? "text" : "password";
    loginPassword.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
});


const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector(".password-register");

togglePassword.addEventListener("click", function (e) {
    const type =
        password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
});

const togglePasswordConfirmation = document.querySelector(
    "#togglePassword_confirmation"
);
const passwordConfirmation = document.querySelector("#password_confirmation");

togglePasswordConfirmation.addEventListener("click", function (e) {
    const type =
        passwordConfirmation.getAttribute("type") === "password"
            ? "text"
            : "password";
    passwordConfirmation.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
});
