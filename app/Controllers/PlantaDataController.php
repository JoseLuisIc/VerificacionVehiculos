<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Project;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Kind;
use App\Models\Category;
use App\Models\Pais;
use App\Models\Planta;
use App\Models\Modelo;
use App\Models\Linea;
use App\Models\Semana;
use App\Models\Scrap;
use App\Models\Centro;
use App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class PlantaDataController extends \Core\Controller
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
        $projects = Project::all();
        $priorities = Priority::all();
        $statuses = Status::all();
        $kinds = Kind::all();
        $categories = Category::all();
        $paises = Pais::all();
        $plantas = Planta::all();
        $lineas = Linea::all();
        $semanas = Semana::all();
        $modelos = Modelo::all();
        $scraps = Scrap::all();
        $departamentos = Centro::all();
        $data = array(
            'projects' => $projects,
            'priorities' => $priorities ,
            'statuses' => $statuses,
            'kinds' => $kinds ,
            'categories' => $categories,
            'paises' => $paises,
            'plantas' => $plantas,
            'lineas' => $lineas,
            'semanas' => $semanas,
            'modelos' => $modelos,
            'scraps' => $scraps,
            'departamentos' => $departamentos,
            'user' => $user
        );
        View::renderTemplate('planta-data/index.php',$data);
    }
}
