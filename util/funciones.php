<?php 

function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}


    spl_autoload_register(function($class_name){
        $directorys = array(
            $GLOBALS['ROOT'].'Modelo/',
            $GLOBALS['ROOT'].'Modelo/conector/',
            $GLOBALS['ROOT'].'Control/',
        );
        foreach($directorys as $directory){
            if(file_exists($directory.$class_name . '.php')){
                require_once($directory.$class_name . '.php');
                return;
            }
        }  
    });
    
   


?>