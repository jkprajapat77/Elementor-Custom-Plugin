<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
class MYEW_Posts_Widget extends Widget_Base {

    public function get_name() {
        return  'myposts-widget-id';
    }

    public function get_title() {
        return esc_html__( 'Post Types', 'my-elementor-widget' );
    }

    public function get_script_depends() {
        return [
            'myew-script'
        ];
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return [ 'myew-for-elementor' ];
    }

  
protected function register_controls() {
    //Get All CPT   
        global $wp_post_types;
        $options = [];

        if ( ! $wp_post_types ) {
            $options[''] = __( 'No Post Types were found', 'elementor' );
        } 
        else {
            $options[''] = __( 'Choose Post Types', 'elementor' );
            foreach ( $wp_post_types as $post_id => $post ) {
                $options[ $post_id ] = $post_id;
            }
        }
            
        $default_key = array_keys( $options );
        $default_key = array_shift( $default_key );

        $this->start_controls_section(
            'section_post',
            [
                'label' => __( 'Post', 'elementor' ),
            ]
        );

    // Add Select CPT
        $this->add_control( 'post_types', [
            'label' => __( 'Choose Post Type', 'elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => $default_key,
            'options' => $options,
        ] );

        $this->end_controls_section();

    // Add CPT Design Tab
        $this->start_controls_section(
            'design_section',
            [
                'label' => __( 'Design', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

    //Add CPT Design Style
        $this->add_control(
            'design_style',
            [
                'label' => __( 'Choose Design', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'Choose Design',
                'options' => [
                    'Choose Design' => __( 'Choose Design' ),
                    'Grid' => __( 'Grid', 'plugin-domain' ),
                    'Slider' => __( 'Slider', 'plugin-domain' ),
                    'Masonry-grid' => __( 'Masonry Grid', 'plugin-domain' ),
                ],
            ]
        );  

    // Add Number of CPT Post
        $this->add_control(
            'number-of-post',
            [
                'label' => __( 'Number of Post', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999999999,
                'step' => 1,
                'default' => 0,
            ]
        );
        $this->end_controls_section();

    //Add Tab_CONTECT for Grid
        $this->start_controls_section(
            'grid_section',
            [
                'label' => __( 'Grid Setting', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

    // Add Number of Grid Column
        $this->add_control(
            'column-show',
            [
                'label' => __( 'Column', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 12,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'slider_section',
            [
                'label' => __( 'Slider Setting', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

    // Add Number of Slider in Slide Show
        $this->add_control(
            'slide-show',
            [
                'label' => __( 'Slides To Show', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 99999999999,
                'step' => 1,
                'default' => 1,
            ]
        ); 

    // Add Number of Slide Scroll
        $this->add_control(
            'scroll-slides',
            [
                'label' => __( 'Scroll Slides', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 99999999999,
                'step' => 1,
                'default' => 1,
            ]
        );

    // Add Number of Slider Speed
        $this->add_control(
            'slider-speed',
            [
                'label' => __( 'Slider Speed', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 99999999999,
                'step' => 1,
                'default' => 1500,
            ]
        );

    //Add Slider Autoplay
        $this->add_control(
            'slider-autoplay',
            [
                'label' => __( 'Autoplay', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => __( 'True', 'plugin-domain' ),
                    'false' => __( 'False', 'plugin-domain' ),
                ],
            ]
        );   


    //Add Slider Infinite Scroll
        $this->add_control(
            'infinite-scroll',
            [
                'label' => __( 'Infinite Scroll', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => __( 'True', 'plugin-domain' ),
                    'false' => __( 'False', 'plugin-domain' ),
                ],
            ]
        );   

    //Add Slider Dots
        $this->add_control(
            'slider-dots',
            [
                'label' => __( 'Dots', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => __( 'True', 'plugin-domain' ),
                    'false' => __( 'False', 'plugin-domain' ),
                ],
            ]
        );   


    //Add Slider Arrows
        $this->add_control(
            'slider-arrows',
            [
                'label' => __( 'Arrows', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => __( 'True', 'plugin-domain' ),
                    'false' => __( 'False', 'plugin-domain' ),
                ],
            ]
        );   
}


    private function style_tab() {}

    protected function render() {
        $post             = $this->get_settings_for_display( 'post_types' );
        $design_style     = $this->get_settings_for_display('design_style');
        $number_posts     = $this->get_settings_for_display();
        $show_column       = $this->get_settings_for_display('column-show');
        $slide_show       = $this->get_settings_for_display('slide-show');
        $scroll_slides    = $this->get_settings_for_display('scroll-slides');
        $slider_autoplay  = $this->get_settings_for_display('slider-autoplay');
        $slider_dots      = $this->get_settings_for_display('slider-dots');
        $infinite_scroll  = $this->get_settings_for_display('infinite-scroll');
        $slider_arrows    = $this->get_settings_for_display('slider-arrows');
        $slider_speed     = $this->get_settings_for_display('slider-speed');

        if ( empty( $post ) ) {
            return;
        }

    //Add Grid
        if ($design_style == 'Grid') {
            echo '<div class="elemntor-grid">';
            $post_data_arr = get_posts(array('post_type' => $post, 'numberposts' => $number_posts['number-of-post']));
            foreach ($post_data_arr as $get_post_data) {
                $get_post_id = $get_post_data->ID;
                $image_id = get_post_thumbnail_id($get_post_id);
                $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
                echo '<div class="elementor-col-'.$show_column.'">';
                    echo '<img src="'.get_the_post_thumbnail_url($get_post_id).'" alt="'.$alt_text.'" />';
                echo '</div>';
           }
            echo '</div>';
        }

        elseif ($design_style == 'Slider') {
        // Add Slider
            echo '<div class="elementor-custom-slider">';
            $post_data_arr = get_posts(array('post_type' => $post, 'numberposts' => $number_posts['number-of-post']));
            foreach ($post_data_arr as $get_post_data) {
                $get_post_id = $get_post_data->ID;
                $image_id = get_post_thumbnail_id($get_post_id);
                $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
                echo '<div>';
                    echo '<img src="'.get_the_post_thumbnail_url($get_post_id).'" alt="'.$alt_text.'" />';
                echo '</div>';
            }
            echo '</div>';
            ?>

            <script>
                jQuery(document).ready(function($) {

                //convert php variable to js 
                    var slide_show      = "<?php echo $slide_show; ?>";
                    var scroll_slides   = "<?php echo $scroll_slides; ?>";
                    var slider_autoplay = "<?php echo $slider_autoplay; ?>";
                    var slider_arrows   = "<?php echo $slider_arrows; ?>";
                    var slider_dots     = "<?php echo $slider_dots; ?>";
                    var slider_speed     = "<?php echo $slider_speed; ?>";
                    var infinite_scroll     = "<?php echo $infinite_scroll; ?>";
                    
                //convert string to boolean value    
                    var dots_var = (slider_dots === 'true');
                    var arrow_var = (slider_arrows === 'true');
                    var infinite_scroll_var = (infinite_scroll === 'true');
                    var slider_autoplay_var = (slider_autoplay === 'true');

                //convert string to number value    
                    var slide_show_var = Number(slide_show);
                    var slide_scroll = Number(scroll_slides);
                    var slider_speed_var = Number(slider_speed);

                //Slick Slider Add
                    $('.elementor-custom-slider').slick({
                        dots: dots_var,
                        arrows: arrow_var,
                        infinite: infinite_scroll_var,
                        speed: slider_speed_var,
                        slidesToShow: slide_show_var,
                        slidesToScroll: slide_scroll,
                        autoplay: slider_autoplay_var,
                    });
                });
            </script>

            <?php
        }

        else{
        // Add Masonry-Grid
            echo '<div class="masonry-grid">';
            $post_data_arr = get_posts(array('post_type' => $post, 'numberposts' => $number_posts['number-of-post']));
            foreach ($post_data_arr as $get_post_data) {
                $get_post_id = $get_post_data->ID;
                $image_id = get_post_thumbnail_id($get_post_id);
                $alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);
                echo '<div class="masonry-item">';
                    echo '<img src="'.get_the_post_thumbnail_url($get_post_id).'" alt="'.$alt_text.'" />';
                echo '</div>';
           }
            echo '</div>';
        }

    }

    protected function content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new MYEW_Posts_Widget() );
?>
