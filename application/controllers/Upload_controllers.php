<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_controllers extends CI_Controller {

    function cargar_archivo() {

        if (!empty($_FILES['file_oficio_remesa']['name'])) {
            var_dump($_FILES);
            
            //$mi_archivo = 'mi_archivo';
            $mi_archivo = $_FILES['file_oficio_remesa']['name'];
            $config['upload_path'] = "assets/uploads/";
            ///$config['file_name'] = "nombre_archivo";
            $config['allowed_types'] = "*";
            //$config['max_size'] = "50000";
            //$config['max_width'] = "2000";
            //$config['max_height'] = "2000";
            echo '<br>';
            var_dump($config);

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            }

            $data['uploadSuccess'] = $this->upload->data();
        }else{
            echo 'no se selecciono ningun archivo para subir';
        }
    }
}