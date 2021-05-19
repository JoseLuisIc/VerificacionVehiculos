<?php
    $title ="Datos | ";
    include "head.php";
    include "sidebar.php";
?>

    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        include("modal/new_plantadata.php");
                        include("modal/upd_plantadata.php");
                    ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Datos Planta</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        
                        <!-- form seach -->
                        <form class="form-horizontal" role="form" id="dato_buscar">
                            <div class="form-group row">
                                <label for="q" class="col-md-2 control-label">SCRAP/Evento</label>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="q" placeholder="Nombre del Dato" onkeyup='load(1);'>
                                </div>
                                <label for="q" class="col-md-2 control-label">Fecha</label>
                                <div class="col-md-2">
                                    <input type="date" id="dia_id" class="form-control" onchange="load(1);" >
                                </div>
                                <label for="q" class="col-md-2 control-label">Turno</label>
                                <div class="col-md-2">
                                <select class="form-control" id="turno_busq" onchange="load(1);">
                                    <option selected="" value="">-- Selecciona --</option>
                                      <?php foreach($categories as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                                </div>
                                <br><br>
                                <label for="q" class="col-md-2 control-label">País</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="pais_id_busq" onchange="load(1);">
                                            <option selected="" value="">-- Selecciona --</option>
                                            <?php foreach($paises as $p):?>
                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <label for="q" class="col-md-2 control-label">Proyecto</label>
                                <div class="col-md-2">
                                        <select class="form-control" id="project_busq" onchange="load(1);">
                                                <option selected="" value="">-- Selecciona --</option>
                                                <?php foreach($projects as $p):?>
                                                <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <label for="q" class="col-md-2 control-label">Departamento</label>
                                <div class="col-md-2">
                                        <select class="form-control" id="departamento_busq" onchange="load(1);">
                                                <option selected="" value="">-- Selecciona --</option>
                                                <?php foreach($departamentos as $p):?>
                                                <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <br><br>
                                <label for="q" class="col-md-2 control-label">Planta</label>
                                <div class="col-md-2">
                                    <select class="form-control" id="planta_busq" onchange="load(1);">
                                            <option selected="" value="">-- Selecciona --</option>
                                            <?php foreach($plantas as $p):?>
                                            <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                                <label for="q" class="col-md-2 control-label">Línea de Producción</label>
                                <div class="col-md-2">
                                        <select class="form-control" id="linea_busq" onchange="load(1);">
                                                <option selected="" value="">-- Selecciona --</option>
                                                <?php foreach($lineas as $p):?>
                                                <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <label for="q" class="col-md-2 control-label">Modelo</label>
                                <div class="col-md-2">
                                        <select class="form-control" id="modelo_busq" onchange="load(1);">
                                                <option selected="" value="">-- Selecciona --</option>
                                                <?php foreach($modelos as $p):?>
                                                <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default" onclick='load(1);'>
                                        <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                    <span id="loader"></span>
                                </div>
                            </div>
                        </form>
                        

                        
                        <!-- end form seach -->


                        <div class="x_content">
                            <div class="table-responsive">
                                <!-- ajax -->
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                <!-- /ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>

<script type="text/javascript" src="js/plantadata.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script>
$("#add").submit(function(event) {
  $('#save_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/addplantadata.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result").html(datos);
            $('#save_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})


$( "#upd" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "action/updplantadata.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

    function obtener_datos(id){

            
            $("#mod_id").val(id);
            
            var pais = $("#pais_id"+id).val();
            $("#mod_pais_id").val(pais);

            var planta = $("#planta_id"+id).val();
            $("#mod_planta_id").val(planta);

            var project = $("#project_id"+id).val();
            $("#mod_project_id").val(project);
            
            var linea = $("#linea_id"+id).val();
            $("#mod_linea_id").val(linea);

            var dia = $("#dia_id"+id).val();
            var diaAux = $("#dia_id_aux"+id).val();
            $("#mod_dia_id").val(diaAux);
            
            var turno = $("#turno_id"+id).val();
            $("#mod_turno_id").val(turno);

            var semana = $("#semana_id"+id).val();
            $("#mod_semana_id").val(semana);

            var horario_inicio = $("#horaini_id"+id).val();
            //alert(horario_inicio);
            $("#mod_horaini_id").val(horario_inicio);

            var horario_fin = $("#horafin_id"+id).val();
            //alert(horario_fin);
            $("#mod_horafin_id").val(horario_fin);

            var modelo = $("#modelo_id"+id).val();
            $("#mod_modelo_id").val(modelo);

            var stdseg = $("#stdseg_id"+id).val();
            $("#mod_stdseg_id").val(stdseg);

            var prodest = $("#prodest_id"+id).val();
            $("#mod_prodest_id").val(prodest);

            var prodreal = $("#prodreal_id"+id).val();
            $("#mod_prodreal_id").val(prodreal);

            var eficiencia = $("#eficiencia_id"+id).val();
            $("#mod_eficiencia_id").val(eficiencia);

            var piezasmalas = $("#piezasmalas_id"+id).val();
            $("#mod_piezasmalas_id").val(piezasmalas);

            var scrap = $("#scrap_id"+id).val();
            $("#mod_scrap_id").val(scrap);

            var description_scrap = $("#descscrap_id"+id).val();
            $("#mod_descscrap_id").val(description_scrap);

            var costostd = $("#costostd_id"+id).val();
            $("#mod_costostd_id").val(costostd);

            var costototalprod = $("#costotalprod_id"+id).val();
            $("#mod_costotalprod_id").val(costototalprod);

            var tiempomin = $("#tiempomin_id"+id).val();
            $("#mod_tiempomin_id").val(tiempomin);

            var event_ini = $("#eventini_id"+id).val();
            $("#mod_eventini_id").val(event_ini);

            var event_descp = $("#eventdescp_id"+id).val();
            $("#mod_eventdescp_id").val(event_descp);

            var departamento = $("#depa_id"+id).val();
            $("#mod_depa_id").val(departamento);

            var event_fin = $("#eventfin_id"+id).val();
            $("#mod_eventfin_id").val(event_fin);
        }

</script>