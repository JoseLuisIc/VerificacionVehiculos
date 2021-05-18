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
         $aColumns = array('title');//Columnas de busqueda
         $sTable = "plantadata";
         $sWhere = "";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
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

                            $diaAux=date_create($r['dia']);
                            $dia = date_format($diaAux, 'd/m/Y');

                            $turno_id=$r['category_id'];
                            $semana_id=$r['semana_id'];

                            $timeini=date_create($r['timeturno_ini']);
                            $timefin=date_create($r['timeturno_fin']);
                            /*Doy formato para tiempo inicio y fin */
                            $timeturno_ini = date_format($timeini, 'g:i A');
                            $timeturno_fin = date_format($timefin, 'g:i A');

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

                    <!-- me obtiene los datos -->
                    <input type="hidden" value="<?php echo $kind_id;?>" id="kind_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $project_id;?>" id="project_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $category_id;?>" id="category_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $priority_id;?>" id="priority_id<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $status_id;?>" id="status_id<?php echo $id;?>">


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
                        <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-udp"><i class="glyphicon glyphicon-edit"></i></a> 
                        <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
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