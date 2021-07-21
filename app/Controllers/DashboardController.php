<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use App\Models\Centro;
use App\Models\Project;
use App\Models\Linea;
use App\Models\Modelo;
use App\Models\Pais;
use App\Models\Planta;
use App\Models\PlantaData;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class DashboardController extends \Core\Controller
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
        $users = User::all()->count();
        $projects= Project::all()->count();
        $centros= Centro::all()->count();
        $lineas= Linea::all()->count();
        $modelos= Modelo::all()->count();
        $pais= Pais::all()->count();
        $plantas= Planta::all()->count();
        $plantadata= PlantaData::all()->count();
        View::renderTemplate('Dashboard/index.php',array(
            'user'=>$user, 
            'users'=>$users, 
            'projects' =>$projects,
            'centros' =>$centros,
            'lineas' =>$lineas,
            'modelos' =>$modelos,
            'pais' =>$pais,
            'plantas' =>$plantas,
            'plantadata' => $plantadata
        ));
    }
    public function diagramaAction()
    {   
        $id=$_SESSION['user_id'];
        $user = User::findOrFail($id);
        View::renderTemplate('Dashboard/diagrama.php',array(
            'user'=>$user
        ));
    }
}
