<?php

use inc\letsmake\config\Letsmake_Options;



$ltm_options = new Letsmake_Options();



$fields_name = !empty($args['field_name']) ? $args['field_name'] : 'letsmake_settings_style';

$args_display = $args['args_display'];

$options = !empty($args['options']) ? $args['options'] : [];



?>



<div class="letsmake-wrapp">

    <h2>Style Settings</h2>

    <hr><br>



    <form action="/wp-admin/admin.php?page=letsmake_settings_style" method="post">

        <div class="letsmake-wrapp__form-body">

            <?php

            if (is_array($args_display)) {

                foreach ($args_display as $item) {



                    if ('input' === $item['html']) {

                        $name = !empty($item['name']) ? esc_attr($item['name']) : '';

                        $default = !empty($item['default']) ? esc_attr($item['default']) : '';

                        $value = !empty($options[$name]) ? esc_attr($options[$name]) : $default;



                        $ltm_options->html_input($fields_name, $item, $value);



                    }



                }

            }

            ?>

        </div>

        <button type="submit">

            <?php esc_html_e('save', 'letsmake'); ?>

        </button>

    </form>

</div>