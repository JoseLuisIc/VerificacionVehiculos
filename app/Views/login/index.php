<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Iniciar Sesión </title>

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="assets/css/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="assets/css/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="assets/css/custom.min.css" rel="stylesheet">

    </head>
    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>
            <div class="login_wrapper">
                <div class="animate form login_form">
                    <div id="alert"></div>
                    <section class="login_content">
                        <form id="formLogin" action="auth" method="post">
                            <h1>Iniciar Sesión</h1>
                            <div>
                                <input type="text" name="email" class="form-control" placeholder="Correo Electrónico" required />
                            </div>
                            <div>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required/>
                            </div>
                            <div>
                                <input type="hidden" name="token" class="form-control" value="{{token}}" required/>
                            </div>
                            <div>
                                <button type="submit" value="Login" class="btn btn-default">Iniciar Sesion</button>
                                <a class="reset_pass" href="#">Olvidaste Tu contraseña?</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <div class="clearfix"></div>
                                <br />
                                <div>
                                    <h1><i class="fa fa-car"></i> VVProd!</h1>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
    <!-- jQuery -->
    <script src="assets/js/jquery/dist/jquery.min.js"></script>    
    <script>
        $(document).ready(function(){
            $('#formLogin').submit(function(e){
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: 'auth',
                data: $(this).serialize(),
                beforeSend: function(objeto){
                    $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
                },
                success:function(data){
                    data = JSON.parse(data);
                    if(data.status == 'success'){
                        location.href = 'dashboard';
                    }else{
                        $('#alert').html(data.message);
                    }
                }
            });
        });
        });
    </script>
</html>
