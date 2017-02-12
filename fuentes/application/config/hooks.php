<?php
$hook['post_controller'] = array(     // 'post_controller' indicated execution of hooks after controller is finished
    'class' => 'Db_log',             // Name of Class
    'function' => 'insertar_query_log',     // Name of function to be executed in from Class
    'filename' => 'db_log.php',    // Name of the Hook file
    'filepath' => 'hooks'         // Name of folder where Hook file is stored
);
