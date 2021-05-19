<?php 
    $title ="Dashboard - "; 
    include "head.php";
    include "sidebar.php";

    $PlantaData=mysqli_query($con, "select * from plantadata where status_id=1");
    $Plantas=mysqli_query($con, "select * from planta");
    $ProjectData=mysqli_query($con, "select * from project");
    $PaisData=mysqli_query($con, "select * from pais");
    $UserData=mysqli_query($con, "select * from user order by created_at desc");
    $DepData=mysqli_query($con, "select * from centro");
    $DataLine=mysqli_query($con, "select * from linea");
    $ModelData=mysqli_query($con, "select * from modelo");
?>
    <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="row top_tiles">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-database"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($PlantaData) ?></div>
                          <h3>Datos Planta</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-industry"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($Plantas) ?></div>
                          <h3>Plantas</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-line-chart"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($DataLine) ?></div>
                          <h3>Líneas de Producción</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-list-alt"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($ProjectData) ?></div>
                          <h3>Proyectos</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-car"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($ModelData) ?></div>
                          <h3>Modelos</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-flag"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($PaisData) ?></div>
                          <h3>Países</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($UserData) ?></div>
                          <h3>Usuarios</h3>
                        </div>
                    </div>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-home"></i></div>
                          <div class="count"><?php echo mysqli_num_rows($DepData) ?></div>
                          <h3>Departamentos</h3>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="image view view-first">
                            <img class="thumb-image" style="width: 100%; display: block;" src="images/profiles/<?php echo $profile_pic; ?>" alt="image" />
                        </div>
                        <span class="btn btn-my-button btn-file">
                            <form method="post" id="formulario" enctype="multipart/form-data">
                            Cambiar Imagen de perfil: <input type="file" name="file">
                            </form>
                        </span>
                        <div id="respuesta"></div>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <?php include "lib/alerts.php";
                            profile(); //llamada a la funcion de alertas
                        ?>    
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Informacion personal</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                            <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="action/upd_profile.php" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="name" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Correo electrónico 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input readonly type="text" id="email" name="email" class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Teléfono
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="phone" id="phone" class="form-control col-md-7 col-xs-12" value="<?php echo $phone; ?>">        <!--Telefono-->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="userkind">Tipo de Usuario
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input readonly type="text" class="form-control col-md-7 col-xs-12" value="<?php if ($userkind_id==1){echo $userkind_id="Administrador";}else if($userkind_id==2) { echo $userkind_id="Usuario"; }?>">        <!--TipoUsuario-->
                                        </div>
                                    </div>

                                    <br><br><br>
                                    <h2 style="padding-left: 50px">Cambiar Contraseña</h2>
                            
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña antigua
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password_old" type="password" name="password" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="**********">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password_new" type="password" name="new_password" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar contraseña nueva
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="password_confirm" type="password" name="confirm_new_password" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" name="token" class="btn btn-success">Actualizar Datos</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
<script>
    $(function(){
        $("input[name='file']").on("change", function(){
            var formData = new FormData($("#formulario")[0]);
            var ruta = "action/upload-profile.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    $("#respuesta").html(datos);
                }
            });
        });
    });
</script>