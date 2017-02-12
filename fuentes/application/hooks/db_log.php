<?php
// Name of Class as mentioned in $hook['post_controller]
class Db_log {

    function __construct() {
       // Anything except exit() :P
    }

    // Name of function same as mentioned in Hooks Config
    function insertar_query_log() {
        $CI = & get_instance();

        //  $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller

        foreach ($CI->db->queries as $key => $query) {

        //  if(strtolower(substr($query, 0, 6)) != 'select' && strtolower(substr($query, 0, 20)) != 'update `mapa`'){

                              // Se obtiene el userdate de usuario.
                              $v_user_data = $CI->session->userdata('usuario');

                              if(!empty($v_user_data)){
                                  // Se obtiene el usuario id de la session.
                                  $v_usuario_id = $v_user_data->usuario_id;
                                  $data = array(
                                      'query' => $query,
                                      'fecha_hora' => $CI->fecha_hora_actual,
                                      'usuario_id' => $v_usuario_id
                                  );

                                  if($flag_primera_vez){
                                      $flag_primera_vez = false;
                                      $data['uri_string']=$CI->uri->uri_string;
                                      $data['params']=json_encode($_REQUEST);
                                  }
var_dump($data);
die();
                                  // El log se guarda en la base de datos.
                                  $CI->db->insert('query_logs', $data);
                              }
                          }
                  //    }
                  }
    // function insertar_query_log() {
    //         $CI = & get_instance();
    //         // if($CI->db->trans_status()){
    //             $flag_primera_vez = true;
    //
    //             foreach ($CI->db->queries as $key => $query) {
    //
    //               var_dump("holissssss");
    //               die();
    //                 if(strtolower(substr($query, 0, 6)) != 'select'
    //                                     && strtolower(substr($query, 0, 20)) != 'update `mapa`'){
    //
    //                     // Se obtiene el userdate de usuario.
    //                     $v_user_data = $CI->session->userdata('usuario');
    //
    //                     if(!empty($v_user_data)){
    //                         // Se obtiene el usuario id de la session.
    //                         $v_usuario_id = $v_user_data->usuario_id;
    //                         $data = array(
    //                             'query' => $query,
    //                             'fecha_hora' => $CI->fecha_hora_actual,
    //                             'usuario_id' => $v_usuario_id
    //                         );
    //
    //                         if($flag_primera_vez){
    //                             $flag_primera_vez = false;
    //                             $data['uri_string']=$CI->uri->uri_string;
    //                             $data['params']=json_encode($_REQUEST);
    //                         }
    //
    //                         // El log se guarda en la base de datos.
    //                         $CI->db->insert('query_logs', $data);
    //                     }
    //                 }
    //             }
    //         // }
    //     }

}
