<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use App\Models\Incidencia;
use App\Models\GraficTable;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class GraficaController extends \Core\Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        include "config/config.php";
        include "config/database.php";
        $this->middleware('admin');
    }
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $id=$_SESSION['user_id'];
        $user = User::findOrFail($id);
        $incidencias = Incidencia::limit(5)->get();
        $data = array(
            'user' => $user,
            'incidencias' => $incidencias
        );
        View::renderTemplate('grafica/index.php',$data);
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function createAction()
    {
        $incidencia = new Incidencia();
        $incidencia->title = $_REQUEST['title'];
        $incidencia->status = $_REQUEST['status'];
        $incidencia->type = $_REQUEST['type'];
        $incidencia->asigned = $_REQUEST['asigned'];
        $incidencia->location = $_REQUEST['location'];
        $incidencia->date_update = $_REQUEST['date_update'];
        $incidencia->date_create = $_REQUEST['date_create'];
        $incidencia->date_update_end = $_REQUEST['date_update_end'];
        $incidencia->principal_cause = $_REQUEST['principal_cause'];
        $incidencia->save();
        $data = array(
            'success' => true,
            'message' => '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <strong>Exito!</strong> Se creo correctamente el registro
            </div>'
        );
        echo json_encode($data);
    }
    public function datasAction()
    {
        if(isset($_POST)){
            $number = $_POST['number'];
            $name = $_POST['name'];
            $year = $_POST['year'];
            $type = $_POST['_type'];
            $element = $_POST['element'];

            $grafica = GraficTable::where('name','=',$name)->
            where('year','=',$year)->
            where('type','=',$type)->
            where('element','=',$element)->
            first();
            $data = array(
                'success' => true,
                'message' => '<div class="alert alert-success alert-dismissible fade in" role="alert">
                <strong>Exito!</strong> Se creo correctamente el registro
                </div>',
                'data' => $grafica
            );

            echo json_encode($data);
            
        }
        
    }
    public function saveGraficAction()
    {
        if(isset($_POST['id']) && $_POST['id'] == 0){
            $grafic_table = new GraficTable();
            $grafic_table->element = $_POST['element'];
            $grafic_table->name = $_POST['name'];
            $grafic_table->type = $_POST['type'];
            $grafic_table->color = $_POST['color'];
            $grafic_table->year = $_POST['year'];
            $grafic_table->save();
        }else{
            $grafic_table = GraficTable::findOrFail($_POST['id']);
            $grafic_table->element = $_POST['element'];
            $grafic_table->name = $_POST['name'];
            $grafic_table->type = $_POST['type'];
            $grafic_table->color = $_POST['color'];
            $grafic_table->year = $_POST['year'];
            $grafic_table->save();
        }

        $data = array(
            'success' => true,
            'message' => '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <strong>Exito!</strong> Se registro correctamente la informacion
            </div>',
        );

        echo json_encode($data);
        
    }
}
