        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> Perfil</a>
                    </li>

                    <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="plantadatas.php"><i class="fa fa-database"></i> Datos</a>
                    </li>

                    <li class="<?php if(isset($active3)){echo $active3;}?>">
                        <a href="projects.php"><i class="fa fa-list-alt"></i> Proyectos</a>
                    </li>
                    <!--
                    <li class="<?php if(isset($active4)){echo $active4;}?>">
                        <a href="categories.php"><i class="fa fa-align-left"></i> Categorias</a>
                    </li>
                    -->
                    <!--
                    <li class="<?php if(isset($active5)){echo $active5;}?>">
                        <a href="reports.php"><i class="fa fa-area-chart"></i> Estadísticas</a>
                    </li>
                    -->

                    <li class="<?php if(isset($active5)){echo $active5;}?>">
                        <a href="users.php"><i class="fa fa-users"></i> Usuarios</a>
                    </li>

                    <li class="<?php if(isset($active6)){echo $active6;}?>">
                        <a href="paises.php"><i class="fa fa-flag"></i> País</a>
                    </li>
                    <li class="<?php if(isset($active7)){echo $active7;}?>">
                        <a href="plantas.php"><i class="fa fa-industry"></i>Planta</a>
                    </li>
                    <li class="<?php if(isset($active8)){echo $active8;}?>">
                        <a href="scraps.php"><i class="fa fa-refresh"></i> Scrap</a>
                    </li>
                    <li class="<?php if(isset($active9)){echo $active9;}?>">
                        <a href="modelos.php"><i class="fa fa-car"></i> Modelo</a>
                    </li>
                    <li class="<?php if(isset($active10)){echo $active10;}?>">
                        <a href="lineas.php"><i class="fa fa-line-chart"></i> Lineas de Producción</a>
                    </li>
                    <li class="<?php if(isset($active11)){echo $active11;}?>">
                        <a href="centros.php"><i class="fa fa-home"></i> Departamentos</a>
                    </li>
                    
                    <li class="<?php if(isset($active12)){echo $active12;}?>">
                        <a href="grafico_index.php"><i class="fa fa-area-chart"></i> Estadísticas</a>
                    </li>
                    <!--
                    <li class="<?php if(isset($active13)){echo $active13;}?>">
                        <a href="about.php"><i class="fa fa-child"></i> Sobre Mi</a>
                    </li>
                    -->

                </ul>
            </div>
        </div><!-- /sidebar menu -->
    </div>
</div> 
     
    <div class="top_nav"><!-- top navigation -->
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/profiles/<?php echo $profile_pic;?>" alt=""><?php echo $name;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="dashboard.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
                            <li><a href="action/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- /top navigation -->    