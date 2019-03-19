<?php
    class Supervisor_m extends CI_Model
    {
        
        public function get_last_id()
        {
            $var=$this->db->query("
                SELECT LAST_INSERT_ID() as id;
            ");
            return $var->result();
        }
        
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
                    tc.tco_formato as formato,
                    p.pla_tema as tema
                FROM contenido c
                INNER JOIN tipo_contenido tc on tc.id_tipo_contenido=c.con_id_tipo_contenido
                INNER JOIN platica p on p.id_platica=c.con_id_platica
                WHERE c.con_id_platica='$platica' AND c.con_erased=0
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
        
        /* -------------------------------------------------------------- participacion -------------------------------------------------------------- */
        
        public function get_participaciones($reunion)
        {
            $var=$this->db->query("
                SELECT
                    p.id_participacion as id,
                    p.par_codigo_empelado as codigo,
                    p.par_empleado as empleado,
                    p.par_puesto as puesto,
                    p.par_metodo as metodo,
                    p.par_create_time as create_time,
                    p.par_erased as erased,
                    p.par_id_reunion as id_reunion
                FROM participacion p
                WHERE p.par_id_reunion='$reunion'
                ORDER BY p.par_empleado ASC
            ");
            return $var->result();
        }
        
        public function get_participaciones_desc($reunion)
        {
            $var=$this->db->query("
                SELECT
                    p.id_participacion as id,
                    p.par_codigo_empelado as codigo,
                    p.par_empleado as empleado,
                    p.par_puesto as puesto,
                    p.par_metodo as metodo,
                    p.par_create_time as create_time,
                    p.par_erased as erased,
                    p.par_id_reunion as id_reunion
                FROM participacion p
                WHERE p.par_id_reunion='$reunion'
                ORDER BY p.par_create_time DESC
            ");
            return $var->result();
        }
        
        public function insert_participacion($codigo, $nombre, $puesto, $reunion, $metodo)
        {
            $this->db->query("
                call spInsertParticipacion('$codigo', '$nombre', '$puesto', '$reunion', '$metodo')
            ");
        }
        
        /* -------------------------------------------------------------- / participacion -------------------------------------------------------------- */
        
        /* -------------------------------------------------------------- platica -------------------------------------------------------------- */
        
        public function get_platicas_vigentes()
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
                WHERE p.pla_erased=0 AND p.pla_estatus='VIGENTE'
                ORDER BY p.pla_create_time DESC
            ");
            return $var->result();
        }
        
        public function get_all_platicas()
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
                ORDER BY p.pla_tema ASC
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
        
        /* -------------------------------------------------------------- reunion -------------------------------------------------------------- */
        
        public function get_reunion($reunion)
        {
            $var=$this->db->query("
                SELECT
                    r.id_reunion as id,
                    DATE_FORMAT(r.reu_fecha, '%d/%m/%Y') as fecha,
                    DATE_FORMAT(r.reu_hora, '%H:%i') as hora,
                    r.reu_semana as semana,
                    r.reu_empresa as empresa,
                    r.reu_id_supervisor as id_supervisor,
                    r.reu_supervisor as supervisor,
                    r.reu_fecha as u_fecha,
                    r.reu_hora as u_hora
                FROM reunion r
                WHERE r.id_reunion='$reunion'
            ");
            return $var->result();
        }
        
        public function get_reuniones($usuario)
        {
            $var=$this->db->query("
                SELECT
                    r.id_reunion as id,
                    DATE_FORMAT(r.reu_fecha, '%d/%m/%Y') as fecha,
                    DATE_FORMAT(r.reu_hora, '%H:%i') as hora,
                    r.reu_semana as semana,
                    r.reu_empresa as empresa,
                    r.reu_id_supervisor as id_supervisor,
                    r.reu_supervisor as supervisor,
                    r.reu_fecha as u_fecha,
                    r.reu_hora as u_hora,
                    p.pla_tema as tema,
                    p.id_platica as id_platica
                FROM reunion r
                INNER JOIN platica p on p.id_platica=r.reu_id_platica
               WHERE r.reu_id_supervisor='$usuario' and (SELECT count(*) FROM participacion a inner join 
reunion b on a.par_id_reunion=b.id_reunion where b.id_reunion=r.id_reunion)>0
                ORDER BY r.reu_create_time DESC
            ");
            return $var->result();
        }
        
        public function get_temas_registrados($supervisor)
        {
            $var=$this->db->query("
                SELECT DISTINCT p.pla_tema
                FROM reunion r
                INNER JOIN platica p on p.id_platica=r.reu_id_platica
                WHERE r.reu_id_supervisor='$supervisor'
                ORDER BY p.pla_tema ASC
            ");
            return $var->result();
        }
        
        public function get_busqueda_reunion($filtro)
        {
            $q="SELECT
                    r.id_reunion as id_reunion,
                    DATE_FORMAT(r.reu_fecha, '%d/%m/%Y') as fecha,
                    DATE_FORMAT(r.reu_hora, '%h:%i') as hora,
                    r.reu_semana as semana,
                    r.reu_empresa as empresa,
                    r.reu_id_supervisor as id_supervisor,
                    r.reu_supervisor as nombre_supervisor,
                    r.reu_create_time as create_time,
                    r.reu_erased as erased,
                    p.id_platica as id_platica,
                    p.pla_tema as tema
                FROM reunion r
                INNER JOIN platica p on p.id_platica=r.reu_id_platica
                ".$filtro."
                ORDER BY r.reu_semana DESC, r.reu_fecha DESC";
            
            $var=$this->db->query($q);
            return $var->result();
        }
        
        public function insert_reunion($fecha, $hora, $semana, $empresa, $id_usuario, $nombre_usuario, $platica)
        {
            $this->db->query("
                call spInsertReunion('$fecha', '$hora', '$semana', '$empresa', '$id_usuario', '$nombre_usuario', '$platica')
            ");
        }
        
        public function update_reunion($id, $fecha, $hora, $semana, $empresa)
        {
            $this->db->query("
                call spUpdateReunion('$id', '$fecha', '$hora', '$semana', '$empresa')
            ");
        }
        
        /* -------------------------------------------------------------- / reunion -------------------------------------------------------------- */
        
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
        
        /* -------------------------------------------------------------- API WEB -------------------------------------------------------------- */
        
        public function get_empleado_codigo($codigo)
        {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "http://vadaexterno:8080/wsAutEmp/Service1.asmx/DatosxEmpleado");
            curl_setopt($ch, CURLOPT_POST, 1); //se puede comentar y de todos modos jala
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,"Codigo=$codigo");
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch); // la variable output contiene el json raw
            
            $data=json_decode($output);
            
            return $data;
        }
        
        public function get_empleado_tarjeta($codigo)
        {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, "http://vadaexterno:8080/wsAutEmp/Service1.asmx/VAutEmp");
            curl_setopt($ch, CURLOPT_POST, 1); //se puede comentar y de todos modos jala
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS,"CardNumber=$codigo");
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch); // la variable output contiene el json raw
            
            $data=json_decode($output);
            
            return $data;
        }
        
        /* -------------------------------------------------------------- /API WEB -------------------------------------------------------------- */
    }
?>