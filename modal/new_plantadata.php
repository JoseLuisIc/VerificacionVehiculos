<script>

function PasarValor()
{
      let prodest_id = document.getElementById("prodest_id").value;
      let prodreal_id = document.getElementById("prodreal_id").value;
      let eficiencia_id = Math.round((prodreal_id/prodest_id)*100);
      document.getElementById("eficiencia_id").value = eficiencia_id;
}
  //eventini_id
  //eventfin_id
function CalculaMinutos() {
  //alert("ok");
  let inicio = "2021/05/13 "+document.getElementById("eventini_id").value;
  let fin = "2021/05/13 "+document.getElementById("eventfin_id").value;
  
  var startTime = new Date(inicio); 
  var endTime = new Date(fin);
  var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
  var resultInMinutes = Math.round(difference / 60000);
  document.getElementById("tiempomin_id").value = resultInMinutes;

}
</script>

<?php
    $projects =mysqli_query($con, "select * from project");
    $priorities =mysqli_query($con, "select * from priority");
    $statuses =mysqli_query($con, "select * from status");
    $kinds =mysqli_query($con, "select * from kind");
    $categories =mysqli_query($con, "select * from category");
    $paises =mysqli_query($con, "select * from pais");
    $plantas =mysqli_query($con, "select * from planta");
    $lineas =mysqli_query($con, "select * from linea");
    $semanas =mysqli_query($con, "select * from semana");
    $modelos =mysqli_query($con, "select * from modelo");
    $scraps =mysqli_query($con, "select * from scrap");
    $departamentos =mysqli_query($con, "select * from centro");
?>

    <div> <!-- Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Agregar Datos</button>
    </div>

    <div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Datos</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="add" name="add">
                        <div id="result"></div>

                        <div class="form-group">
                        <!-- Neri Start -->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pais">País                                      <!--Pais label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="pais_id" >
                                      <?php foreach($paises as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="plantas">Planta                                      <!--planta label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="planta_id" >
                                      <?php foreach($plantas as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project">Proyecto                                  <!--Proyectoi label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="project_id" >
                                      <?php foreach($projects as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="linea">Lineas de Producción                        <!--lineas de produccion label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="linea_id" >
                                      <?php foreach($lineas as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Dia fecha-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Día<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="dia_id" class="form-control" placeholder="Titulo" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="turno">Turno                                     <!--Turno label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="turno_id" >
                                      <?php foreach($categories as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">                                                                                                 <!--Semana Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Semana<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="semana_id" >
                                      <?php foreach($semanas as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Hora Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Inicio Turno<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input  type="time" name="horaini_id" class="form-control" placeholder="Hora" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Hora Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fin Turno<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input  type="time" name="horafin_id" class="form-control" placeholder="Hora" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelo">Modelo                                     <!--modelo label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="modelo_id" >
                                      <?php foreach($modelos as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--STD(SEG) Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">STD (seg)<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="stdseg_id" class="form-control" placeholder="STD (seg)" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Produccion estimada Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Producción Estimada<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="prodest_id" id="prodest_id" class="form-control" placeholder="Producción Estimada" >
                            </div>
                        </div>
                        
                        <div class="form-group">                                                                                                 <!--Produccion Real Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Producción Real<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input onkeyup="PasarValor();" type="number" name="prodreal_id" id="prodreal_id" class="form-control" placeholder="Producción Real" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Eficiencia Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Eficiencia %<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input readonly type="number" min="0" max="10000" id="eficiencia_id" name="eficiencia_id" class="form-control" placeholder="Eficiencia %" >
                            </div>
                        </div>

                       
                        <div class="form-group">                                                                                                 <!--Piezas Malas scarp Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Piezas Malas(SCRAP)<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" name="piezasmalas_id" class="form-control" placeholder="Piezas Malas (scrap)" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="scrap">Código Scrap                                     <!--Código scarp label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="scrap_id" >
                                      <?php foreach($scraps as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción scarp <span class="required">*</span>              <!--Descripcion scarp-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="descscrap_id" class="form-control col-md-7 col-xs-12"  placeholder="Descripción"></textarea>
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Costo/STD Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo/STD<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" min="0" step="any" name="costostd_id" class="form-control" placeholder="Costo/STD" >
                            </div>
                        </div>               

                        <div class="form-group">                                                                                                 <!--Costo total de produccion Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo Total de producción<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="number" min="0" step="any" name="costotalprod_id" class="form-control" placeholder="$$$" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Tiempo caido en minutos campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiempo Caído(Minutos)<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input readonly  type="number" min="0" step="any" id="tiempomin_id" name="tiempomin_id" class="form-control" placeholder="Tiempo Caído" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Inicio del evento Fecha-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora Inicial del evento<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="time" name="eventini_id" id="eventini_id" class="form-control" placeholder="Inicio" >
                            </div>
                        </div>      
                        
                        <div class="form-group">                                                                                                 <!--Evento Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Evento <span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="eventdescp_id" class="form-control" placeholder="Descripción del Evento" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Departamento Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento <span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="depa_id" >
                                      <?php foreach($departamentos as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  

                        <div class="form-group">                                                                                                 <!--Hora final Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora Final del Evento<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="time" onchange="CalculaMinutos();" name="eventfin_id" id="eventfin_id" class="form-control" placeholder="Hora final" >
                            </div>
                        </div>  


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                              <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div> 

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div> <!-- /Modal -->