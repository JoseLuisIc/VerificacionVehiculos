<div class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Nueva Incidencia</h4>
            </div>
            <div class="modal-body">
                <form id="formIncidencia" class="form-horizontal form-label-left input_mask" method="post">
                    <div id="result"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="title" class="form-control col-md-7 col-xs-12" required type="text" placeholder="Titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="status" id="" class="form-control col-md-7 col-xs-12" required>
                                <option value="">Elegir un estatus</option>
                                <option value="A">Abierto</option>
                                <option value="C">Cerrado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="type" class="form-control col-md-7 col-xs-12" required type="text" placeholder="Tipo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Asignado <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="asigned" id="asigned" class="form-control col-md-7 col-xs-12" required>
                                <option value="">Elegir un estatus</option> 
                                <option value="A">Abierto</option>
                                <option value="C">Cerrado</option>
                            </select>   
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ubicacion <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="location" class="form-control col-md-7 col-xs-12" required type="text" placeholder="Ubicacion">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de vencimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="date_update" class="form-control col-md-7 col-xs-12" required type="date" placeholder="Fecha de vencimiento">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de creación: <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="date_create" class="form-control col-md-7 col-xs-12" required type="date" placeholder="Fecha de vencimiento">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de última actualización <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="date_update_end" class="form-control col-md-7 col-xs-12" required type="date" placeholder="Fecha de vencimiento">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Causa Principal <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input name="principal_cause" class="form-control col-md-7 col-xs-12" required type="text" placeholder="Causa Principal">
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