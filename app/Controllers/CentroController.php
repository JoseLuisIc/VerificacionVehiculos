<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class CentroController extends \Core\Controller
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

        $data = array(
            'user' => $user
        );
        View::renderTemplate('centro/index.php',$data);
    }

}
