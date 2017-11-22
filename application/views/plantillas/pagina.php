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
        <title>Maquetacion con CSS y Divs</title>          
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css');       ?>" rel="stylesheet">
	  	<link href="<?php echo base_url('assets/css/bootstrap-theme.min.css'); ?>" rel="stylesheet">    
	  	<link href="<?php echo base_url('assets/css/font-awesome.min.css');    ?>" rel="stylesheet">
	  	
    </head>  

    <body>  
        <div class ="container">  
        	<div class='row'>
        		<div class="col-md-12">
        			<div class="encabezado" style="float:left">
        			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at malesuada lacus. In vel laoreet metus. Quisque orci ligula, scelerisque id blandit eu, iaculis in orci. Morbi in efficitur justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam semper, arcu aliquam auctor ultrices, nibh metus pharetra nunc, ac feugiat metus turpis in urna. Sed mollis lectus nisi, a venenatis orci vestibulum quis. Fusce dignissim eu ligula non blandit. Vestibulum dignissim rhoncus ligula, vel euismod augue.

Duis luctus ex sit amet diam tincidunt porta. Nam in purus non lacus lobortis dignissim. Cras imperdiet mollis rutrum. Aenean congue consectetur mi, eu suscipit lectus rutrum vel. Quisque rhoncus est arcu, ac aliquam dolor interdum a. Donec in sem commodo, lacinia nulla eget, rhoncus dui. Mauris ornare ornare faucibus. Duis venenatis et leo ut tincidunt.

Morbi placerat ligula sed leo pulvinar interdum. Vivamus in sapien vitae nisl euismod iaculis at quis leo. Vivamus sed semper diam. In et neque ut elit viverra fringilla a ac justo. Praesent elementum suscipit odio sed elementum. Aenean volutpat felis nec bibendum efficitur. Fusce ut libero sem.

Ut sit amet luctus eros. Phasellus tempus vitae massa in euismod. Suspendisse sit amet augue turpis. Nulla feugiat lectus vitae est lobortis, sit amet ullamcorper velit dapibus. Proin fringilla vel nibh a ultricies. Quisque fermentum turpis id metus ultricies, in tincidunt dui cursus. Sed feugiat pellentesque metus, non pharetra dui pretium id. Vestibulum vitae porta nibh, euismod egestas tortor. Nunc vel quam ac orci maximus tristique vitae vel erat. Quisque non orci dapibus, scelerisque mauris consectetur, scelerisque orci. Curabitur non sapien viverra ex rutrum cursus. Nullam eget finibus erat, vel facilisis est.

Vestibulum sit amet augue sagittis, convallis massa vel, ultrices metus. Nunc id bibendum nibh. Vivamus convallis vel diam vitae ultricies. Fusce quis felis interdum justo ultrices aliquam. Sed bibendum massa et lorem cursus pharetra. Integer pretium enim in congue pulvinar. Nunc dictum mattis augue et euismod. Nullam vitae metus aliquam, vestibulum justo sed, mollis ante. Morbi nec purus sit amet nisl pharetra efficitur. Praesent in felis dolor. Nullam vitae turpis vel felis malesuada laoreet vitae in ex. Cras velit nisl, faucibus dignissim massa in, accumsan porta felis. Maecenas eget rutrum odio, vitae porttitor dolor. Integer ultrices vehicula posuere. Nullam eget augue sed metus blandit finibus non et diam.</p>
					</div>	
        		</div>
        	</div>

        	<div class="row">
        		<div class="col-md-3"> <!-- MENU -->
        			<div class="container">
					    <div class="row">
					        <div class="col-sm-3 col-md-3">
					            <div class="panel-group" id="accordion">
					                <div class="panel panel-default">
					                    <div class="panel-heading">
					                        <h4 class="panel-title">
					                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
					                            </span>Content</a>
					                        </h4>
					                    </div>
					                    <div id="collapseOne" class="panel-collapse collapse">
					                        <div class="panel-body">
					                            <table class="table">
					                                <tr>
					                                    <td>
					                                        <span class="glyphicon glyphicon-pencil text-primary"></span><a href="http://www.jquery2dotnet.com">Articles</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <span class="glyphicon glyphicon-flash text-success"></span><a href="http://www.jquery2dotnet.com">News</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <span class="glyphicon glyphicon-file text-info"></span><a href="http://www.jquery2dotnet.com">Newsletters</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <span class="glyphicon glyphicon-comment text-success"></span><a href="http://www.jquery2dotnet.com">Comments</a>
					                                        <span class="badge">42</span>
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
					                            </span>Modules</a>
					                        </h4>
					                    </div>
					                    <div id="collapseTwo" class="panel-collapse collapse ">
					                        <div class="panel-body">
					                            <table class="table">
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Orders</a> <span class="label label-success">$ 320</span>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Invoices</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Shipments</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Tex</a>
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
					                            </span>Account</a>
					                        </h4>
					                    </div>
					                    <div id="collapseThree" class="panel-collapse collapse">
					                        <div class="panel-body">
					                            <table class="table">
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Change Password</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Notifications</a> <span class="label label-info">5</span>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <a href="http://www.jquery2dotnet.com">Import/Export</a>
					                                    </td>
					                                </tr>
					                                <tr>
					                                    <td>
					                                        <span class="glyphicon glyphicon-trash text-danger"></span><a href="http://www.jquery2dotnet.com" class="text-danger">
					                                            Delete Account</a>
					                                    </td>
					                                </tr>
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
					                    <div id="collapseFour" class="panel-collapse collapse">
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
					            </div>
					        </div>
					        
					    </div>
					</div>
	
        		</div> <!-- fin del col-md-3 del menu -->
        		<div class="col-md-9">
        			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at malesuada lacus. In vel laoreet metus. Quisque orci ligula, scelerisque id blandit eu, iaculis in orci. Morbi in efficitur justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam semper, arcu aliquam auctor ultrices, nibh metus pharetra nunc, ac feugiat metus turpis in urna. Sed mollis lectus nisi, a venenatis orci vestibulum quis. Fusce dignissim eu ligula non blandit. Vestibulum dignissim rhoncus ligula, vel euismod augue.

Duis luctus ex sit amet diam tincidunt porta. Nam in purus non lacus lobortis dignissim. Cras imperdiet mollis rutrum. Aenean congue consectetur mi, eu suscipit lectus rutrum vel. Quisque rhoncus est arcu, ac aliquam dolor interdum a. Donec in sem commodo, lacinia nulla eget, rhoncus dui. Mauris ornare ornare faucibus. Duis venenatis et leo ut tincidunt.

Morbi placerat ligula sed leo pulvinar interdum. Vivamus in sapien vitae nisl euismod iaculis at quis leo. Vivamus sed semper diam. In et neque ut elit viverra fringilla a ac justo. Praesent elementum suscipit odio sed elementum. Aenean volutpat felis nec bibendum efficitur. Fusce ut libero sem.

Ut sit amet luctus eros. Phasellus tempus vitae massa in euismod. Suspendisse sit amet augue turpis. Nulla feugiat lectus vitae est lobortis, sit amet ullamcorper velit dapibus. Proin fringilla vel nibh a ultricies. Quisque fermentum turpis id metus ultricies, in tincidunt dui cursus. Sed feugiat pellentesque metus, non pharetra dui pretium id. Vestibulum vitae porta nibh, euismod egestas tortor. Nunc vel quam ac orci maximus tristique vitae vel erat. Quisque non orci dapibus, scelerisque mauris consectetur, scelerisque orci. Curabitur non sapien viverra ex rutrum cursus. Nullam eget finibus erat, vel facilisis est.

Vestibulum sit amet augue sagittis, convallis massa vel, ultrices metus. Nunc id bibendum nibh. Vivamus convallis vel diam vitae ultricies. Fusce quis felis interdum justo ultrices aliquam. Sed bibendum massa et lorem cursus pharetra. Integer pretium enim in congue pulvinar. Nunc dictum mattis augue et euismod. Nullam vitae metus aliquam, vestibulum justo sed, mollis ante. Morbi nec purus sit amet nisl pharetra efficitur. Praesent in felis dolor. Nullam vitae turpis vel felis malesuada laoreet vitae in ex. Cras velit nisl, faucibus dignissim massa in, accumsan porta felis. Maecenas eget rutrum odio, vitae porttitor dolor. Integer ultrices vehicula posuere. Nullam eget augue sed metus blandit finibus non et diam.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at malesuada lacus. In vel laoreet metus. Quisque orci ligula, scelerisque id blandit eu, iaculis in orci. Morbi in efficitur justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam semper, arcu aliquam auctor ultrices, nibh metus pharetra nunc, ac feugiat metus turpis in urna. Sed mollis lectus nisi, a venenatis orci vestibulum quis. Fusce dignissim eu ligula non blandit. Vestibulum dignissim rhoncus ligula, vel euismod augue.

Duis luctus ex sit amet diam tincidunt porta. Nam in purus non lacus lobortis dignissim. Cras imperdiet mollis rutrum. Aenean congue consectetur mi, eu suscipit lectus rutrum vel. Quisque rhoncus est arcu, ac aliquam dolor interdum a. Donec in sem commodo, lacinia nulla eget, rhoncus dui. Mauris ornare ornare faucibus. Duis venenatis et leo ut tincidunt.

Morbi placerat ligula sed leo pulvinar interdum. Vivamus in sapien vitae nisl euismod iaculis at quis leo. Vivamus sed semper diam. In et neque ut elit viverra fringilla a ac justo. Praesent elementum suscipit odio sed elementum. Aenean volutpat felis nec bibendum efficitur. Fusce ut libero sem.

Ut sit amet luctus eros. Phasellus tempus vitae massa in euismod. Suspendisse sit amet augue turpis. Nulla feugiat lectus vitae est lobortis, sit amet ullamcorper velit dapibus. Proin fringilla vel nibh a ultricies. Quisque fermentum turpis id metus ultricies, in tincidunt dui cursus. Sed feugiat pellentesque metus, non pharetra dui pretium id. Vestibulum vitae porta nibh, euismod egestas tortor. Nunc vel quam ac orci maximus tristique vitae vel erat. Quisque non orci dapibus, scelerisque mauris consectetur, scelerisque orci. Curabitur non sapien viverra ex rutrum cursus. Nullam eget finibus erat, vel facilisis est.

Vestibulum sit amet augue sagittis, convallis massa vel, ultrices metus. Nunc id bibendum nibh. Vivamus convallis vel diam vitae ultricies. Fusce quis felis interdum justo ultrices aliquam. Sed bibendum massa et lorem cursus pharetra. Integer pretium enim in congue pulvinar. Nunc dictum mattis augue et euismod. Nullam vitae metus aliquam, vestibulum justo sed, mollis ante. Morbi nec purus sit amet nisl pharetra efficitur. Praesent in felis dolor. Nullam vitae turpis vel felis malesuada laoreet vitae in ex. Cras velit nisl, faucibus dignissim massa in, accumsan porta felis. Maecenas eget rutrum odio, vitae porttitor dolor. Integer ultrices vehicula posuere. Nullam eget augue sed metus blandit finibus non et diam.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at malesuada lacus. In vel laoreet metus. Quisque orci ligula, scelerisque id blandit eu, iaculis in orci. Morbi in efficitur justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam semper, arcu aliquam auctor ultrices, nibh metus pharetra nunc, ac feugiat metus turpis in urna. Sed mollis lectus nisi, a venenatis orci vestibulum quis. Fusce dignissim eu ligula non blandit. Vestibulum dignissim rhoncus ligula, vel euismod augue.

Duis luctus ex sit amet diam tincidunt porta. Nam in purus non lacus lobortis dignissim. Cras imperdiet mollis rutrum. Aenean congue consectetur mi, eu suscipit lectus rutrum vel. Quisque rhoncus est arcu, ac aliquam dolor interdum a. Donec in sem commodo, lacinia nulla eget, rhoncus dui. Mauris ornare ornare faucibus. Duis venenatis et leo ut tincidunt.

Morbi placerat ligula sed leo pulvinar interdum. Vivamus in sapien vitae nisl euismod iaculis at quis leo. Vivamus sed semper diam. In et neque ut elit viverra fringilla a ac justo. Praesent elementum suscipit odio sed elementum. Aenean volutpat felis nec bibendum efficitur. Fusce ut libero sem.

Ut sit amet luctus eros. Phasellus tempus vitae massa in euismod. Suspendisse sit amet augue turpis. Nulla feugiat lectus vitae est lobortis, sit amet ullamcorper velit dapibus. Proin fringilla vel nibh a ultricies. Quisque fermentum turpis id metus ultricies, in tincidunt dui cursus. Sed feugiat pellentesque metus, non pharetra dui pretium id. Vestibulum vitae porta nibh, euismod egestas tortor. Nunc vel quam ac orci maximus tristique vitae vel erat. Quisque non orci dapibus, scelerisque mauris consectetur, scelerisque orci. Curabitur non sapien viverra ex rutrum cursus. Nullam eget finibus erat, vel facilisis est.

Vestibulum sit amet augue sagittis, convallis massa vel, ultrices metus. Nunc id bibendum nibh. Vivamus convallis vel diam vitae ultricies. Fusce quis felis interdum justo ultrices aliquam. Sed bibendum massa et lorem cursus pharetra. Integer pretium enim in congue pulvinar. Nunc dictum mattis augue et euismod. Nullam vitae metus aliquam, vestibulum justo sed, mollis ante. Morbi nec purus sit amet nisl pharetra efficitur. Praesent in felis dolor. Nullam vitae turpis vel felis malesuada laoreet vitae in ex. Cras velit nisl, faucibus dignissim massa in, accumsan porta felis. Maecenas eget rutrum odio, vitae porttitor dolor. Integer ultrices vehicula posuere. Nullam eget augue sed metus blandit finibus non et diam.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at malesuada lacus. In vel laoreet metus. Quisque orci ligula, scelerisque id blandit eu, iaculis in orci. Morbi in efficitur justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam semper, arcu aliquam auctor ultrices, nibh metus pharetra nunc, ac feugiat metus turpis in urna. Sed mollis lectus nisi, a venenatis orci vestibulum quis. Fusce dignissim eu ligula non blandit. Vestibulum dignissim rhoncus ligula, vel euismod augue.

Duis luctus ex sit amet diam tincidunt porta. Nam in purus non lacus lobortis dignissim. Cras imperdiet mollis rutrum. Aenean congue consectetur mi, eu suscipit lectus rutrum vel. Quisque rhoncus est arcu, ac aliquam dolor interdum a. Donec in sem commodo, lacinia nulla eget, rhoncus dui. Mauris ornare ornare faucibus. Duis venenatis et leo ut tincidunt.

Morbi placerat ligula sed leo pulvinar interdum. Vivamus in sapien vitae nisl euismod iaculis at quis leo. Vivamus sed semper diam. In et neque ut elit viverra fringilla a ac justo. Praesent elementum suscipit odio sed elementum. Aenean volutpat felis nec bibendum efficitur. Fusce ut libero sem.

Ut sit amet luctus eros. Phasellus tempus vitae massa in euismod. Suspendisse sit amet augue turpis. Nulla feugiat lectus vitae est lobortis, sit amet ullamcorper velit dapibus. Proin fringilla vel nibh a ultricies. Quisque fermentum turpis id metus ultricies, in tincidunt dui cursus. Sed feugiat pellentesque metus, non pharetra dui pretium id. Vestibulum vitae porta nibh, euismod egestas tortor. Nunc vel quam ac orci maximus tristique vitae vel erat. Quisque non orci dapibus, scelerisque mauris consectetur, scelerisque orci. Curabitur non sapien viverra ex rutrum cursus. Nullam eget finibus erat, vel facilisis est.

Vestibulum sit amet augue sagittis, convallis massa vel, ultrices metus. Nunc id bibendum nibh. Vivamus convallis vel diam vitae ultricies. Fusce quis felis interdum justo ultrices aliquam. Sed bibendum massa et lorem cursus pharetra. Integer pretium enim in congue pulvinar. Nunc dictum mattis augue et euismod. Nullam vitae metus aliquam, vestibulum justo sed, mollis ante. Morbi nec purus sit amet nisl pharetra efficitur. Praesent in felis dolor. Nullam vitae turpis vel felis malesuada laoreet vitae in ex. Cras velit nisl, faucibus dignissim massa in, accumsan porta felis. Maecenas eget rutrum odio, vitae porttitor dolor. Integer ultrices vehicula posuere. Nullam eget augue sed metus blandit finibus non et diam.
        		</div>
        	</div>            
        	<div class="row">
        		<div class="col-md-12">
        			
        			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc at malesuada lacus. In vel laoreet metus. Quisque orci ligula, scelerisque id blandit eu, iaculis in orci. Morbi in efficitur justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam semper, arcu aliquam auctor ultrices, nibh metus pharetra nunc, ac feugiat metus turpis in urna. Sed mollis lectus nisi, a venenatis orci vestibulum quis. Fusce dignissim eu ligula non blandit. Vestibulum dignissim rhoncus ligula, vel euismod augue.
Duis luctus ex sit amet diam tincidunt porta. Nam in purus non lacus lobortis dignissim. Cras imperdiet mollis rutrum. Aenean congue consectetur mi, eu suscipit lectus rutrum vel. Quisque rhoncus est arcu, ac aliquam dolor interdum a. Donec in sem commodo, lacinia nulla eget, rhoncus dui. Mauris ornare ornare faucibus. Duis venenatis et leo ut tincidunt.
Morbi placerat ligula sed leo pulvinar interdum. Vivamus in sapien vitae nisl euismod iaculis at quis leo. Vivamus sed semper diam. In et neque ut elit viverra fringilla a ac justo. Praesent elementum suscipit odio sed elementum. Aenean volutpat felis nec bibendum efficitur. Fusce ut libero sem.
Ut sit amet luctus eros. Phasellus tempus vitae massa in euismod. Suspendisse sit amet augue turpis. Nulla feugiat lectus vitae est lobortis, sit amet ullamcorper velit dapibus. Proin fringilla vel nibh a ultricies. Quisque fermentum turpis id metus ultricies, in tincidunt dui cursus. Sed feugiat pellentesque metus, non pharetra dui pretium id. Vestibulum vitae porta nibh, euismod egestas tortor. Nunc vel quam ac orci maximus tristique vitae vel erat. Quisque non orci dapibus, scelerisque mauris consectetur, scelerisque orci. Curabitur non sapien viverra ex rutrum cursus. Nullam eget finibus erat, vel facilisis est.
Vestibulum sit amet augue sagittis, convallis massa vel, ultrices metus. Nunc id bibendum nibh. Vivamus convallis vel diam vitae ultricies. Fusce quis felis interdum justo ultrices aliquam. Sed bibendum massa et lorem cursus pharetra. Integer pretium enim in congue pulvinar. Nunc dictum mattis augue et euismod. Nullam vitae metus aliquam, vestibulum justo sed, mollis ante. Morbi nec purus sit amet nisl pharetra efficitur. Praesent in felis dolor. Nullam vitae turpis vel felis malesuada laoreet vitae in ex. Cras velit nisl, faucibus dignissim massa in, accumsan porta felis. Maecenas eget rutrum odio, vitae porttitor dolor. Integer ultrices vehicula posuere. Nullam eget augue sed metus blandit finibus non et diam.
					</p>
					
				</div>		
				
        	</div>
        </div>  
        <script src="<?php echo base_url(); ?>assets/cliente/funciones.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    </body>  
</html>


<style>
body{margin-top:50px;}
.glyphicon { margin-right:10px; }
.panel-body { padding:0px; }
.panel-body table tr td { padding-left: 15px }
.panel-body .table {margin-bottom: 0px; }
</style>
