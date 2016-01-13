<?php
//checkt of je admin bent
if(current_user_can( 'activate_plugins' ) ){
    global $wpdb;
    //de naam van de tabellen worden hier  gemaakt
    $table_name = $wpdb->prefix . "maxminded_locationreminder";
    $get_selection = $wpdb->get_var( "SELECT optie from $table_name");
    $get_position = $wpdb->get_var( "SELECT position from $table_name");
    $get_color = $wpdb->get_var( "SELECT color from $table_name");
    $opacity = $wpdb->get_var( "SELECT opacity from $table_name");
    $ip = $_SERVER['SERVER_ADDR'];
    if($ip == '::1')
    {
        $ip = '127.0.0.1';
    }
    ?>
    <link rel="stylesheet" type="text/css" href="wp-content/plugins/LocationReminder/css/wp-admin.css">
    <div style="<?php echo $get_position;?>" class="knop" >
        <button class="alerter" style='opacity: <?php echo $opacity."; background:".$get_color.";'>". $get_selection.": ".$ip;?></button>       
    </div>
    <?php
}