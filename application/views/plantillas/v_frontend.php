<?php 
$this->load->view('plantillas/encabezado',$data);
if (isset($_SESSION['ddr_usuario'])){
	if ($_SESSION['ddr_usuario']>0) {
		$this->load->view('plantillas/menu_ddr',$data);
	}else {
		$this->load->view('plantillas/menu',$data);
	}
}else {
	$this->load->view('plantillas/menu',$data);
}
if ($contenido){
	$this->load->view($contenido);
}
//$this->load->view('auth/v_login',$data);
$this->load->view('plantillas/footer',$data);
?>

