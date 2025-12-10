<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../public/css/registro.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <title>Registro y Login</title>
</head>

<body>
    <div class="fondo">
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card p-4 shadow-lg bg-light bg-opacity-75" style="max-width: 420px; width: 100%;">
                <h2 class="text-center titulo">CRTransit</h2>
                <p class=" text-center">Bienvenido a CRTransit, la aplicación web para el rastreo de autobuses en
                    tiempo real.</p>

                <ul class="nav nav-tabs justify-content-center mb-3" id="formTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                            type="button" role="tab">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#registrarse"
                            type="button" role="tab">Registrarse</a>
                    </li>
                </ul>



                <div class="tab-content">
                    <div class="tab-pane fade show active" id="login">
                        <form id="formLogin" method="POST" action="./auth/login.php">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Correo electrónico</label>
                                <input type="email" id="loginEmail" name="email" class="form-control" placeholder="usuario@correo.com">
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Contraseña</label>
                                <input type="password" id="loginPassword" name="password" class="form-control" placeholder="********">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="registrarse">
                        <form id="formRegistro" method="POST" action="./auth/registro.php">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control"
                                    placeholder="Tu nombre">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" id="correo" name="email" class="form-control"
                                    placeholder="usuario@correo.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="********">
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                                    placeholder="********">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/js/registro.js"></script>
</body>

</html>

<link rel="stylesheet" href="../../public/css/general.css">
