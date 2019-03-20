<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Jefe extends CI_controller{

        public function index()
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                //$fam_equipos=$this->obtener_equipos(); // obtiene un array donde están todos las familias y sus respectivos equipos
                //$this->session->set_userdata('fam_equipos',$fam_equipos); // prepara una variable de sesión con el array
                redirect('Jefe/reg_platica');
            }
            redirect('Login'); // si la sesión caduca, lo reenvia a login
        }

        public function reg_platica() // vista de Chuy Jimenez y cualquier otro usuario administrador
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $this->load->model('Jefe_m');
                $array=array(
                    'platicas'=>$this->Jefe_m->get_last_platicas()
                );

                $this->load->view('recursos/header');
                $this->load->view('recursos/administrador/navbar');
                $this->load->view('jefe/reg_platica', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function platica() // ver una platica en especifico
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $platica=$this->input->get('p');

                $this->load->model('Jefe_m');
                $array=array(
                    'platica'=>$this->Jefe_m->get_platica($platica),
                    'contenido'=>$this->Jefe_m->get_contenido($platica),
                    'tipo_contenido'=>$this->Jefe_m->get_tipo_contenido()
                );

                $this->load->view('recursos/header');
                $this->load->view('recursos/administrador/navbar');
                $this->load->view('jefe/platica', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function platicas() // ver todas las platicas registradas
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $tema=$this->input->get('t');

                $this->load->model('Jefe_m');
                $array=array(
                    'platicas'=>$this->Jefe_m->get_busqueda_platicas($tema)
                );

                $this->load->view('recursos/header');
                $this->load->view('recursos/administrador/navbar');
                $this->load->view('jefe/todas_platicas', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function usuarios() // ver todas las platicas registradas
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $tema=$this->input->get('t');

                $this->load->model('Jefe_m');
                $array=array(
                    'usuarios'=>$this->Jefe_m->get_usuarios()
                );

                $this->load->view('recursos/header');
                $this->load->view('recursos/administrador/navbar');
                $this->load->view('jefe/reg_usuario', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function insert_usuario()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $usuario=$this->input->post('usuario');

                $this->load->model('Jefe_m');
                $this->Jefe_m->insert_usuario($usuario);

                redirect('Jefe/usuarios');
            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

        public function delete_usuario()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $usuario=$this->input->get('u');
                $erased=$this->input->get('e');

                $this->load->model('Jefe_m');
                $this->Jefe_m->delete_usuario($usuario,$erased);

                redirect('Jefe/usuarios');
            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

        public function insert_platica()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $tema=$this->input->post('tema');
                $fecha_inicio=$this->input->post('fecha_inicio');
                $fecha_final=$this->input->post('fecha_final');

                $this->load->model('Jefe_m');
                $this->Jefe_m->insert_platica($tema, $fecha_inicio, $fecha_final);

                redirect('Jefe/reg_platica');
            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

        public function update_platica()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $tema=$this->input->post('tema');
                $fecha_inicio=$this->input->post('fecha_inicio');
                $fecha_final=$this->input->post('fecha_final');
                $platica=$this->input->post('platica');

                $this->load->model('Jefe_m');
                $this->Jefe_m->update_platica($platica, $tema, $fecha_inicio, $fecha_final);

                redirect('Jefe/platica?p='.$platica);
            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

        public function insert_contenido()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $tipo=$this->input->post('tipo_contenido');
                $nombre=$this->input->post('nombre_contenido');
                $platica=$this->input->post('platica');

                $config['upload_path']          = './public/contenido/';
                $config['allowed_types']        = 'pdf|jpg|png|mp4';
                $config['max_size']             = 500000;
                $config['max_width']            = 0;
                $config['max_height']           = 0;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                    $error = array('error' => $this->upload->display_errors());

                    print_r($error);
                    //$this->load->view('upload_form', $error);
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());

                    $ruta='public/contenido/'.$data['upload_data']['file_name'];

                    //var_dump($data);

                    $this->load->model('Jefe_m');
                    $this->Jefe_m->insert_contenido($nombre, $ruta, $tipo, $platica);

                    redirect('Jefe/platica?p='.$platica);
                }


            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

        public function update_contenido()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $tipo_contenido=$this->input->post('tipo_contenido');
                $nombre=$this->input->post('nombre_contenido');
                $contenido=$this->input->post('contenido');
                $eliminar=$this->input->post('eliminar');

                $platica=$this->input->post('platica');

                if ($eliminar=='')
                {
                    $eliminar=0;
                }

                $this->load->model('Jefe_m');
                $this->Jefe_m->update_contenido($contenido, $nombre, $tipo_contenido, $eliminar);

                redirect('Jefe/platica?p='.$platica);
            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

        public function undelete_contenido()
        {
            if ($this->session->userdata('usuario')!=NULL && $this->session->userdata('rol')=='JEFE')
            {
                $contenido=$this->input->get('c');
                $platica=$this->input->get('p');

                $this->load->model('Jefe_m');
                $this->Jefe_m->update_contenido($contenido, 'DESHACER', '', 0);

                redirect('Jefe/platica?p='.$platica);
            }
            else
            {
                redirect('Login'); // si la sesión caduca, lo reenvia a login
            }
        }

    }
?>