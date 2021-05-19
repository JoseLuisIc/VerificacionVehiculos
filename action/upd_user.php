<?php	

	
	session_start();
	include "../config/config.php";//Contiene funcion que conecta a la base de datos
	function validarEmailRep($varEmail,$con){
		//include "../config/config.php";
		$sql="SELECT count(*) as email_ex FROM user where email = '".$varEmail."'"; 
		//echo $sql;
		$resultado = mysqli_query($con,$sql);
		while($row = $resultado->fetch_assoc()){
			$query_exist_email = $row['email_ex'];
		}
		//echo $query_exist_email;
		if ($query_exist_email>1){
					return false;
		} else{
					return true;
		}
	}
	if (empty($_POST['mod_name'])) {
           $errors[] = "Por favor, añade un nombre para continuar.";
        }else if (empty($_POST['mod_email'])){
			$errors[] = "Por favor añade un correo válido para continuar.";
		} else if(!validarEmailRep($_POST['mod_email'],$con)){
			$errors[] = "El correo y usuario ya existe, favor de validar con el administrador o ingresa otro correo.";
		} else if ($_POST['mod_status']==""){
			$errors[] = "Selecciona el estado";
		}else if (
			!empty($_POST['mod_name']) &&
			!empty($_POST['mod_email']) &&
			$_POST['mod_status']!="" &&
			$_POST['mod_kinduser']!="" &&
			$_POST['mod_username'] !=""
		){

		

		$name=mysqli_real_escape_string($con,(strip_tags($_POST["mod_name"],ENT_QUOTES)));
		$email=$_POST["mod_email"];
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$status=intval($_POST['mod_status']);
		$id=$_POST['mod_id'];
		/*Inicio: Se recupera la información del tipo JLCI 20/02/2021*/
		$kinduser=intval($_POST['mod_kinduser']);
		/*Termina: Se recupera la información del tipo JLCI 20/02/2021*/
		/*Inicio: Se recupera la información del username JLCI 26/02/2021*/
		$username=$_POST['mod_username'];
		$telefono = $_POST['mod_phone'];

		$sql="UPDATE user SET username=\"$username\",name=\"$name\",phone=\"$telefono\",kind=$kinduser, email=\"$email\",is_active=$status  WHERE id=$id";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Datos actualizados satisfactoriamente.";

				// update password by abisoft
				if($_POST["password"]!=""){
					$update_passwd=mysqli_query($con,"update user set password=\"$password\" where id=$id");
					if ($update_passwd) {
						$messages[] = " Y la Contraseña ah sido actualizada.";
					}
				}

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>