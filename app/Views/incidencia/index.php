{% extends "base.html" %}

{% block title %}
Index
{% endblock %}
{% block head %}
    {{ parent() }}
{% endblock %}
{% block content %}
        
    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12"> 
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Incidencias </h2>
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
                                        <th>ACCIÓN (DESCRIPCIÓN DE LA TAREA)</th>
                                        <th>RESPONSABLE</th>
                                        <th>FECHA</th>
                                        <th>STATUS</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="resultados">
                                    {% for incidencia in incidencias %}
                                    <tr>
                                        <td>
                                            {{incidencia['title']}}
                                        </td>
                                        <td>{{incidencia['asigned']}}</td>
                                        <td>{{incidencia['date_create']}}</td>
                                        <td>{{incidencia['status']}}</td>
                                        <td>
                                            <a href="seguimieto_incidencias?id={{incidencia['id']}}" class='btn btn-default' data-id="{{incidencia['id']}}" title='Editar Projecto'><i class="glyphicon glyphicon-edit"></i></a> 
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
        $(document).ready( function () {
            $('#table-pagination').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
            });
        });
        function obtener_datos(id){
        }
        function eliminar (id)
        {    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    /*$.ajax({
                        type: "POST",
                        url: "incidencia/delete",
                        data: {id : id},
                        beforeSend: function(objeto){

                        },
                        success: function(datos){
                            
                        }
                    });*/
                    
                }
            })
        }

    </script>
{% endblock %}