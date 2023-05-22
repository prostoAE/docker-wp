<?php

namespace inc\letsmake\storage;

use Exception;
use inc\letsmake\Letsmake_Log;

class Letsmake_Storage
{

    public $db_version;

    private $option_db_vercion = 'letsmake_db_version';

    private $table_name = 'letsmake_theme';

    // private static $instances = [];

    function __construct()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $this->db_version = !empty(_S_VERSION) ? _S_VERSION : '1.0.0';
    }

    /**
     *
     * @return void
     */

    function init()
    {
        $installed_db_version = get_option($this->option_db_vercion, 0);
        if (version_compare($this->db_version, $installed_db_version, '>'))
            $this->upgrade();
    }

    function upgrade()
    {
        update_option($this->option_db_vercion, $this->db_version);
        $this->create_table();
    }

    public function get_option_db_vercion()

    {

        return $this->option_db_vercion;

    }



    /**

     * Summary of create_table

     * @return void

     */

    private function create_table()

    {



        global $wpdb;

        $table_name = $this->get_table_name();

        $charset_collate = $wpdb->get_charset_collate();



        $sql = "CREATE TABLE IF NOT EXISTS `{$table_name}` (

            id int(11) unsigned NOT NULL auto_increment,

            name varchar(255) NOT NULL default '',

            value varchar(255) NOT NULL default '',

            PRIMARY KEY  (id)

        ) {$charset_collate};";



        dbDelta($sql);



        if (!empty($wpdb->last_error))

            $this->trouble($wpdb->last_error . ' / function create_table()');

    }



    /**

     * Summary of save_option

     * @param string $name

     * @param array $value

     * @return mixed

     */

    public function save_option(string $name, array $value = [])

    {

        global $wpdb;

        $table_name = $this->get_table_name();



        $value = json_encode($value);



        // var_dump($this->get_option($name));

        // exit;

        if ($this->get_option($name)) {

            $option_save = $wpdb->update($table_name, ['value' => $value ], [ 'name' => $name]);

            if (!empty($wpdb->last_error))
            $this->trouble($wpdb->last_error . ' / function save_option()');
            return $option_save;

        } else {
            $option_save = $wpdb->insert( $table_name, [ 'name' => $name, 'value' => $value ] );

            if (!empty($wpdb->last_error))
            $this->trouble($wpdb->last_error . ' / function save_option()');
            return $option_save;
        }

    }



    public function delete_option($name)
    {
        global $wpdb;
        $table_name = $this->get_table_name();
    }

    function get_option(string $name, bool $type = true)
    {
        if (empty($name))
            return 'name empty';
        global $wpdb;
        $table_name = $this->get_table_name();

        $option = null;
        
        if(!empty($table_name)){
            $option = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name` WHERE `name` = '$name'"));
        }
        if($type)

            $option = json_decode($option->value, true);

        // var_dump($option);

        // exit;



        if (!empty($wpdb->last_error))

        $this->trouble($wpdb->last_error . ' / function get_option()');

        return $option;

    }

    /**
     * Summary of get_options
     * @param array|string $args
     * @return mixed
     */

    function get_options( $args )
    {
        if (empty($args) && (!is_string($args) || !is_array($args)))

            return 'no params';



        $names = is_string($args) ? $args : '';



        if (is_array($args)) {

            foreach ($args as $arg) {



                if (is_string($arg))

                    $names .= $arg . ',';

            }

            $names = trim($names, ',');

        }



        if (empty($names))

            return 'no params';



        global $wpdb;

        $table_name = $this->get_table_name();


        $option = null;
        if(!empty($table_name)){
            $option = $wpdb->get_results( $wpdb->prepare("SELECT * FROM `$table_name` WHERE `name`=%d",$names));
        }


        if (!empty($wpdb->last_error)) {

            $option = $wpdb->last_error;

            $this->trouble($wpdb->last_error . ' / function get_options()');

        }



        return $option;

    }



    public function get_table_name()

    {

        global $wpdb;

        $table_name = $wpdb->get_blog_prefix() . $this->table_name;

        return $table_name;

    }



    /**

     * trouble - write log.txt

     * @param mixed $mess

     * @return void

     */

    private function trouble($mess = '')

    {

        $log = new Letsmake_Log();

        $log->log($mess, __FILE__);

    }



}