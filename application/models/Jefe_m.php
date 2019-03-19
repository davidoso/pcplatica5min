<?php
    class Jefe_m extends CI_Model
    {
        
        /* -------------------------------------------------------------- contenido -------------------------------------------------------------- */
        
        public function get_contenido($platica)
        {
            $var=$this->db->query("
                SELECT
                    c.id_contenido as id,
                    c.con_nombre as nombre,
                    c.con_ruta as ruta,
                    c.con_create_time as create_time,
                    c.con_erased as erased,
                    c.con_id_platica as id_platica,
                    c.con_id_tipo_contenido as id_tipo_contenido,
                    tc.tco_tipo as tipo,
                    tc.tco_formato as formato
                FROM contenido c
                INNER JOIN tipo_contenido tc on tc.id_tipo_contenido=c.con_id_tipo_contenido
                WHERE c.con_id_platica='$platica'
                ORDER BY c.con_nombre
            ");
            return $var->result();
        }
        
        public function insert_contenido($nombre, $ruta, $tipo, $platica)
        {
            $this->db->query("
                call spInsertContenido('$nombre', '$ruta', '$tipo', '$platica')
            ");
        }
        
        public function update_contenido($contenido, $nombre, $tipo_contenido, $eliminar)
        {
            $this->db->query("
                call spUpdateContenido('$contenido','$nombre','$tipo_contenido','$eliminar')
            ");
        }
        
        /* -------------------------------------------------------------- / contenido -------------------------------------------------------------- */
        
        /* -------------------------------------------------------------- platica -------------------------------------------------------------- */
        
        public function get_last_platicas()
        {
            $var=$this->db->query("
                SELECT
                    p.id_platica as id,
                    p.pla_tema as tema,
                    DATE_FORMAT(p.pla_fecha_inicio, '%d/%m/%Y') as fecha_inicio,
                    DATE_FORMAT(p.pla_fecha_final, '%d/%m/%Y') as fecha_final,
                    p.pla_estatus as estatus,
                    p.pla_create_time as create_time,
                    p.pla_erased as erased
                FROM platica p
                ORDER BY p.pla_create_time DESC
                LIMIT 10
            ");
            return $var->result();
        }
        
        public function get_busqueda_platicas($tema)
        {
            $var=$this->db->query("
                SELECT
                    p.id_platica as id,
                    p.pla_tema as tema,
                    DATE_FORMAT(p.pla_fecha_inicio, '%d/%m/%Y') as fecha_inicio,
                    DATE_FORMAT(p.pla_fecha_final, '%d/%m/%Y') as fecha_final,
                    p.pla_estatus as estatus,
                    p.pla_create_time as create_time,
                    p.pla_erased as erased
                FROM platica p
                WHERE p.pla_tema LIKE '%$tema%'
                ORDER BY p.pla_create_time DESC
            ");
            return $var->result();
        }
        
        public function get_platica($platica)
        {
            $var=$this->db->query("
                SELECT
                    p.id_platica as id,
                    p.pla_tema as tema,
                    DATE_FORMAT(p.pla_fecha_inicio, '%d/%m/%Y') as fecha_inicio,
                    DATE_FORMAT(p.pla_fecha_final, '%d/%m/%Y') as fecha_final,
                    p.pla_estatus as estatus,
                    p.pla_create_time as create_time,
                    p.pla_erased as erased,
                    p.pla_fecha_inicio as u_fi,
                    p.pla_fecha_final as u_ff
                FROM platica p
                WHERE p.id_platica='$platica'
            ");
            return $var->result();
        }
        
        public function insert_platica($tema, $fecha_inicio, $fecha_final)
        {
            $this->db->query("
                call spInsertPlatica('$tema', '$fecha_inicio', '$fecha_final')
            ");
        }
        
        public function update_platica($platica, $tema, $fecha_inicio, $fecha_final)
        {
            $this->db->query("
                call spUpdatePlatica('$platica', '$tema', '$fecha_inicio', '$fecha_final')
            ");
        }
        
        /* -------------------------------------------------------------- / platica -------------------------------------------------------------- */
        
        /* -------------------------------------------------------------- tipo_contenido -------------------------------------------------------------- */
        
        public function get_tipo_contenido()
        {
            $var=$this->db->query("
                SELECT
                    tc.id_tipo_contenido as id,
                    tc.tco_tipo as tipo,
                    tc.tco_formato as formato,
                    tc.tco_create_time as create_time,
                    tc.tco_erased as erased
                FROM tipo_contenido tc
                WHERE tc.tco_erased=0
                ORDER BY tc.tco_tipo, tc.tco_formato
            ");
            return $var->result();
        }
        
        /* -------------------------------------------------------------- / tipo_contenido -------------------------------------------------------------- */
        
        public function update_trabajo($id,$familia,$equipo,$inicio,$turno,$descripcion,$termino,$pendientes,$usuario,$personal)
        {
            $this->db->query("
                call spUpdateTrabajo('$id','$familia','$equipo','$inicio','$turno','$descripcion','$termino','$pendientes','$usuario','$personal')
            ");
        }
        
        public function delete_trabajo($trabajo,$opcion)
        {
            $this->db->query("
                call spUDeleteTrabajo('$trabajo','$opcion')
            ");
        }
        
        /* -------------------------------------------------------------- usuario -------------------------------------------------------------- */
        
        public function get_usuarios()
        {
            $var=$this->db->query("
                SELECT
                    u.id_usuario as id,
                    u.usu_codigo as codigo,
                    u.usu_nivel as nivel,
                    u.usu_create_time as create_time,
                    u.usu_erased as erased
                FROM usuario u
            ");
            return $var->result();
        }
        
        public function insert_usuario($usuario)
        {
            $this->db->query("
                call spInsertUsuario('$usuario')
            ");
        }
        
        public function delete_usuario($usuario,$erased)
        {
            $this->db->query("
                call spUDeleteUsuario('$usuario','$erased')
            ");
        }
        
        /* -------------------------------------------------------------- / usuario -------------------------------------------------------------- */
        
        /* -------------------------------------------------------------- API WEB -------------------------------------------------------------- */
        
        public function get_familias()
        {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "http://vadaexterno:8080/wsAutEmp/Service1.asmx/FamiliasEquipos"); 
            curl_setopt($ch, CURLOPT_POST, 1); //se puede comentar y de todos modos jala
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,"");
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch); // la variable output contiene el json raw
            
            $data=json_decode($output);
            
            return $data;
        }
        
        public function get_equipos($familia)
        {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "http://vadaexterno:8080/wsAutEmp/Service1.asmx/EquiposFamilia"); 
            curl_setopt($ch, CURLOPT_POST, 1); //se puede comentar y de todos modos jala
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,"familia=$familia");
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch); // la variable output contiene el json raw
            
            $data=json_decode($output);
            
            return $data;
        }
        
        /* -------------------------------------------------------------- /API WEB -------------------------------------------------------------- */
    }
?>