<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-3"> <!-- MENU -->
	<div class="container">
	    <div class="row">
	        <div class="col-sm-3 col-md-3">

	        	<!-- AQUI EMPIEZA PROPIAMENTE EL MENU -->
	            <div class="panel-group" id="accordion">
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-list-alt">
	                            </span> Beneficiarios</a>
	                        </h4>
	                    </div>
	            
	                    <div id="collapseOne" <?php if ($menu_activo=='primero') { echo 'class="panel-collapse collapse in"';}else { echo 'class="panel-collapse collapse"';}  ?> >
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                        <span class="glyphicon glyphicon-user text-primary"></span><a href="padron"> Padron de Beneficiarios</a>
	                                    </td>
	                                </tr>
	                                
	                                
	                               
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
	                            </span> Catalogos</a>
	                        </h4>
	                    </div>
	                    <div id="collapseTwo" <?php if ($menu_activo=='segundo') { echo 'class="panel-collapse collapse in"';}else { echo 'class="panel-collapse collapse"';}  ?> >
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                        <!--<a href="http://www.jquery2dotnet.com">Orders</a> <span class="label label-success">$ 320</span>-->
	                                        <a href="componentes_crud"> Componentes</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="incentivos_crud"> Incentivos</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="programas_crud"> Programas</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="anos_fiscales_crud"> Año Fiscal</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="ddrs_crud"> Distritos</a>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
	                            </span>Seguimiento</a>
	                        </h4>
	                    </div>
	                    <div id="collapseThree" <?php if ($menu_activo=='tercero') { echo 'class="panel-collapse collapse in"';}else { echo 'class="panel-collapse collapse"';}  ?> >
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                        <a href="listado_autorizaciones">Listado de Autorizaciones</a><span class="label label-info">1</span>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="registro_cartas_autorizacion">Registro de Cartas de Autorización</a> <span class="label label-info">2</span>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="#">Oficio de envio de cartas autorización al DDR</a><span class="label label-info">5</span>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="#">Carta Pertinencia</a><span class="label label-info">6</span>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <a href="#">Envio Remesa a Pago</a><span class="label label-info">7</span>
	                                    </td>
	                                </tr>
	                                <!--
	                                <tr>
	                                    <td>
	                                        <span class="glyphicon glyphicon-trash text-danger"></span><a href="http://www.jquery2dotnet.com" class="text-danger">
	                                            Delete Account</a>
	                                    </td>
	                                </tr>
	                            -->
	                            </table>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel panel-default">
	                    <div class="panel-heading">
	                        <h4 class="panel-title">
	                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
	                            </span>Reports</a>
	                        </h4>
	                    </div>
	                    <div id="collapseFour" <?php if ($menu_activo=='cuarto') { echo 'class="panel-collapse collapse in"';}else { echo 'class="panel-collapse collapse"';}  ?> >
	                        <div class="panel-body">
	                            <table class="table">
	                                <tr>
	                                    <td>
	                                        <span class="glyphicon glyphicon-usd"></span><a href="http://www.jquery2dotnet.com">Sales</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <span class="glyphicon glyphicon-user"></span><a href="http://www.jquery2dotnet.com">Customers</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <span class="glyphicon glyphicon-tasks"></span><a href="http://www.jquery2dotnet.com">Products</a>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>
	                                        <span class="glyphicon glyphicon-shopping-cart"></span><a href="http://www.jquery2dotnet.com">Shopping Cart</a>
	                                    </td>
	                                </tr>
	                            </table>
	                        </div>
	                    </div>
	                </div>
	            </div> <!-- aqui termina propiamente el menu -->

	        </div><!-- FIN DEL COL-SM-3  y COL-MD-3-->	        
	    </div> <!-- FIN DEL ROW -->
	</div> <!-- FIN DEL CONTAINER DEL MENU -->
</div> <!-- fin del col-md-3 del menu -->     

<div class="col-md-9"> <!-- AREA DE TRABAJO -->
