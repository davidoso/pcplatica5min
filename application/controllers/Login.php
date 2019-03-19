<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Login extends CI_controller{
        
        public function index()
        {
            $this->load->view('recursos/login/header');
            $this->load->view('login/iniciar_sesion');
            $this->load->view('recursos/footer');
        }
        
        public function iniciar_sesion($datos_usuario) // recibe el resultado del servicio web y determina si es valido el inicio de sesión.
        {
            if (count($datos_usuario)>0)
            {
                $this->session->set_userdata('usuario',$datos_usuario[0]->USUARIOID);
                $this->session->set_userdata('nombre',$datos_usuario[0]->NOMBRE);
                
                $this->definir_rol($this->session->userdata('usuario'));
                
                switch ($this->session->userdata('rol'))
                {
                    case 'ADMINISTRADOR': redirect('Administrador');
                        break;
                    case 'JEFE': redirect('Jefe');
                        break;
                    case 'SUPERVISOR': redirect('Supervisor');
                        break;
                }
            }
            redirect('Login'); // si no trae nada el json se redirecciona a la pantalla de inicio de sesión
        }
        
        public function validar_usuario() // consume un servicio web utilizando curl. Valida si el usuario existe en la base de datos de PColorada.
        {
            $usuario=$this->input->post('usuario');
            $contrasena=$this->input->post('contrasena');
            
            $this->load->model('Login_m');
            $output=$this->Login_m->login_apiweb($usuario, $contrasena);
            
            $this->iniciar_sesion($output);
            
        }
        
        public function definir_rol($usuario) // determina si el usuario es administrador
        {
            $this->load->model('Login_m');
            $array=$this->Login_m->get_usuario($usuario);
            
            if (count($array)>0)
            {
                $this->session->set_userdata('rol',$array[0]->nivel);
            }
            else
            {
                $this->session->set_userdata('rol','SUPERVISOR');
            }
        }
        
        public function cerrar_sesion() // destruye todas las variables de sesion
        {
            $this->session->sess_destroy();
            redirect('Login');
        }
    }
?>