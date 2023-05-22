<?php
namespace inc\letsmake;

/**
 * write log file class LetsmakeLog
 * 
 * @version ${1:1.0.0
 * @author 1 <zin4ik>
 */
class Letsmake_Log
{

    /**
     * Summary of log
     * @param mixed $file
     * @param mixed $mess
     * @return void
     */
    public function log($mess = '', $file = '')
    {
    
        $logFileName = __FILE__ . "log.txt"; 
        $file = !empty($file) ? $file : 'letsmake';
        $message = $mess . "\n"; 
        $message .= '( '. $file . ' ) '. date('d.m.Y H:i:s') . "\n"; 
        file_put_contents($logFileName, $message, FILE_APPEND); 

    }

}