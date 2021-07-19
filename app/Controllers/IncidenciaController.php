<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use App\Models\Incidencia;
use App\Models\SeguimientoIncidencia;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class IncidenciaController extends \Core\Controller
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
        $incidencias = Incidencia::all();
        $data = array(
            'user' => $user,
            'incidencias' => $incidencias
        );
        View::renderTemplate('incidencia/index.php',$data);
    }
    public function seguimientoAction()
    {
        $id=$_SESSION['user_id'];
        $user = User::findOrFail($id);
        $incidencia = Incidencia::findOrFail($_REQUEST['id']);
        $seguimientos = SeguimientoIncidencia::where('incidencia_id' ,'=',$_REQUEST['id'])->get();
        $data = array(
            'user' => $user,
            'incidencia' => $incidencia,
            'seguimientos' => $seguimientos
        );
        View::renderTemplate('seguimiento_incidencia/index.php',$data);
    }
    public function seguimientoCreate()
    {
        $id=$_SESSION['user_id'];
        $user = User::findOrFail($id);
        $seguimiento = new SeguimientoIncidencia();
        $seguimiento->user_id = $user->id;
        $seguimiento->comment = $_REQUEST['comment'];
        $seguimiento->incidencia_id = $_REQUEST['id'];
        $seguimiento->save();
        $data = array(
            'success' => true,
            'data' => $seguimiento,
            'message' => '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <strong>Exito!</strong> Se creo correctamente el registro
            </div>'
        );
        echo json_encode($data);
    }
    

}
