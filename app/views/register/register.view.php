<div class="container " style="margin-bottom: 38px;margin-top: 38px;">

    <div class="row justify-content-center ">
        <div class="col-xl-5 col-lg-5 col-md-5 ">

            <div class="card o-hidden border-0 shadow-lg my-5 formlogin"><!-- controla la posicion superior -->
                <div class="card-body p-6 ">
                    <!-- Nested Row within Card Body -->
                    <div class="row ">

                        <div class="col-lg-12">

                            <div class="p-6 center-login">
                                <div class="text-center">
                                    <img src="../assets/img/logo.svg" alt="logo.svg">
                                </div>
                                <br><br>

                                <form class="user" name="form_sign">

                                    <div class="form-group">
                                        <label for="usur">Usuario</label>
                                        <input type="text" class="form-control form-control-user" id="usur" name="usur" aria-describedby="emailHelp" placeholder="Usuario" required>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" required>
                                    </div><br>
                                    <div class="form-group">
                                        <label for="pass">Contraseña</label>
                                        <input type="password" class="form-control form-control-user" id="pass" name="pass" placeholder="Contraseña" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label class="sign-in">¿Ya tienes una cuenta?
                                        <a href="../public/index.php"> Inicia sesión aqui</a>    </label>
                                    </div>

                                    <button type="button" class="btn-info btn-user btn-block boton-login" onclick="registerUser()">
                                        Registrarse
                                    </button>
                                    <hr>

                                </form>

                                <hr>
                                <div class="text-center">
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Validacion datos errados o limite de sesiones -->
<?php if (isset($_REQUEST['d'])) {
    if ($_REQUEST['d'] == 0) {
        echo "<script>$.alert('Usuario y/o Contraseñas incorrectos');</script>";
    } elseif ($_REQUEST['d'] == 6) {
        echo "<script>
								$.confirm({
										   	title: 'CERRANDO SESION',
										    content: 'Limite de sesiones alcanzada.',
										    autoClose: 'logoutUser|10000',
										    buttons: {
												        logoutUser: {
														            text: 'Cerrando',
														            action: function () {
														               						window.location.href = ('./views/logout.php');
														            					}
												        			}
										    		 }
										});
						      </script>";
    }
} ?>