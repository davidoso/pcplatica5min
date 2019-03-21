<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Supervisor extends CI_controller{

        public function index()
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                redirect('Supervisor/platicas');
            }
            redirect('Login'); // si la sesión caduca, lo reenvia a login
        }

        public function definir_navbar() // define el navbar de acuerdo al rol
        {
            $var='';
            switch ($this->session->userdata('rol'))
            {
                case 'JEFE': $var='recursos/administrador/navbar';
                    break;
                case 'SUPERVISOR': $var='recursos/usuario/navbar';
                    break;
            }
            return $var;
        }

        public function platicas() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $this->load->model('Supervisor_m');
                $array=array(
                    'platicas'=>$this->Supervisor_m->get_platicas_vigentes()
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/platicas_disponibles', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function buscar_platicas() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $t=$this->input->get('t');
                $fi=$this->input->get('fi');
                $ft=$this->input->get('ft');
                $s=$this->input->get('s');

                $filtro=$this->filtro_busqueda($t, $fi, $ft, $s);

                $this->load->model('Supervisor_m');
                $array=array(
                    'platicas'=>$this->Supervisor_m->get_all_platicas(),
                    'resultados'=>$this->Supervisor_m->get_busqueda_reunion($filtro)
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/buscar_platicas', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function filtro_busqueda($t, $fi, $ft, $s)
        {
            $w='WHERE r.reu_erased=0';

            if ($fi != NULL && $ft != NULL) // Si el usuario selecciona ambas fechas, tomar ese rango
            {
                $w=$w." AND r.reu_fecha BETWEEN '".$fi."' AND '".$ft."'";
            }
            elseif ($fi != NULL) // Si el usuario selecciona solo fecha inicio, tomar desde esa fecha hasta la fecha actual
            {
                $w=$w." AND r.reu_fecha BETWEEN '".$fi."' AND NOW()";

            }
            elseif ($ft != NULL) // Si el usuario selecciona solo fecha término, tomar desde una fecha default (2017-01-01) hasta dicha fecha
            {
                $w=$w." AND r.reu_fecha BETWEEN '2017-01-01' AND '".$ft."'";
            }

            if ($t != NULL &&  $t != -1)
            {
                $w=$w." AND p.id_platica='".$t."'";
            }

            if ($s != NULL)
            {
                $w=$w." AND r.reu_id_supervisor='".$s."'";
            }

            return $w;
        }

        public function reporte_platicas() // ver el reporte de pláticas en determinado rango de fechas
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $this->load->model('Supervisor_m');
                $array=array(
                    'supervisores'=>$this->Supervisor_m->get_supervisores()
                );
                $array_footer=array(
                    'reporte_platicas_js'=>true
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/reporte_platicas', $array);
                $this->load->view('recursos/footer', $array_footer);
            }
            else
            {
                redirect('Login');
            }
        }

        public function reporte_buscar() // obtener resultados y mostrar en la tabla
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $this->load->model('Supervisor_m', 'sm');
                $result = $this->sm->get_reporte();
                echo json_encode($result);
            }
            else
            {
                redirect('Login');
            }
        }

        public function platicas_registradas() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $this->load->model('Supervisor_m');
                $array=array(
                    'temas'=>$this->Supervisor_m->get_temas_registrados($this->session->userdata('usuario')),
                    'reuniones'=>$this->Supervisor_m->get_reuniones($this->session->userdata('usuario'))
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/platicas_registradas', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function registrar_reunion() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $platica=$this->input->get('p');

                $this->load->model('Supervisor_m');
                $array=array(
                    'platica'=>$this->Supervisor_m->get_platica($platica),
                );

                date_default_timezone_set("America/Mexico_City"); // define la hora local de México

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/reg_reunion', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function insert_reunion() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $platica=$this->input->post('platica');

                $fecha=$this->input->post('fecha');
                $hora=$this->input->post('hora');
                $semana=$this->input->post('semana');
                $empresa=$this->input->post('empresa');

                $this->load->model('Supervisor_m');
                $this->Supervisor_m->insert_reunion($fecha, $hora, $semana, $empresa, $this->session->userdata('usuario'), $this->session->userdata('nombre'), $platica);

                $reunion=$this->Supervisor_m->get_last_id();

                redirect('Supervisor/load_contenido?p='.$platica.'&r='.$reunion[0]->id);
            }
            else
            {
                redirect('Login');
            }
        }

        public function update_reunion() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $platica=$this->input->post('platica');

                $reunion=$this->input->post('reunion');
                $fecha=$this->input->post('fecha');
                $hora=$this->input->post('hora');
                $semana=$this->input->post('semana');
                $empresa=$this->input->post('empresa');

                $this->load->model('Supervisor_m');
                $this->Supervisor_m->update_reunion($reunion, $fecha, $hora, $semana, $empresa);

                redirect('Supervisor/load_reunion?r='.$reunion.'&p='.$platica);
            }
            else
            {
                redirect('Login');
            }
        }

        public function load_reunion() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $reunion=$this->input->get('r');
                $platica=$this->input->get('p');

                $this->load->model('Supervisor_m');
                $array=array(
                    'platica'=>$this->Supervisor_m->get_platica($platica),
                    'reunion'=>$this->Supervisor_m->get_reunion($reunion),
                    'contenido'=>$this->Supervisor_m->get_contenido($platica),
                    'participaciones'=>$this->Supervisor_m->get_participaciones($reunion)
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/reunion', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function load_contenido() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $reunion=$this->input->get('r');
                $platica=$this->input->get('p');

                $this->load->model('Supervisor_m');
                $array=array(
                    'contenido'=>$this->Supervisor_m->get_contenido($platica)
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/contenido', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function reg_participacion() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $reunion=$this->input->get('r');
                $platica=$this->input->get('p');

                $this->load->model('Supervisor_m');
                $array=array(
                    'participaciones'=>$this->Supervisor_m->get_participaciones_desc($reunion)
                );

                $this->load->view('recursos/header');
                $this->load->view($this->definir_navbar());
                $this->load->view('supervisor/reg_asistencia', $array);
                $this->load->view('recursos/footer');
            }
            else
            {
                redirect('Login');
            }
        }

        public function reg_participacion_tarjeta() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $codigo=$this->input->get('c');
                $reunion=$this->input->get('r');
                $platica=$this->input->get('p');

                $this->load->model('Supervisor_m');

                $empleado=$this->Supervisor_m->get_empleado_tarjeta($codigo);

                if (count($empleado)>0)
                {
                    $this->insert_participacion_tarjeta($empleado, $reunion, $platica);
                }
                else
                {
                    redirect('Supervisor/reg_participacion?r='.$reunion.'&p='.$platica);
                }

            }
            else
            {
                redirect('Login');
            }
        }

        public function reg_participacion_codigo() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $codigo=$this->input->get('ce');
                $reunion=$this->input->get('r');
                $platica=$this->input->get('p');

                $this->load->model('Supervisor_m');
                $array=array(
                    'empleado'=>$this->Supervisor_m->get_empleado_codigo($codigo),
                    'reunion'=>$this->Supervisor_m->get_reunion($reunion)
                );

                if (count($array['empleado'])>0)
                {
                    $this->load->view('recursos/header');
                    $this->load->view($this->definir_navbar());
                    $this->load->view('supervisor/insert_participacion', $array);
                    $this->load->view('recursos/footer');
                }
                else
                {
                    redirect('Supervisor/reg_participacion?r='.$reunion);
                }

            }
            else
            {
                redirect('Login');
            }
        }

        public function insert_participacion() // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $reunion=$this->input->post('reunion');
                $platica=$this->input->post('platica');

                $codigo=$this->input->post('codigo');
                $nombre=$this->input->post('nombre');
                $puesto=$this->input->post('puesto');
                $metodo=$this->input->post('metodo');

                $this->load->model('Supervisor_m');
                $this->Supervisor_m->insert_participacion($codigo, $nombre, $puesto, $reunion, $metodo);

                redirect('Supervisor/reg_participacion?r='.$reunion.'&p='.$platica);
            }
            else
            {
                redirect('Login');
            }
        }

        public function insert_participacion_tarjeta($empleado, $reunion, $platica) // ver las pláticas disponibles
        {
            if ($this->session->userdata('usuario')!=NULL)
            {
                $this->load->model('Supervisor_m');
                $this->Supervisor_m->insert_participacion($empleado[0]->Codigo, $empleado[0]->Nombre, $empleado[0]->Puesto, $reunion, 'Tarjeta');

                redirect('Supervisor/reg_participacion?r='.$reunion.'&p='.$platica);
            }
            else
            {
                redirect('Login');
            }
        }

    }
?>