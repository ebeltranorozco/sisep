<?php

//defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set ( 'America/Mazatlan' );
ini_set('date.timezone','America/Mazatlan'); 
ini_set("session.cookie_lifetime","7200");//2017-07-11
ini_set("session.gc_maxlifetime","7200");//2017-07-11
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <title><?php echo $page_title ?></title>

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        
    <style type="text/css">
      .centrado-porcentual2{
        position: fixed;
        left: 40%;
        top: 40%;
        width: 180px;
        height:140px;
        margin-left: -80px;
        margin-top: -80px;
        z-index: 9999        
      }
    </style>  


	 <!-- CARGANDO JQUERY -->  
   <!--<script src="//cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>-->

  </head>
  <body>

    <!-- ENCABEZADO -->
  <h1>HASTA LA VISTA BABY...!</h1>


  <!-- CARGANDO JQUERY SEP 17 -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

  <script src="<?php echo base_url('assets/jquery/jquery-3.1.0.min.js')?>"></script>

  <!-- CARGANDO BOOTSTRAP SEP 17 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  <script src="<?php echo base_url(); ?>assets/js/funciones.js" type="text/javascript"></script>
  
  <div class="centrado-porcentual2" id="ajax-loading" style="display:none" ><img id="imagen_cargando" src="<?php echo base_url('assets/imagen/cargando.gif'); ?>" /></div>
  <!--http://innovaciones.com.py/images/cargando.gif-->
  </body>

</html>

    
  