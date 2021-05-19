<?php

    include "../config/config.php";//Contiene funcion que conecta a la base de datos
    
    $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if (isset($_GET['id'])){
        $id_del=intval($_GET['id']);
        $query=mysqli_query($con, "SELECT * from plantadata where id='".$id_del."'");
        $count=mysqli_num_rows($query);

            if ($delete1=mysqli_query($con,"DELETE FROM plantadata WHERE id='".$id_del."'")){
?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
        <?php 
            }else {
        ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
                </div>
    <?php
            } //end else
        } //end if
    ?>

<?php
    if($action == 'ajax'){
        // escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
         $t = mysqli_real_escape_string($con,(strip_tags($_REQUEST['turno_id_ajax'], ENT_QUOTES)));
         $q2 = mysqli_real_escape_string($con,(strip_tags($_REQUEST['dia_ajax'], ENT_QUOTES)));
         $paiz = mysqli_real_escape_string($con,(strip_tags($_REQUEST['pais_id_ajax'], ENT_QUOTES))); 
         $plan = mysqli_real_escape_string($con,(strip_tags($_REQUEST['planta_ud'], ENT_QUOTES))); 
         
         $proj = mysqli_real_escape_string($con,(strip_tags($_REQUEST['project_busq'], ENT_QUOTES)));
         $depaz = mysqli_real_escape_string($con,(strip_tags($_REQUEST['departamento_busq'], ENT_QUOTES)));
         $line = mysqli_real_escape_string($con,(strip_tags($_REQUEST['linea_busq'], ENT_QUOTES)));
         $modelo_busq = mysqli_real_escape_string($con,(strip_tags($_REQUEST['modelo_busq'], ENT_QUOTES)));
         $q2 = $q2.' 00:00:00';
         if ( $_GET['q'] != "" )
            $aColumns = array('event','desc_scrap');//Columnas de busqueda

        if ( $_GET['dia_ajax'] != "" )
            $aColumns = array('dia');//Columnas de busqueda

        if ( $_GET['turno_id_ajax'] != "" )
            $aColumns = array('turno_id');//Columnas de busqueda

        if ( $_GET['pais_id_ajax'] != "" )
            $aColumns = array('pais_id');//Columnas de busqueda

        if ( $_GET['planta_ud'] != "" )
            $aColumns = array('planta_id');//Columnas de busqueda

        if ( $_GET['project_busq'] != "" )
            $aColumns = array('project_id');//Columnas de busqueda

        if ( $_GET['departamento_busq'] != "" )
            $aColumns = array('centro_id');//Columnas de busqueda

        if ( $_GET['linea_busq'] != "" )
            $aColumns = array('linea_id');//Columnas de busqueda

        if ( $_GET['modelo_busq'] != "" )
            $aColumns = array('modelo_id');//Columnas de busqueda


        if ( $_GET['q'] != "" && $_GET['dia_ajax'] != "" )
            $aColumns = array('event','desc_scrap','dia');//Columnas de busqueda
        
        if ( $_GET['pais_id_ajax'] != "" && $_GET['dia_ajax'] != "" )
            $aColumns = array('pais_id','dia');//Columnas de busqueda
        
        if ( $_GET['q'] != "" && $_GET['pais_id_ajax'] != "" )
            $aColumns = array('event','desc_scrap','pais_id');//Columnas de busqueda
        
        if ( $_GET['q'] != "" && $_GET['dia_ajax'] != "" && $_GET['pais_id_ajax'] != ""  )
            $aColumns = array('event','desc_scrap','dia','pais_id');//Columnas de busqueda

        if ( $_GET['turno_id_ajax'] != "" && $_GET['dia_ajax'] != "" )
            $aColumns = array('turno_id','dia');//Columnas de busqueda
        
        if ( $_GET['turno_id_ajax'] != "" && $_GET['dia_ajax'] != "" && $_GET['pais_id_ajax'] != "" )
            $aColumns = array('turno_id','dia','pais_id');//Columnas de busqueda
        
        if ( $_GET['q'] != "" && $_GET['turno_id_ajax'] != "" )
            $aColumns = array('event','desc_scrap','turno_id');//Columnas de busqueda

        if ( $_GET['q'] != "" && $_GET['dia_ajax'] != "" && $_GET['turno_id_ajax'] != "" )
            $aColumns = array('event','desc_scrap','dia','turno_id');//Columnas de busqueda
        
        if ( $_GET['q'] != "" && $_GET['dia_ajax'] != "" && $_GET['turno_id_ajax'] != "" && $_GET['pais_id_ajax'] != "" )
            $aColumns = array('event','desc_scrap','dia','turno_id','pais_id');//Columnas de busqueda
         
         $sTable = "plantadata";
         $sWhere = "";
        if ( $_GET['q'] != "" || 
        $_GET['dia_ajax'] != "" || 
        $_GET['turno_id_ajax'] != "" || 
        $_GET['pais_id_ajax'] != "" || 
        $_GET['planta_ud'] != "" ||
        $_GET['project_busq'] != "" ||
        $_GET['departamento_busq'] != "" ||
        $_GET['linea_busq'] != "" ||
        $_GET['modelo_busq'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if($_GET['q'] != "")
                    $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
                if($_GET['dia_ajax'])
                    $sWhere .= $aColumns[$i]." LIKE '%".$q2."%' OR ";
                if($_GET['turno_id_ajax'])
                    $sWhere .= $aColumns[$i]." LIKE '%".$t."%' OR ";
                if($_GET['pais_id_ajax'])
                    $sWhere .= $aColumns[$i]." LIKE '%".$paiz."%' OR ";
                if($_GET['planta_ud'])
                    $sWhere .= $aColumns[$i]." LIKE '%".$plan."%' OR ";

                if ( $_GET['project_busq'] != "" )
                    $sWhere .= $aColumns[$i]." LIKE '%".$proj."%' OR ";

                if ( $_GET['departamento_busq'] != "" )
                    $sWhere .= $aColumns[$i]." LIKE '%".$depaz."%' OR ";
        
                if ( $_GET['linea_busq'] != "" )
                    $sWhere .= $aColumns[$i]." LIKE '%".$line."%' OR ";

                if ( $_GET['modelo_busq'] != "" )
                    $sWhere .= $aColumns[$i]." LIKE '%".$modelo_busq."%' OR ";

            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
        $sWhere.=" order by created_at desc";
        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $qery = "SELECT count(*) AS numrows FROM $sTable  $sWhere";
        //var_dump($qery); //Imprime la consulta
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './plantadata.php';
        //main query to fetch the data
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data
        if ($numrows>0){
            
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Pais </th>
                        <th class="column-title">Planta</th>
                        <th class="column-title">Proyecto</th>
                        <th class="column-title">Linea de Producción</th>
                        <th class="column-title">Dia</th>
                        <th class="column-title" NOWRAP>Turno</th>
                        <th class="column-title">Semana</th>
                        <th class="column-title" NOWRAP>Hora Inicio - Hora Fin</th>
                        <th class="column-title">Modelo</th>
                        <th class="column-title">std(seg)</th>

                        <th class="column-title">Produccion estimada</th>
                        <th class="column-title">Produccion real</th>
                        <th class="column-title">Eficiencia %</th>
                        <th class="column-title">Piezas Malas (Scrap)</th>
                        <th class="column-title">Código scrap</th>
                        <th class="column-title">Descripción scrap</th>
                        <th class="column-title">Costo/STD </th>
                        <th class="column-title">Costo Total(Scrap)</th>
                        <th class="column-title">Tiempo Caido(min)</th>
                        <th class="column-title">Inicio del evento</th>
                        <th class="column-title">Evento</th>
                        <th class="column-title">Departamento</th>
                        <th class="column-title">Fin del Evento</th>
                        <th class="column-title">Creado Por:</th>
                        

                        <!--
                        Produccion estimada
                        Produccion real	
                        Eficiencia %	
                        Piezas Malas (Scrap)	
                        Código scrap	
                        Descripción scrap	 
                        Costo/STD 	
                        Costo total del scrap	
                        Tiempo caido en minutos	
                        Inicio de evento	
                        Evento	
                        Departamento	
                        Hora Final
                        -->
                        <th>Fecha Creación</th>
                        <th>Última Actualización</th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                        while ($r=mysqli_fetch_array($query)) {
                           
                            $id=$r['id'];
                            $created_at=date('d/m/Y', strtotime($r['created_at']));
                            $updated_at=date('d/m/Y', strtotime($r['updated_at']));
                            $pais_id=$r['pais_id'];
                            $planta_id=$r['planta_id'];
                            $project_id=$r['project_id'];
                            $linea_id=$r['linea_id'];

                            
                            //var_dump($date1);

                            $diaAux=date_create($r['dia']);
                            $dia = date_format($diaAux, 'd/m/Y');
                            $date1 = date_format($diaAux, 'Y-m-d');

                            $turno_id=$r['category_id'];
                            $semana_id=$r['semana_id'];

                            $timeini=date_create($r['timeturno_ini']);
                            $timefin=date_create($r['timeturno_fin']);
                            /*Doy formato para tiempo inicio y fin */
                            $timeturno_ini = date_format($timeini, 'g:i A');
                            $timeturno_fin = date_format($timefin, 'g:i A');
                            $timeturno_ini1 = date_format($timeini, 'H:i');
                            $timeturno_fin2 = date_format($timefin, 'H:i');

                            $modelo_id=$r['modelo_id'];
                            $scrap_id = $r['scrap_id'];
                            $std_seg=$r['std_seg'];
                            
                            
                            $produc_estimada=$r['produc_estimada'];
                            $produc_real=$r['produc_real'];
                            $eficiencia=$r['eficiencia'];
                            $piezas_malas=$r['piezas_malas'];
                            $desc_scrap=$r['desc_scrap'];
                            $costo_std=$r['costo_std'];
                            $costo_total_prod=$r['costo_total_prod'];
                            $tiempo_caida_min=$r['tiempo_caida_min'];

                            $event_ini=$r['event_ini'];
                            $event_fin=$r['event_fin'];

                            $event_ini=date('g:i A', strtotime($r['event_ini']));
                            $event_fin=date('g:i A', strtotime($r['event_fin']));

                            $timeini_1=date_create($r['event_ini']);
                            $timefin_2=date_create($r['event_fin']);
                            $event_ini1 = date_format($timeini_1, 'H:i');
                            $event_fin2 = date_format($timefin_2, 'H:i');

                            $event=$r['event'];
                            $departamento=$r['centro_id'];
                            $user_id=$r['user_id'];

                            $priority_id=$r['priority_id'];
                            $status_id=$r['status_id'];
                            $kind_id=$r['kind_id'];
                            $category_id=$r['category_id'];

                            $sql = mysqli_query($con, "select * from pais where id=$pais_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_pais=$c['name'];
                            }

                            

                            $sql = mysqli_query($con, "select * from planta where id=$planta_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_planta=$c['name'];
                            }


                            $sql = mysqli_query($con, "select * from project where id=$project_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_project=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from linea where id=$linea_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_linea=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from category where id=$turno_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_turno=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from semana where id=$semana_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_semana=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from modelo where id=$modelo_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_modelo=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from centro where id=$departamento");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_departamento=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from user where id=$user_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_user=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from priority where id=$priority_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_priority=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from scrap where id=$scrap_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_scrap=$c['name'];
                            }

                            $sql = mysqli_query($con, "select * from status where id=$status_id");
                            if($c=mysqli_fetch_array($sql)) {
                                $name_status=$c['name'];
                            }


                ?>
                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $pais_id;?>" id="pais_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $planta_id;?>" id="planta_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $project_id;?>" id="project_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $linea_id;?>" id="linea_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $dia;?>" id="dia_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $date1;?>" id="dia_id_aux<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $turno_id;?>" id="turno_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $semana_id;?>" id="semana_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $timeturno_ini1;?>" id="horaini_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $timeturno_fin2;?>" id="horafin_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $modelo_id;?>" id="modelo_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $std_seg;?>" id="stdseg_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $produc_estimada;?>" id="prodest_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $produc_real;?>" id="prodreal_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $eficiencia;?>" id="eficiencia_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $piezas_malas;?>" id="piezasmalas_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $scrap_id;?>" id="scrap_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $desc_scrap;?>" id="descscrap_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $costo_std;?>" id="costostd_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $costo_total_prod;?>" id="costotalprod_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $tiempo_caida_min;?>" id="tiempomin_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $event_ini1;?>" id="eventini_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $event;?>" id="eventdescp_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $departamento;?>" id="depa_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $event_fin2;?>" id="eventfin_id<?php echo $id;?>">
                    

                    

                    <!-- me obtiene los datos 
                    <input type="hidden" value="<?php echo $kind_id;?>" id="kind_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $project_id;?>" id="project_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $priority_id;?>" id="priority_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id;?>">
                    -->

                    <tr class="even pointer">
                        <td><?php echo $name_pais;?></td>
                        <td><?php echo $name_planta; ?></td>
                        <td><?php echo $name_project; ?></td>
                        <td><?php echo $name_linea;?></td>
                        <td><?php echo $dia;?></td>
                        <td NOWRAP><?php echo $name_turno;?></td>
                        <td><?php echo $name_semana;?></td>
                        <td><?php echo $timeturno_ini." - ".$timeturno_fin?></td>
                        <td><?php echo $name_modelo;?></td>
                        <td><?php echo $std_seg;?></td>
                        <td><?php echo $produc_estimada;?></td>
                        <td><?php echo $produc_real;?></td>
                        <td><?php echo $eficiencia;?></td>
                        <td><?php echo $piezas_malas;?></td>
                        <td><?php echo $name_scrap;?></td>
                        <td NOWRAP><?php echo $desc_scrap;?></td>
                        <td><?php echo $costo_std;?></td>
                        <td><?php echo $costo_total_prod;?></td>
                        <td><?php echo $tiempo_caida_min;?></td>
                        <td NOWRAP><?php echo $event_ini;?></td>
                        <td NOWRAP><?php echo $event;?></td>
                        <td><?php echo $name_departamento;?></td>
                        <td NOWRAP><?php echo $event_fin;?></td>
                        <td NOWRAP><?php echo $name_user;?></td>
                        <td><?php echo $created_at;?></td>
                        <td><?php echo $updated_at;?></td>

                        <td ><span class="pull-right">
                        <a href="#" class='btn btn-default' title='Editar Dato' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar Dato' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                    </tr>
                <?php
                    } //end while
                ?>
                <tr>
                    <td colspan=29><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar!
            </div>
        <?php    
        }
    }
?>