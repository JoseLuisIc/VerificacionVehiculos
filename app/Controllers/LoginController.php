<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class LoginController extends \Core\Controller
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
        if (isset($_SESSION['user_id']) && $_SESSION!==null) {
            header("location: dashboard");
        }
        session_start();
    }
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $token = sha1(mt_rand(1, 90) . 'SALT');
        View::renderTemplate('login/index.php', array('token' => $token));
    }
    /**
     * Show the index page
     *
     * @return void
     */
    public function loginAction()
    {
        
        if (isset($_POST['token']) && $_POST['token']!=='') {

            $email=$_POST["email"];
            $password=sha1(md5($_POST["password"]));

            $user = User::where('email', '=', $email )
                        ->where('password', '=', $password)
                        ->orWhere('username','=',$email)->first();
            if (!empty($user)) {
                
                    /*Aqui se añaden las variables globales de sesión*/
                    $_SESSION['admin'] = true;
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['kind_id'] = $user->kind;
                    /*Recuperar al tipo*/
                    $_SESSION['user_kind'] = $user->kind;
                    $_SESSION['user_email']= $user->email;
                    $_SESSION['user_phone']= $user->phone;;
                    $response =array(
                        'status' => 'success',
                        'message'=> 'Exito'
                    );
                    echo json_encode($response);
                    
            }else{
                $response =array(
                    'status' => 'error',
                    'message'=>'<div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <strong>Error!</strong> Contraseña o correo Electrónico invalido
                    </div>'
                );
               echo json_encode($response);
            }
        }else{
            $response =array(
                'status' => 'success',
                'message'=> 'Exito'
            );
            echo json_encode($response);
        }
    }
     /**
     * Show the index page
     *
     * @return void
     */
    public function logoutAction()
    {

        if (isset($_SESSION['user_id'])) {
            session_destroy();
            header("location: login"); //estemos donde estemos nos redirije al index
        }
    }
}
