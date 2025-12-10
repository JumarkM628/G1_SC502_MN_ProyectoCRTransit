document.addEventListener("DOMContentLoaded", function () {
    const formLogin = document.querySelector("#formLogin");
    const formRegistro = document.querySelector("#formRegistro");

    const params = new URLSearchParams(window.location.search);

    if (params.has("login_error")) {
        Swal.fire({
            icon: "error",
            title: "Error al iniciar sesión",
            text: params.get("login_error")
        });
    }


    const validarRegistro = (event) => {
        event.preventDefault();

        const formData = new FormData(formRegistro);
        const data = Object.fromEntries(formData.entries());

        if (
            data.nombre.trim() === "" ||
            data.email.trim() === "" ||
            data.password.trim() === "" ||
            data.confirmPassword.trim() === ""
        ) {
            Swal.fire({
                icon: "error",
                title: "Campos vacíos",
                text: "Debe llenar todos los campos del registro."
            });
            return;
        }

        if (data.password !== data.confirmPassword) {
            Swal.fire({
                icon: "error",
                title: "Contraseñas no coinciden",
                text: "Verifique que ambas contraseñas sean iguales."
            });
            return;
        } else {
            Swal.fire({
                icon: "success",
                title: "Registro exitoso",
                text: "Pase a iniciar sesión"
            }).then(() => {
                formRegistro.submit();
            });
            return;
        }
    };


    const validarLogin = (event) => {
        event.preventDefault();

        const formData = new FormData(formLogin);
        const data = Object.fromEntries(formData.entries());

        if (data.email.trim() === "" || data.password.trim() === "") {
            Swal.fire({
                icon: "error",
                title: "Campos vacíos",
                text: "Debe llenar todos los campos para iniciar sesión."
            });
            return;
        }


        formLogin.submit();
    };

    formRegistro.addEventListener("submit", validarRegistro);
    formLogin.addEventListener("submit", validarLogin);
});
