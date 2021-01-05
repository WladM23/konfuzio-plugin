<?php

class Konfuzio_Plugin_Sortcode_Visualisator{

    private $konfuzio_plugin;

    private $version;

    public function __construct( $konfuzio_plugin, $version ) {

        $this->konfuzio_plugin = $konfuzio_plugin;
        $this->version = $version;

    }

    public function enqueue_styles() {

        wp_enqueue_style( $this->konfuzio_plugin.'style_1', plugin_dir_url( __FILE__ ) . 'bootstrap/css/bootstrap-grid.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->konfuzio_plugin.'style_2', plugin_dir_url( __FILE__ ) . 'bootstrap/css/bootstrap-grid.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->konfuzio_plugin.'style_3', plugin_dir_url( __FILE__ ) . 'bootstrap/css/bootstrap-reboot.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->konfuzio_plugin.'style_4', plugin_dir_url( __FILE__ ) . 'bootstrap/css/bootstrap-reboot.min.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->konfuzio_plugin.'style_5', plugin_dir_url( __FILE__ ) . 'bootstrap/css/bootstrap.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->konfuzio_plugin.'style_6', plugin_dir_url( __FILE__ ) . 'bootstrap/css/bootstrap.min.css', array(), $this->version, 'all' );
    }

    public function enqueue_scripts() {
        wp_enqueue_script( $this->konfuzio_plugin, plugin_dir_url( __FILE__ ) . 'bootstrap/js/bootstrap.bundle.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->konfuzio_plugin, plugin_dir_url( __FILE__ ) . 'bootstrap/js/bootstrap.js', array( 'jquery' ), $this->version, false );
    }

    private function my_objekt($categroy){
        $args = array( 'category_name' => $categroy );
        $my_posts = get_posts( $args );
        $output = '';
        if( ! empty( $my_posts ) ){
            $output = '<div style="border-radius: 20px; padding: 10px 10px 0px; margin-bottom: 20px; border: 2px solid #000000;"><div style="margin-left: 10px; margin-right: 10px; padding-bottom: 0px; margin-bottom: x;"> <h3 style="margin-left: 20px; margin-right: 20px;">'.$categroy.'</h3><hr/></div>';
            $counter = 1;
            foreach ( $my_posts as $p ){

                $output .= '<div style="padding-bottom: 0px; margin-bottom: -20px;">
    <div>
        <p>'.$counter.'</p>
        <p style="position: relative; top: -41px; left: 30px; padding-right: 40px;">'. substr(strip_tags(get_post_field('post_content', $p->ID)),0,250).'</p>
    </div>
    
    <div style="direction: ltr; text-align: center; position: relative; top: -42px;">
                                    <a class="btn btn-secondary" href="'. get_permalink($p->ID).'"style="background-color: #707070; color: #ffffff;">Show text section</a> 
                            </div>
                          </div>';

                $counter +=1;
            }
            $output .= '</div>';
        }
        return $output;
    }

    private function my_grid($ob1, $ob2, $ob3){

        $outpot = '<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                '.$ob1.'                  
            </div>
            <div class="col-md-4">
                '.$ob2.'                 
            </div>
            <div class="col-md-4">
                '.$ob3.'              
            </div>
        </div>
    </div>
</body>';
        return $outpot;
    }

//[foobar]
   public function konfuzio_visualisator( $atts ){
        $my_categorys = get_categories();

        $objekts_1 = '';
        $objekts_2 = '';
        $objekts_3 = '';

        $count = 0;

        foreach ($my_categorys as $category){

            if($count % 3 == 0){
                $objekts_1 .= $this->my_objekt($category->name);
            }elseif ($count % 3 == 1){
                $objekts_2 .= $this->my_objekt($category->name);
            }elseif ($count % 3 == 2){
                $objekts_3 .= $this->my_objekt($category->name);
            }
            $count += 1;
        }

        return $this->my_grid($objekts_1,$objekts_2, $objekts_3);
    }

}
