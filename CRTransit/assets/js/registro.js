
document.addEventListener("DOMContentLoaded", function () {
    const formLogin = document.querySelector("#formLogin");
    const formRegistro = document.querySelector("#formRegistro");


    const validarRegistro = (event) => {
        event.preventDefault();

        const formData = new FormData(formRegistro);
        const data = Object.fromEntries(formData.entries());

        if (!data.nombre || !data.correo || !data.password || !data.confirmPassword) {
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
        }

        Swal.fire({
            icon: "success",
            title: "Registro exitoso",
            text: "Su cuenta ha sido creada correctamente."
        });

        formRegistro.reset();
    };

    const validarLogin = (event) => {
        event.preventDefault();

        const formData = new FormData(formLogin);
        const data = Object.fromEntries(formData.entries());

        if (!data.loginEmail || !data.loginPassword) {
            Swal.fire({
                icon: "error",
                title: "Campos vacíos",
                text: "Debe llenar todos los campos para iniciar sesión."
            });
            return;
        }

        //Login de prueba

        if (data.loginEmail === "usuario@correo.com" && data.loginPassword === "1234") {
            Swal.fire({
                icon: "success",
                title: "Bienvenido",
                text: "Inicio de sesión exitoso."
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Datos incorrectos",
                text: "Correo o contraseña incorrectos."
            });
        }

        formLogin.reset();
    };

    formRegistro.addEventListener("submit", validarRegistro);
    formLogin.addEventListener("submit", validarLogin);
});