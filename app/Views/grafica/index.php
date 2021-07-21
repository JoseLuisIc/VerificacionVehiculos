{% extends "base.html" %}

{% block title %}Index{% endblock %}
{% block head %}
    {{ parent() }}
{% endblock %}
{% block content %}
<div class="right_col" role="main">    
    <form action="filter" id="formFilter">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Fecha de incio
                    </label>
                    <input name="fecha_ini" class="form-control" required type="date" placeholder="Fecha de vencimiento">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Fecha de fin
                    </label>
                    <input name="fecha_fin" class="form-control" required type="date" placeholder="Fecha de vencimiento">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Proyecto
                    </label>
                    <select name="proyecto" id="proyecto" class="form-control">
                        <option value="1" selected>Seleccionar</option>
                        <option value="2">Toyot</option>
                        <option value="3">Draexlmaier</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Turno
                    </label>
                    <select name="turno" id="turno" class="form-control">
                        <option value="1" selected>Seleccionar</option>
                        <option value="2">Turno 1</option>
                        <option value="3">Turno 2</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <button class="btn btn-success" type="submit"> Filtrar</button>
                </div>
            </div>
        </div>  
    </form>      
    <div  class="row">
        <div id="alert"></div>
        <div class="col-md-6">
            <div id="container">
            </div>
        </div>
        <div class="col-md-6">
            <div id="container2">
            </div>
        </div>
    </div>
    <div  class="row">
        <div class="col-md-6">
            <div id="divTable">
                <div> <center>Mes/Semana</center></div>
                <table class="table table-bordered">
                    <thead>
                        <tr id="trDinamico"></tr>
                    </thead>
                    <tbody id="tbodyDinamico">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="float-right"> 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Agregar Accion</button>
            </div>

            <table  class="table table-bordered">
                <thead>
                    <tr>
                        <th>ACCIÓN (DESCRIPCIÓN DE LA TAREA)</th>
                        <th>RESPONSABLE</th>
                        <th>FECHA</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    {% for incidencia in incidencias %}
                    <tr>
                        <td>
                        {{incidencia['principal_cause']}}
                        </td>
                        <td>{{incidencia['asigned']}}</td>
                        <td>{{incidencia['date_create']}}</td>
                        <td>{{incidencia['status']}}</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
        {% include 'modal/new_incidencia.php' %}
   
</div>

{% endblock %}
{% block script %}
    {{ parent() }}
<script type='text/javascript' src="{{ asset('js/graficas.js')}}">
</script>
{% endblock %}