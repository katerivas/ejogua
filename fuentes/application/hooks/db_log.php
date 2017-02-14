<?php
// Name of Class as mentioned in $hook['post_controller]
class Db_log {

    function __construct() {
    }

    /**
     *
     */
    // function insertar_query_log() {
    //     $CI = & get_instance();
    //
    //     if($CI->db->trans_status()){
    //         $flag_primera_vez = true;
    //         var_dump($CI->db);
    //         die();
    //         foreach ($CI->db->queries as $key => $query) {
    //             // Se obtiene el userdate de usuario.
    //             $v_user_data = $CI->session->userdata('logged_in');
    //
    //             if(!empty($v_user_data)){
    //                 // Se obtiene el id_usuario de la session.
    //                 $id_usuario = $v_user_data['id_usuario'] * 1;
    //
    //                 $data = array(
    //                     'query' => $query,
    //
    //                     //'query' => "SELECT * FROM 'tarjeta' WHERE 'id_usuario' = '1'",
    //                     'fecha_hora' => date('Y-m-d H:i:s'),
    //                     'usuario_id' => $id_usuario
    //                 );
    //                 $fecha_hora = "'" . date('Y-m-d H:i:s'). "'";
    //                 if($flag_primera_vez){
    //                     $flag_primera_vez = false;
    //                      $uri_string = "'" . $CI->uri->uri_string . "'";
    //                      $params = "'" . json_encode($_REQUEST) . "'";
    //                     $CI->db->query("INSERT INTO query_logs(query, fecha_hora, usuario_id, uri_string, params)
    //                       values('hola', $fecha_hora, $id_usuario, $uri_string, $params)");
    //                 }else{
    //                      $CI->db->query("INSERT INTO query_logs(query, fecha_hora, usuario_id, uri_string, params)
    //                        values('hola', $fecha_hora, $id_usuario, '', '')");
    //                 }
    //                     // var_dump($data);
    //                     // die();
    //                 // El log se guarda en la base de datos.
    //                 //$CI->db->insert('query_logs', $data, true);
    //             }
    //         }
    //     }
    // }

    // Crear la auditoria en archivos logs.
    function insertar_query_log() {
        $CI = & get_instance();

        $filepath = APPPATH . 'logs/Query-log-' . date('Y-m-d') . '.php';
        $handle = fopen($filepath, "a+");

        $times = $CI->db->query_times;

        $v_user_data = $CI->session->userdata('logged_in');
        $id_usuario = $v_user_data['id_usuario'];
        $fecha_hora = date('Y-m-d H:i:s');
        $uri_string = $CI->uri->uri_string;
        $params = json_encode($_REQUEST);
        foreach ($CI->db->queries as $key => $query) {
            $sql = $query . "\t" . $fecha_hora . "\t" . $id_usuario . "\t" . $uri_string . "\t" . $params;
            fwrite($handle, $sql . "\n\n");
        }
        fclose($handle);      // Close the file
    }
}
