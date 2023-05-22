<?php

namespace inc\letsmake\config;

use inc\letsmake\storage\Letsmake_Storage;



class Letsmake_Options
{
    private $storage;
    private $fields_name = [
        'css' => 'letsmake_settings_style',
        'general' => 'letsmake_settings_general',
        // 'header' => 'letsmake_settings_header',
        // 'footer' => 'letsmake_settings_footer',
        'plugins' => 'letsmake_settings_plugins',
    ];

    function __construct()
    {
        $this->storage = new Letsmake_Storage();
    }

    public function get_settings( string $name = '' ){

        $fields_name = $this->fields_name[$name] ? $this->fields_name[$name] : '';
        if (empty($fields_name)) {

            $fields_name = '';
            foreach($this->fields_name as $value){
                $fields_name .= $value . ',';
            }
            $fields_name = trim($fields_name, ',');
        }
        return !empty($this->storage->get_options($fields_name)) ? $this->storage->get_options($fields_name) :  null;
    }

    public function html_input(string $fields_name = '', array $args, $value = '')

    {

        $name = $fields_name;

        if (!empty($args['name'])) {

            $name .= '['. esc_attr( $args['name'] ) .']';
        }

        $checked = '';

        if($args['type'] == 'checkbox' || $args['type'] == 'radio' ){
            $checked = ( $value == 'on' ) ? ' checked' : '';
        }else{
            $value = $value == 'on' ? '' : $value;
        }

    ?>

        

        <div class="letsmake-row-field <?php echo !empty($args['class']) ? esc_attr($args['class']) : '';?>">

            <label><span><?php echo !empty($args['title']) ? esc_html($args['title']) : '';?></span>

                <input type="<?php echo !empty($args['type']) ? esc_attr($args['type']) : 'text';?>" 

                        name="<?php echo $name;?>" 

                        value="<?php echo $value;?>"

                        <?php echo $checked;?>/>

            </label>

            <p class="letsmake-row-field__descr"><?php echo !empty($args['description']) ? $args['description'] : '';?></p>

        </div>

    <?php



    }

    /**
     *  html_select
     * 
     * @var string $fields_name
     * @var array $args parametrs
     * @var int|string $value 
     */
    public function html_select(string $fields_name = '', array $args, $value = '' ){

        $name = $fields_name;

        if (!empty($args['name'])) {
            $name .= '['. esc_attr( $args['name'] ) .']';
        }

        if(empty($args['options']) && !empty($args['post-type']) ){
            $args['options'] = $this->get_query_post_type_all($args['post-type']);
        }
             
        ?>
        <div class="letsmake-row-field <?php echo !empty($args['class']) ? esc_attr($args['class']) : '';?>">

            <label><span><?php echo !empty($args['title']) ? esc_html($args['title']) : '';?></span>

                <select name="<?php echo $name;?>"  value="<?php echo $value;?>">
                <option value='' >---<?php _e('Select item', 'letsmake');?>---</option>
                <?php 
                if(!empty($args['options']) && is_array($args['options'])) {
                    foreach( $args['options'] as $option ){

                        if(!empty($option['value']) && !empty($option['name'])){
                            $selected = ($value == $option['value'] ) ? 'selected' :'';                            
                            echo '<option value="' . $option['value'] . '" ' . $selected . '>' . $option['name'] . '</option>';
                        }
                
                    }
                }
                ?>

                </select>

            </label>

            <p class="letsmake-row-field__descr"><?php echo !empty($args['description']) ? $args['description'] : '';?></p>

        </div>

        <?php

    }


    public function get_query_post_type_all(string $post_type){

        $result = [];

        $args =[
            'post_type' => $post_type,
            'post_status' => 'publish'
        ];

        $the_query = new \WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
      
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $result[]=[
                    'name' => get_the_title(),
                    'value' => get_the_id()
                ];
            }
           
        }

       
        wp_reset_postdata();

        return $result;

    }



    public function get_field_name(string $name)
    {
       return !empty($this->fields_name[$name]) ? $this->fields_name[$name] : '';

    }



    public function get_css_root()
    {

        $fields_param = new Letsmake_Fields();
        $styles_args = $fields_param->get_styles_args();
        $name = $this->get_field_name('css');
        $options = $this->storage->get_option($name);
        $css_root = '';

        if(!empty($styles_args) && !empty($options)){
            $css_root .= '<style id="letsmake-css-root"> :root{';
            foreach ($fields_param->get_styles_args() as $item) {

            if (!empty($item['css-root'])) {
                    $css_name = $item['name'];
                    if( !empty($options[$css_name]) ) continue;

                    if($css_name == 'content-width'){
                        $css_root .= $item['css-root'] . ':' . $options[$css_name] .'px; '; 
                    } elseif(!empty($options[$css_name])) {
                        $css_root .= $item['css-root'] . ':' . $options[$css_name] .'; '; 
                    }
                }
            }

            $css_root .= '}</style>';
        }

        return $css_root;

    }
}

