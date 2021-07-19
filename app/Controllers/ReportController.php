<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use App\Models\Project;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Kind;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class ReportController extends \Core\Controller
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
        $data = array(
            'user' => $user,
            'projects' => $projects,
            'priorities' => $priorities,
            'statuses' => $statuses,
            'kinds' => $kinds
        );
        View::renderTemplate('report/index.php',$data);
    }

}
