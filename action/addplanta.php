<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['name'])) {
           $errors[] = "Nombre está vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Descripción está vacío";
		} else if (empty($_POST['estado'])){
			$errors[] = "Estado está vacío";
		}else if (empty($_POST['cp'])){
			$errors[] = "Codigo Postal está vacío";
		}else if (empty($_POST['ciudad'])){
			$errors[] = "Codigo Postal está vacío";
		}else if (
			!empty($_POST['name']) &&
			!empty($_POST['description'])
		){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$name = $_POST["name"];
		$description = $_POST["description"];
		$estado = $_POST["estado"];
		$cp = $_POST["cp"];
		$ciudad = $_POST["ciudad"];


		$sql="insert into planta (name, description, ciudad,estado, cp) value (\"$name\",\"$description\",\"$ciudad\",\"$estado\",\"$cp\")";
		var_dump($sql);
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu proyecto ha sido ingresado satisfactoriamente.";
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