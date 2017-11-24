<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set ( 'America/Mazatlan' );
ini_set('date.timezone','America/Mazatlan'); 
ini_set("session.cookie_lifetime","7200");//2017-07-11
ini_set("session.gc_maxlifetime","7200");//2017-07-11
?>

<!DOCTYPE html>
<html lang="es">

    <head>  
      <title>SISEP</title>          
      <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
      <link href="<?php echo base_url('assets/css/bootstrap.min.css');       ?>" rel="stylesheet">
      <link href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">    
      <link href="<?php echo base_url('assets/css/font-awesome.min.css');    ?>" rel="stylesheet">
      
      <!-- DATATABLES CDN -->      
      <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>
      <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
      <style type="text/css">
        .centrado-porcentual2{    
          position: fixed;
          left: 40%;
          top: 40%;
          width: 100px; 
        height:100px;
        margin-left: -80px; 
        margin-top: -80px;    
          z-index: 9999;
          /*background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
          opacity: .8;*/
        }
      </style>  


    </head>  

    <body>  
        <div class ="container">
          <div class="row">
            <div class="col-md-3">
              <img src="assets/images/sagarpa.png" width=250px height=100>
            </div>
            <div class="col-md-4">
              <h4 style="text-align:center" VALIGN="MIDDLE">SISTEMA PARA EL CONTROL DE EXPEDIENTES ELECTRONICOS</h4>
            </div>
            <div class="col-md-5">
              <h6 style="text-align:right;"><span class="label label-default" style="align:right"><?php if (isset($_SESSION['programa'])){ echo $_SESSION['programa'];}?></span></h6>
              <h6 style="text-align:right;"><span class="label label-default"><?php if (isset($_SESSION['componente'])){ echo $_SESSION['componente'];}?></span></h6>
              <h6 style="text-align:right;"><span class="label label-default"><?php  if (isset($_SESSION['ddr_usuario'])){ echo 'DDR:'. $_SESSION['ddr_usuario'];}?></span></h6>
              <h6 style="text-align:right;">Usuario:<span class="label label-default"><?php  if (isset($_SESSION['nombre_usuario'])){ echo $_SESSION['nombre_usuario'];}?></span></h6>
            </div>
          </div>  
          <div class='row'>
            <div class="col-md-12">             
              
              <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">SISEP</a>
                </div>
                <!-- Collection of nav links and other content for toggling -->
                <div id="navbarCollapse" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url() ?>">Inicio</a></li>
                        
                  </ul>
                  <ul class="nav navbar-nav navbar-right">                        
                    
                    <?php if (!isset($_SESSION['logeado']) ) { ?>
                      <li><a href="registro">Registro</a></li>
                    <?php } ?>                        
                        
                    <?php if (!isset($_SESSION['logeado']) )  { ?>
                      <li><a href="login">Login</a></li>
                    <?php } else { ?>

                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php  echo $_SESSION['alias_usuario'] ;?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Perfil</a></li>
                          <li><a href="#">Contraseña</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="logout">Cerrar Session</a></li>                                
                        </ul> <!-- ul seccion dropdownm -->
                      </li>                                                        
                    <?php } ?>
                  </ul> <!-- "nav navbar-nav navbar-right " SECCION LOGIN RIGHT -->
                </div>
              </nav>

            </div> <!-- fin del col-md-12 -->
          </div>   <!-- fin del row -->
          <!-- LA PARTE DE LOS MENSAJES DE ERROR Y DEMAS VALIDACIONES -->
          
          <div class="row">
            <div id="msg_alert_full"></div> <!-- mensajes globales -->
            <?php if (validation_errors()) { ?> 
              <div class="alert alert-danger" role="alert"><?php echo validation_errors(); ?></div>
            <?php } ?> 

            <?php // para que ponga los mensajes cuando los haya..!            
              if ($this->session->flashdata('mensaje_error') !=NULL) {
                echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('mensaje_error') . '</div>';
                $this->session->flashdata('mensaje_error') ==NULL;
              }
              if ($this->session->flashdata('mensaje_sucess') !=NULL) {
                echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('mensaje_sucess') . '</div>';
                $this->session->flashdata('mensaje_sucess') ==NULL;
              }
              if ($this->session->flashdata('mensaje_warning') !=NULL) {
                echo '<div class="alert alert-warning" role="alert">' . $this->session->flashdata('mensaje_warning') . '</div>';
                $this->session->flashdata('mensaje_warning') ==NULL;
              }
            ?> 
              
            <div class="centrado-porcentual2" id="ajax-loading" style="display:none" ><img id="imagen_cargando" src="assets/images/cargando.gif" /></div>          
          </div> <!-- FIN DEL ROW -->
          <!-- DE AQUI ELIMINE UN CLASS=ROW 23/11/2017 por un error de </body> debe cerrar todas las etiquetas div-->
          <!-- empieza la parte del menu y area de trabajo y pie de pagina -->
