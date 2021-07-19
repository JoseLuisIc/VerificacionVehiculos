    <div> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Agregar</button>
    </div>
    <div class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Comentario</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left input_mask" method="post" id="formComment">
                        <div id="result"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentario <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input value="{{incidencia['id']}}" type="hidden" name="id"/>
                                <textarea name="comment" class="form-control col-md-7 col-xs-12">
                                </textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->