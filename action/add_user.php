<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Añade un Nombre para continuar.";
        } else if (empty($_POST['lastname'])){
			$errors[] = "Añade un Apellido para continuar.";
		}else if (empty($_POST['email'])){
			$errors[] = "Añade un Correo para continuar.";
		} else if ($_POST['status']==""){
			$errors[] = "Añade un estatus para continuar.";
		} else if (empty($_POST['password'])){
			$errors[] = "Añade una contraseña para continuar.";
		} else if (empty($_POST['phone'])){
			$errors[] = "Añade un teléfono para continuar.";
		} else if (empty($_POST['kinduser'])){
			$errors[] = "Añade un tipo de usuario para continuar.";
		}  else if (
			!empty($_POST['name']) &&
			!empty($_POST['lastname']) &&
			$_POST['status']!="" &&
			!empty($_POST['password']) &&
			!empty($_POST['phone'])&&
			!empty($_POST['kinduser'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$name=mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
		$lastname=mysqli_real_escape_string($con,(strip_tags($_POST["lastname"],ENT_QUOTES)));
		$email=$_POST["email"];
		$password=mysqli_real_escape_string($con,(strip_tags(sha1(md5($_POST["password"])),ENT_QUOTES)));
		$status=intval($_POST['status']);
		$end_name=$name." ".$lastname;
		$created_at=date("Y-m-d H:i:s");
		$user_id=$_SESSION['user_id'];
		$profile_pic="default.png";
		$username=$_POST["username"];
		$phone=$_POST["phone"];
		$kinduser=$_POST["kinduser"];

		$is_admin=0;
		if(isset($_POST["is_admin"])){$is_admin=1;}

			$sql="INSERT INTO user (username, name, password, email, profile_pic, is_active, created_at, phone, kind) 
			VALUES ('$username','$end_name','$password','$email','$profile_pic',$status,'$created_at','$phone','$kinduser')";
			
			$query_new_insert = mysqli_query($con,$sql);
				if ($query_new_insert){
					$messages[] = "El usuario ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
			
		}else{
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