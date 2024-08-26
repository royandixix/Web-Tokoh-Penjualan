const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#floatingPassword");
const iconToggle = document.querySelector("#iconToggle");

togglePassword.addEventListener("click", function (e) {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // toggle the eye icon
    iconToggle.classList.toggle("fa-eye-slash");
});