<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ventas PHP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>Ventas</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>VEN</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                    <p>
                      Est. Ingenieria en Sistemas
                      <small>carlosmorales_lopez@hotmail.com</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php 
            if ($_SESSION['escritorio']==1)
            {
              echo '<li id="mEscritorio">
              <a href="escritorio.php">
                <i class="fa fa-dashboard"></i> <span>Escritorio</span>
              </a>
            </li>';
            }
            ?>

          <?php 
            if ($_SESSION['acceso']==1)
              {
                echo '<li id="mAcceso" class="treeview">
                <a href="#">
                  <i class="fa fa-key"></i> <span>Administracion</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li id="lUsuarios"><a href="usuario.php"><i class="fa fa-circle-o"></i> Registrar</a></li>   
                </ul>
              </li>';
            }
            ?>
            
            <?php       
              if ($_SESSION['acceso']==1)
                {
                  echo '<li id="mCliente" class="treeview">
                  <a href="#">
                    <i class="fa fa-users"></i> <span>Clientes</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li id="lRegistroCliente"><a href="cliente.php"><i class="fa fa-circle-o"></i> Registro Clientes</a></li>
              
                  </ul>
                </li>';
              }
            ?>
             <?php       
              if ($_SESSION['acceso']==1)
                {
                  echo '<li id="mProducto" class="treeview">
                  <a href="#">
                    <i class="fa fa-cubes"></i> <span>Producto</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li id="lregistroTipoProducto"><a href="tipo_producto.php"><i class="fa fa-circle-o"></i>Tipo Producto</a></li>
                    <li id="lregistroProducto"><a href="producto.php"><i class="fa fa-circle-o"></i>Registo Producto</a></li>
                  </ul>
                </li>';
              }
            ?>

            <?php       
              if ($_SESSION['acceso']==1)
                {
                  echo '<li id="mGrupo" class="treeview">
                  <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>Venta</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li id="lGrupo"><a href="venta.php"><i class="fa fa-circle-o"></i>Registrar Venta </a></li>
                  </ul>
                </li>';
              }
            ?>

            <?php       
              if ($_SESSION['acceso']==1)
                {
                  echo '<li id="mCursos" class="treeview">
                  <a href="#">
                    <i class="fa fa-file-pdf-o"></i> <span>Informes</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li id="lCursos"><a href="curso.php"><i class="fa fa-circle-o"></i> Registrar</a></li>
                  </ul>
                </li>';
              }
            ?>


            <li>
              <a href="acerca.php">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">Carlos Morales</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
