{% extends "base.html" %}

{% block title %}Index{% endblock %}
{% block head %}
    {{ parent() }}
{% endblock %}
{% block content %}
        
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                    {% include 'modal/new_comment.php' %}
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Seguimiento </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- ajax -->
                            <table  class="table table-bordered" id="table-pagination">
                                <thead>
                                    <tr>
                                        <th>COMENTARIO</th>
                                        <th>RESPONSABLE</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="resultados">
                                    {% for seguimiento in seguimientos %}
                                    <tr>
                                        <td>{{seguimiento['comment']}}</td>
                                        <td>
                                            {{seguimiento['user_id']}}
                                        </td>
                                        <td>
                                           <a href="" class='btn btn-default' data-id="{{incidencia['id']}}" title='Editar Projecto'><i class="glyphicon glyphicon-edit"></i></a> 
                                            <a href="#" class='btn btn-default' title='Borrar Projecto' onclick="eliminar({{incidencia['id']}})"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
                                        </td>
                                    </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                            <div class='outer_div'></div><!-- Carga los datos ajax -->
                            <!-- /ajax -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->


{% endblock %}
{% block script %}
    {{ parent() }}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#save_data').click(function(e){
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url:'seguimiento_incidencias/create',
                data: $('#formComment').serialize(),
                beforeSend: function(objeto){
                    $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
                },
                success:function(data){
                    data = JSON.parse(data);
                    if(data.success){
                        $('.bs-example-modal-lg-new').modal('hide');
                        $('#alert').html(data.message)
                        window.location.reload(true);
                    }
                }
            });
        });
    </script>
{% endblock %}