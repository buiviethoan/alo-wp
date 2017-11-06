<?php // 
/*
  Plugin Name: WP AUTO SCRIPT
  Version: 0.1
  Description: auto script
  Author: Bùi Việt Hoàn
  Author URI: http://www.blog-expert.fr
 * Text Domain: wpses
 * Domain Path: /
 */
//if( !class_exists('wpautoscript') ){
//    class wpautoscript {
//
//	function __construct() {
//	    add_action( 'admin_menu', array( &$this, 'admin_init' ) );// add plugin to dashboard
//	    add_action( 'wp_head', array( &$this, 'wp_head' ) );
//	    add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
//	}
//	
//	function admin_init() {
//		    
//	//Register a setting and its data.
//	    register_setting( 'insert-headers-and-footers', 'shfs_insert_header', 'trim' );
//	    register_setting( 'insert-headers-and-footers', 'shfs_insert_footer', 'trim' );
//			
//	    add_action('save_post','shfs_post_meta_save');
//	}
//
//    }
//    
//    
//}

    add_action( 'admin_menu', 'ascript_menu');
    add_action( 'wp_head', 'wp_heade' );

    function ascript_menu () {
	register_activation_hook(__FILE__, 'alo_install');
//	add_options_page('Alo Settings', 'Alo Settings', 'manage_options', __FILE__, 'settings_key');	
	add_menu_page('AloNgay Settings', 'AloNgay Settings', 'manage_options', __FILE__ , 'settings_key', 'dashicons-phone');
    }
    
    function settings_key(){
	if(!empty($_POST['save'])){
	    $alo_options['alo-key'] = $_POST['alo-key'];
	    update_option('alo_options', $alo_options);
	    echo '<div id="message" class="updated fade"><p>Lưu thành công!</p></div>';
	}
	auto_script();
	$alo_options = get_option('alo_options');

		// echo "Var_dump key: " ;
		// echo "<pre>";
		// var_dump($alo_options);
		// echo "</pre>";

?>
		<br>
	<div style="text-align: center; margin: 50px auto">
		<div for="alo-key"> Nhập key cung cấp bới <i><a href="https://www.thuengay.vn" target="_blank" style="font-size: 20px; color: #e8627a; text-decoration: none;">thuengay.vn</h3></a> ở đây </div> 
		<br>
		

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		    <input type="text" name="alo-key" value="<?php echo $alo_options['alo-key']?>" style="min-height: 70px; width: 420px; border-radius: 50px;">
		    <input type="submit" value="LƯU" name="save" style="border: 1px #a1a1a1 solid; border-radius: 10px; width:70px ;background-color: #dddddd;" onmouseenter="this.style.boxShadow='0px 0px 50px 5px pink'    "; onmouseleave=" this.style.border='1px #a1a1a1 solid'; this.style.boderRadius='10px'; this.style.width ='70px'; this.style.backgroundColor='#dddddd' ; this.style.boxShadow='0px 0px 0px 0px'  ">
		</form>
	</div>
<?php
	
    }

    
    function auto_script() {
	$alo_options = get_option('alo_options');
	$async = 'async';
	$data_site_id = $alo_options['alo-key'];
	$src = 'https://www.thuengay.vn/alongay/alongay.min.js';
	$alo_script['alo-script'] = 	'<script type="text/javascript" '
		. 'src="'.$src
		.'" data-site-id="'.$data_site_id
		.'" async="'.$async.'"></script>';
	// $alo_script['alo-script'] = '<script type="text/javascript" src="'.$src.'" ></script>';
	update_option('alo_script', $alo_script);
//	$alo_script = get_option('alo_script');
//	var_dump($alo_script);
?>
<!--	<script type="text/javascript">
	    var script = document.createElement("script");
	    script.setAttribute('data-site-id', <?php echo json_encode($alo_options['alo-key']);?>);
	    script.type = "text/javascript";
	    script.setAttribute('alo-cerfi','buiviethoan');
	    script.async = true;
//	    script.src = "";
	    var textnode = document.createTextNode("alert("+<?php echo json_encode($alo_options['alo-key']);?>+");");
	    script.appendChild(textnode);
	    document.getElementsByTagName('head')[0].append(script);
	</script>
	-->
<?php
    }


    function alo_install() {
	global $alo_options,$alo_script;
	if(!get_option('alo_options')){
	    add_option('alo_options', array(
		'alo-key' => ''
	    ));
	}
	if(!get_option('alo_script')){
	    add_option('alo_script', array(
		'alo-script' => ''
	    ));
	}
	$alo_options = get_option('alo_options');
	$alo_script = get_option('alo_script');
    }
    
    function wp_heade() {
	$meta = get_option('alo_script');
				if ( $meta != '' ) {
					echo $meta['alo-script'], "\n";
				}
    }
    
    global $alo_options;
    global $alo_script;
    
	
