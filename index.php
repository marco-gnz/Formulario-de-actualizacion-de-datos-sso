<?php include("db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link href="/css/style.css" type="css" rel="stylesheet">
    <title>SSO | Contacto</title>
</head>

<body>
    <div class="container">
        <br>
        <div class="abs-center">
            <legend class="text-center header">Datos de contacto | Servicio de Salud Osorno</legend>
            <div class="row">
                <div class="col-md-6">
                    <img src="" alt="">
                    <p>IMAGEN</p>
                </div>
                <div class="col-md-6">
                    <form accept-charset="utf8_decode" id="testForm" action="guardar_datos.php" method="POST" class="border p-3 m-4 ml-5 mx-5 form">
                        <div class="form-group">
                            <label for="email">RUT</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="busqueda" id="busqueda" maxlength="10" class="form-control" placeholder="Ej: 11111111-1" autofocus required>
                                    <div id="error" style="color: red;"></div>
                                    <div id="usuarioEditado" style="color: blue;"></div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="bucarRut" class="btn btn-link">Buscar RUT</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" id="nombres" name="nombres" class="form-control" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" required disabled>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="email" id="correo" class="form-control" placeholder="Correo Institucional o Personal" required>
                        </div>
                        <div class="form-group">
                            <label>Nº de Contacto</label>
                            <input type="text" id="contacto" name="telefono" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="guardar_datos" id="guardar_datos" value="guardar_datos" class="btn btn-primary btn-block">Actualizar datos</button>
                        </div>
                        <i id="messageDatos" style="color:darkgrey; font-size: 15px; display: none;">Si no deseas actualizar tus datos, por favor presiona <b>Actualizar Datos</b> de igual manera.</i>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- cdn js, jquery-->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        $(document).ready(function() {
            $("#bucarRut").click(function() {
                $("#bucarRut").prop("disabled", true);
                $("#bucarRut").html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Buscando RUT...`
                );
                setTimeout(function() {
                    this.buscar();
                    $("#bucarRut").prop("disabled", false);
                    $("#bucarRut").html(
                        `<button type="button" class="btn btn-link">Buscar RUT</button>`
                    );

                }, 1100);
            });
        });

        function buscar() {
            var textoBusqueda = $("input#busqueda").val();
            if (textoBusqueda != "") {
                $.post('buscar.php', {
                    valorBusqueda: textoBusqueda
                }, function(data) {
                    $("#resultadoBusqueda").html(data);
                    console.log(data);
                    if (data == false) {
                        let error = "No existe el Rut."
                        document.getElementById('error').innerHTML = error;

                    } else {
                        document.getElementById('error').innerHTML = "";
                        let nombres = data[0];
                        let apellidos = data[1];
                        let correo = data[2];
                        let contacto = data[3];
                        let estado = data[4];

                        if (estado != 0) {
                            let usuarioEditado = "Datos ya actualizados..."
                            document.getElementById('usuarioEditado').innerHTML = usuarioEditado;
                            location.href = "https://ssosorno.cl";
                        } else {
                            document.getElementById('usuarioEditado').innerHTML = "";

                            document.getElementById('nombres').value = nombres;
                            document.getElementById('apellidos').value = apellidos;
                            document.getElementById('correo').value = correo;
                            document.getElementById('contacto').value = contacto;

                            document.getElementById("messageDatos").style.display = "block";
                        }
                    }
                });
            } else {
                alert("Ingrese rut");
            }
        };

        $(document).ready(function() {
            $("#guardar_datos").click(function() {
                var nombres, apellidos, correo, contacto;

                nombres = document.getElementById("nombres").value;
                apellidos = document.getElementById("apellidos").value;
                correo = document.getElementById("correo").value;
                contacto = document.getElementById("contacto").value;

                if (nombres === "" || apellidos === "" || correo === "" || contacto === "") {
                    alert("Por favor complete todos los campos");
                    return false;
                } else {
                    $(this).prop("disabled", true);
                    $(this).html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando datos...`
                    );
                    setTimeout(function() {
                        /*submit the form after 5 secs*/
                        $('#testForm').submit();
                    }, 1500)
                }
            });
        });
    </script>
</body>

</html>