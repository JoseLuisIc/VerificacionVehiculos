<?php
    $projects =mysqli_query($con, "select * from project");
    $priorities =mysqli_query($con, "select * from priority");
    $statuses =mysqli_query($con, "select * from status");
    $kinds =mysqli_query($con, "select * from kind");
    $categories =mysqli_query($con, "select * from category");
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">País                                      <!--Pais label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Planta                                      <!--planta label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proyectoi                                  <!--Proyectoi label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lineas de Producción                        <!--lineas de produccion label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Dia fecha-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Día<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="title" class="form-control" placeholder="Titulo" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Turno                                     <!--Turno label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">                                                                                                 <!--Semana Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Semana<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Semana" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Hora Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Hora" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modelo                                     <!--modelo label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>
                        
                            <div class="form-group">                                                                                                 <!--STD(SEG) Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">STD (seg)<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="STD (seg)" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Produccion estimada Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Producción Estimada<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Producción Estimada" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Produccion Real Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Producción Real<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Producción Real" >
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Eficiencia Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Eficiencia %<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Eficiencia %" >
                            </div>
                        </div>

                       
                        <div class="form-group">                                                                                                 <!--Piezas Malas scarp Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Piezas Malas (scarp)<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Piezas Malas (scarp)" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código Scarp                                     <!--Código scarp label-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="kind_id" >
                                      <?php foreach($kinds as $p):?>
                                        <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                </select>
                            </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción scarp <span class="required">*</span>              <!--Descripcion scarp-->
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea name="description" class="form-control col-md-7 col-xs-12"  placeholder="Descripción"></textarea>
                            </div>
                        </div>

                        <div class="form-group">                                                                                                 <!--Costo/STD Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo/STD<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Costo/STD" >
                            </div>
                        </div>               

                        <div class="form-group">                                                                                                 <!--Costo total de produccion Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Costo Total de producción<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="$$$" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Tiempo caido en minutos campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiempo caído en Minutos<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Tiempo Caído" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Inicio del evento Fecha-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Inicio del evento<span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" name="title" class="form-control" placeholder="Costo/STD" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Evento Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Evento <span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Evento" >
                            </div>
                        </div>      

                        <div class="form-group">                                                                                                 <!--Departamento Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento <span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Departamento" >
                            </div>
                        </div>  

                        <div class="form-group">                                                                                                 <!--Hora final Campo-->
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora final <span class="required">*</span></label>               
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" name="title" class="form-control" placeholder="Hora final" >
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