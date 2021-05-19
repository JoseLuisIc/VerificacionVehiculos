<?php
	
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
			session_start();

		include "../config/config.php";//Contiene funcion que conecta a la base de datos


		$id = $_POST["mod_id"];
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
		$eventini = $_POST["eventini_id"];//22
		$eventdescp = $_POST["eventdescp_id"];//23
		$departamento = $_POST["depa_id"];//24
		$eventfin = $_POST["eventfin_id"];//25

		//Validar después su utilidad:
		//$kind_id = $_SESSION["kind_id"];
		$priority_id = 1;	
		$status_id = 1;

		$sql = "update plantadata 
		set project_id=\"$project_id\",
		category_id=\"$turno\",
		modelo_id=\"$modelo\",
		scrap_id=\"$scrap\",
		semana_id=\"$semana\",
		planta_id=\"$planta\",
		pais_id=\"$pais\",
		linea_id=\"$linea\",
		centro_id =\"$departamento\",
		dia=\"$day\",
		turno_id=\"$turno\",
		timeturno_ini=\"$horainicial\",
		timeturno_fin=\"$horafinal\",
		std_seg=\"$stdseg\",
		produc_estimada=\"$produccionestimada\",
		produc_real=\"$produccionreal\",
		eficiencia=\"$eficiencia\",
		piezas_malas=\"$piezasmalas\",
		desc_scrap=\"$descscrap\",
		costo_std=\"$costostd\",
		costo_total_prod=\"$costototalprd\",
		tiempo_caida_min=\"$tiempomin\",
		event_ini=\"$eventini\",
		event_fin=\"$eventfin\",
		event=\"$eventdescp\",
		updated_at=NOW() where 
		id=$id";

		$query_update = mysqli_query($con,$sql);
		var_dump($sql);
			if ($query_update){
				$messages[] = "El ticket ha sido actualizado satisfactoriamente.";
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