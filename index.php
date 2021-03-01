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
            <div class="row">
                <div class="col-md-2 ml-5">
                    <img src="./img/logo.jpeg" alt="Servicio de Salud - Logo" class="rounded" style="width: 100px; height: 100px;">
                </div>
                <div class="col-md-8">
                    <legend class="text-center header">Actualización de datos de contacto <strong style="color:#0d69b3;">|</strong> <b>Servicio de Salud Osorno</b></legend>
                </div>
            </div>
            <div class="col-md-6 my-3" style="margin-right:auto; margin-left: auto;">
                <form accept-charset="utf8_decode" id="testForm" class="border p-3" action="editar_datos.php" method="POST">
                    <div id="errores" style="color: red;"></div>
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="email">RUT</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="busqueda" id="busqueda" maxlength="10" class="form-control" placeholder="11111111-1" autofocus required>
                                <div id="error" style="color: red;"></div>
                                <div id="usuarioEditado" style="color: #0d69b3;"></div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" id="bucarRut" class="btn btn-link" style="color: #0d69b3;">Buscar RUT</button>
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
                        <label>Correo <strong style="color: red;">*</strong></label>
                        <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo Institucional o Personal" required>
                    </div>
                    <div class="form-group">
                        <label>Nº de Contacto <strong style="color: red;">*</strong></label>
                        <input type="text" id="contacto" name="contacto" class="form-control" required>
                        <div id="errorContacto" style="color: red;"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="guardar_datos" id="guardar_datos" value="guardar_datos" class="btn btn-primary btn-block" style="background-color: #0d69b3;">Actualizar datos</button>
                    </div>
                    <i id="messageDatos" class="text-center" style="color:#474747; font-size: 15px; display: none;">Si no deseas actualizar tus datos, por favor presiona <b>Actualizar datos</b> de igual manera.</i>
                </form>
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
                        let id = data[0];
                        let nombres = data[1];
                        let apellidos = data[2];
                        let correo = data[3];
                        let contacto = data[4];
                        let estado = data[5];

                        if (estado != 0) {
                            let usuarioEditado = "Datos ya actualizados, por favor espere..."
                            document.getElementById('usuarioEditado').innerHTML = usuarioEditado;
                            location.href = "https://ssosorno.cl";
                        } else {
                            document.getElementById('usuarioEditado').innerHTML = "";

                            document.getElementById('id').value = id;
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

                let error = "* Campos requeridos."
                let errorContacto = "* Contacto debe ser mayor a 8 números.";


                if (nombres === "" || apellidos === "" || correo === "" || contacto === "") {
                    document.getElementById('errores').innerHTML = error;
                    return false;
                    
                }else if(contacto.length < 8){
                    document.getElementById('errorContacto').innerHTML = errorContacto;
                    return false;
                } else {
                    $(this).prop("disabled", true);
                    $(this).html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando datos...`
                    );
                    setTimeout(function() {
                        $('#testForm').submit();

                    }, 1100)
                }
            });
        });
    </script>
</body>

</html>