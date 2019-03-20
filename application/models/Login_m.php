<?php
    class Login_m extends CI_Model
    {
        public function iniciar_sesion($usuario, $contra)
        {
            $var=$this->db->query("
                SELECT *
                FROM usuario
                WHERE id='$usuario' and pass='$contra'
            ");
            return $var->result();
        }

        public function get_usuario($usuario)
        {
            $var=$this->db->query("
                SELECT
                    u.id_usuario as id,
                    u.usu_codigo as codigo,
                    u.usu_nivel as nivel
                FROM usuario u
                WHERE u.usu_codigo='$usuario' AND u.usu_erased=0
            ");
            return $var->result();
        }

        /* -------------------------------------------------------------- API WEB -------------------------------------------------------------- */

        public function login_apiweb($usuario, $contrasena)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://vadaexterno:8080/wsAutEmp/Service1.asmx/Valida_Usuario");
            curl_setopt($ch, CURLOPT_POST, 1); //se puede comentar y de todos modos funciona
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,"usuario=$usuario&contrasena=$contrasena");
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch); // la variable output contiene el json en formato raw

            $data=json_decode($output);

            return $data;
        }

        /* -------------------------------------------------------------- /API WEB -------------------------------------------------------------- */
    }
?>