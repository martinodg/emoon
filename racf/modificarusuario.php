<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' media='screen and (max-width: 700px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 959px)' href='../estilos/login.css' />
    <link rel='stylesheet' media='screen and (min-width: 960px)' href='../estilos/login.css' />
    <script type="text/javascript" src="../jquery/jquery331.js"></script>
    <script type="text/javascript" src="../funciones/login.js"></script>
    <script language="javascript">

        var cursor;
        if (document.all) {
                // Está utilizando EXPLORER
                cursor='hand';
        } else {
                // Está utilizando MOZILLA/NETSCAPE
                cursor='pointer';
        }

        function limpiar() {
            document.getElementById("formulario").reset();
        }

        function cancelar() {
            location.href="index.php";
        }

        function modificausuario() {
            $.get( "guardarusuario.php" , { accion : 'modificar',
                                            name : document.getElementById('name').value,
                                            email : document.getElementById('email-field').value,
                                            password : document.getElementById('password-field').value
                                        }, function ( data ) { 
                                                            $('#div_datos').html( data );
                                                            location.href="index.php";
                                                            }
                );                            
        }
        //search user
        function buscausuario(usuario) {
            //alert(usuario);
            $.getJSON("./buscarUsuario.php", {
                                                    criterio1 : 'id_intUser',
                                                    parametro1 : usuario,
                                                    paginainicio: '0',
                                                    tipoBusqueda: 'modificar'
                                                },
                                                function(data) {
                                                                //alert(data.nombre);
                                                                $('#name').val(data.nombre);
                                                                $('#password-field').val(data.clave);
                                                                $('#email-field').val(data.mail);
                                                                $('#password-validation-field').val(data.clave);
                                                                $('#email-validation-field').val(data.mail);
                                                                //$('#div_datos').html( data );
                                                                //calculaPaginacion();
                                                                }
                        );                        
        }
        $(document).ready(function() {
              //get proceso code from Url hash on last page.
              var usuario = window.location.hash.substring(1);
              buscausuario(usuario);
        });
    </script>

    <title>Registration form</title>
</head>

<body>
    <div id="content_login">
       
        
            <div class="column2" style="background-color:#eee;">
                <center>
                    <form name="frmUser" align="center">
                        <div class="message">
                            <?php if($message!="") { echo $message; } ?>
                        </div>
                        <br> <br>
                        <span id="nombre" class="loginText">Nombre de Usuario:</span><br>
                        <input class="input-wrapper" type="text" id="name" name="name" readonly>
                        <br> <br>

                        <span class="loginText">e-mail:</span><br>
                        <input id="email-field" class="input-wrapper" type="text" name="email">
                        <br> <br>
                        <span id="password" class="loginText">clave:</span><br>
                        <div class="password-wrapper">
                            <input id="password-field" type="password" class="input" name="password">
                            <div class="icon-wrapper pass">
                                <span toggle="#password-field" class="field-icon toggle-password"></span>
                            </div>
                            <div class="strength-lines">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>

                </center>
            </div>
            <div class="column2" style="background-color:#eee;">
                <center>
                    <br> <br>

                   
                    <span id="emailValidation" class="loginText">validacion de e-mail:</span><br>
                    <div class="email-validation-wrapper">
                        <input id="email-validation-field" type="text" class="input" name="email-validation" onpaste="return false;">
                        <div class="email-validation-icon-wrapper passdistinta"></div>
                    </div>
                    <br>
                    <span id="passwordValidation" class="loginText">validacion de clave:</span><br>
                    <div class="password-validation-wrapper">
                        <input id="password-validation-field" type="password" class="input" name="password-validation" onpaste="return false;">
                        <div class="validation-icon-wrapper passdistinta">
                            <span toggle="#password-validation-field" class="field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div>Activado <label class="switch"> <input type="checkbox" id="batch" name="batch" > <span class="slider round"></span> </label> Desactivado</div>

                    <input type="hidden" id="language" name="language" value="0">


                </center>
            </div>

            <div id="botonBusqueda" align="right">
                <button type="button" id="btnsubmit" onClick="modificausuario()" onMouseOver="style.cursor=cursor" disabled=""> <img src="../img/disco.svg" alt="Nuevo" /> <span>Guardar modificacion</span> </button>

            </div>

            </form>
            <br>
            <div ID="div_datos" name="div_datos" > </div> 

            <br>
        </div>
    </div>
</body>

</html>