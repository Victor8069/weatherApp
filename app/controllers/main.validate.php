<?php

	session_start();
	require_once('../../config/database.php');
	require_once('./user.controller.php');
	
	if( ISSET($_POST['usur']) && ISSET($_POST['pass']))
	{
			$user=filter_input(INPUT_POST,'usur',FILTER_SANITIZE_SPECIAL_CHARS);
			$pass=filter_input(INPUT_POST,'pass',FILTER_SANITIZE_SPECIAL_CHARS);
			
			if(ISSET($user) && ISSET($pass))
			{
					$objUser=new UserController();
					$response=$objUser->Login($user,$pass);
					if (isset($response->User) and $response->Login=="NO")
					{
						echo "ACCESO DENEGADO";
					}
					elseif(isset($response->User) and $response->Login=="SI")
					{															
							$_SESSION['SUsu'] = $response->User;
							$_SESSION['SUid'] = $response->Uid;							
							echo "SUCCESS";

					}
					else
					{
						echo "CREDENCIALES ERRADAS";
					}
		
			}
			else
			{
				echo "VARIABLES VACIAS";
			}
	}
	else
	{
		echo "FORMULARIO VACIO";
	}
?>