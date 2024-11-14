<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['nombre_usuario']; 
    $email = $_POST['correo'];             
    $password = $_POST['contraseña']; 

    // Cifra la contraseña 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  
    $stmt = $conexion->prepare("INSERT INTO tbl_login(nombre_usuario, contraseña, correo) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $username, $hashed_password, $email);

    if ($stmt->execute()) {
        echo '<script>
        window.onload = function() {
            swal("", "Registrado Exitosamente", "success").then(function() {
                // Redirige al usuario a la página `consulta.php` después de que se cierre la alerta.
                window.location.href = "consulta.php";
            });
        };
        </script>';
    } else {
        echo '<script>
        window.onload = function() {
            swal("", "Error al Registrar", "error");
        };
        </script>';
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style.css">
    <title>Registrar</title>
</head>
<body>




    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="form-container w-100" style="max-width: 400px;">
            <h2 class="text-center mb-4">Registrar Sesión</h2>
            <form action="registrar_usuario.php" method="POST">
                <div class="mb-3">
                    <h5>Nombre Usuario</h5>
                    <input type="text" class="form-control" name="nombre_usuario" placeholder="Ingresa el Usuario" required>
                </div>
                <div class="mb-3">
                    <h5>Correo</h5>
                    <input type="email" class="form-control" name="correo" placeholder="Ingresa un correo" required>
                </div>
                <div class="input-group">
        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingresa la Contraseña" required>
        <button class="input-group-text" type="button" id="togglePassword">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
            </svg>
        </button>
    </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50 mr-2">Registrar</button>
                    <button type="button" class="btn btn-secondary w-50 ml-2" onclick="window.history.back();">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    //Funcion para el ojo
    function addEyeIcon() {
        const toggleButton = document.getElementById('togglePassword');
        toggleButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
            </svg>
        `;
    }

    // Función para alternar la visibilidad de la contraseña
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('contraseña');
        const toggleButton = document.getElementById('togglePassword');
        
        // Cambiar el tipo de la contraseña entre 'password' y 'text'
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';

            
        } else {
            passwordInput.type = 'password';
            // Cambiar el ícono a ojo (para ocultar la contraseña)
            addEyeIcon();
        }
    }

    // Añadir el evento de clic al botón para alternar la visibilidad de la contraseña
    document.getElementById('togglePassword').addEventListener('click', togglePasswordVisibility);
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>
