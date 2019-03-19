<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Administrador extends CI_controller{
        
        public function index()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='ADMINISTRADOR')
            {
                redirect('Jefe/reg_platica'); 
            }
            redirect('Login'); // si la sesión caduca, lo reenvia a login
        }
        
    }
?>