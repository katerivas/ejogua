<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Buscador_itinerarios_m extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
public function ver_itinerarios($id_estacion_inicio, $id_estacion_final){

        $itinerarios = array();
        $this->db->select('l.detalle as linea,
                          i.hora_salida as hora_salida,
                          i.hora_llegada as hora_llegada,
                          c.nombre_ciudad as ciudad,
                          ei.detalle as estacion_inicio,
                          ef.detalle as estacion_final');
        $this->db->from('itinerarios i');
        $this->db->where('i.id_estacion_inicio',$id_estacion_inicio);
        $this->db->where('i.id_estacion_final',$id_estacion_final);
        $this->db->join('ciudades c', 'i.id_ciudad = c.id_ciudad');
        $this->db->join('lineas l', 'i.id_linea = l.id_linea');
        $this->db->join('estaciones ei', 'ei.id_estacion = i.id_estacion_inicio');
        $this->db->join('estaciones ef', 'ef.id_estacion = i.id_estacion_final');
        $query = $this->db->get();
        return $query;
}
function get_estaciones() {
        $data = array();
        $this->db->select('id_estacion, detalle');
        $query = $this->db->get('estaciones');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
        }
        $query->free_result();
        return $data;
  }

}
