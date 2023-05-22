<?php

// autoload.php



//spl_autoload_register ( 'template_autoload' );



function template_autoload ( $classname ) {

  
    try
        {   

            $class     = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($classname) ) );

            $file_path = get_template_directory() . DIRECTORY_SEPARATOR . $class . '.php';



            // echo $file_path;

            // exit;



            if ( file_exists( $file_path ) )

                require_once $file_path;

        } catch(Error $ex) {

            return 'Error: ' . $ex->getMessage();

        }
    }

