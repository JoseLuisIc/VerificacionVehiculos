<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['pais_id'])) {
           $errors[] = "Por favor, seleccione un País.";
        } else if (empty($_POST['planta_id'])){
			$errors[] = "Por favor, seleccione una Planta.";
		} else if (empty($_POST['project_id'])){
			$errors[] = "Por favor, seleccione un Proyecto.";
		} else if (empty($_POST['linea_id'])){
			$errors[] = "Por favor, seleccione una Línea de Producción.";
		} else if (empty($_POST['dia_id'])){
			$errors[] = "Por favor, seleccione una Fecha.";
		}else if (
			!empty($_POST['pais_id']) &&
			!empty($_POST['planta_id'])
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		/*$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		$user_id = $_SESSION["user_id"];
		$status_id = $_POST["status_id"];
		$kind_id = $_POST["kind_id"];
		$created_at="NOW()";
		*/
		// $user_id=$_SESSION['user_id'];
		$created_at="NOW()";
		$updated_at="NOW()";
		$user_id = $_SESSION["user_id"];
		$pais = $_POST["pais_id"];//1
		$planta = $_POST["planta_id"];//2
		$project_id  = $_POST["project_id"];//3
		$linea = $_POST["linea_id"];//4
		$day = $_POST["dia_id"];//5
		$turno = $_POST["turno_id"];//6
		$semana = $_POST["semana_id"];//7
		$horainicial = $_POST["horaini_id"];//8
		$horafinal = $_POST["horafin_id"];//9
		$modelo = $_POST["modelo_id"];//10
		$stdseg = $_POST["stdseg_id"];//11
		$produccionestimada = $_POST["prodest_id"];//12
		$produccionreal = $_POST["prodreal_id"];//13
		$eficiencia = $_POST["eficiencia_id"];//14
		$piezasmalas = $_POST["piezasmalas_id"];//15
		$eficiencia = $_POST["eficiencia_id"];//16
		$scrap = $_POST["scrap_id"];//17
		$descscrap = $_POST["descscrap_id"];//18
		$costostd = $_POST["costostd_id"];//19
		$costototalprd = $_POST["costotalprod_id"];//20
		$tiempomin = $_POST["tiempomin_id"];//21
		if(empty($tiempomin)){
			$tiempomin = 0;
		}
		$eventini = $_POST["eventini_id"];//22
		$eventdescp = $_POST["eventdescp_id"];//23
		$departamento = $_POST["depa_id"];//24
		$eventfin = $_POST["eventfin_id"];//25

		//Validar después su utilidad:
		$kind_id = $_SESSION["kind_id"];
		$priority_id = 1;	
		$status_id = 1;
		//$sql="insert into ticket (title,description,category_id,project_id,priority_id,user_id,status_id,kind_id,created_at) value (\"$title\",\"$description\",\"$category_id\",\"$project_id\",$priority_id,$user_id,$status_id,$kind_id,$created_at)";
		$sql=
		"insert into plantadata ( updated_at,
		created_at,
		kind_id, 
		user_id, 
		createdby_id,
		project_id, 
		category_id,
		priority_id,
		status_id, 
		modelo_id, 
		scrap_id, 
		semana_id,
		planta_id,
		pais_id, 
		linea_id, 
		centro_id,
		dia,
		turno_id,
		timeturno_ini,
		timeturno_fin, 
		std_seg, 
		produc_estimada,
		produc_real, 
		eficiencia,
		piezas_malas, 
		desc_scrap,
		costo_std,
		costo_total_prod,
		tiempo_caida_min,
		event_ini, 
		event_fin, 
		event ) 
		value ($updated_at,
		$created_at,
		\"$kind_id\",
		\"$user_id\",
		\"$user_id\",
		\"$project_id\",
		\"$turno\",
		$priority_id,
		$status_id,
		$modelo,
		$scrap,
		$semana,
		$planta,
		\"$pais\",
		$linea,
		$departamento,
		\"$day\",
		$turno,
		\"$horainicial\",
		\"$horafinal\",
		$stdseg,
		$produccionestimada,
		$produccionreal,
		$eficiencia,
		$piezasmalas,
		\"$descscrap\",
		$costostd,
		$costototalprd,
		$tiempomin,
		\"$eventini\",
		\"$eventfin\",
		\"$eventdescp\")";
		//var_dump($sql);
		$query_new_insert = mysqli_query($con,$sql);
		var_dump($sql);
			if ($query_new_insert){
				$messages[] = "Tus Datos han sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido. Contacta al administrador.";
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