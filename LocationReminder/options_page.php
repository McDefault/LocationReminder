<h1>Location Reminder</h1>
<?php
    //de database prefix wordt hier opgehaald
    global $wpdb;
    //de naam van de tabellen worden hier  gemaakt
    $table_name = $wpdb->prefix . "maxminded_locationreminder";
    $selection = $wpdb->get_var("SELECT optie from $table_name");
    $position = $wpdb->get_var( "SELECT position from $table_name");
    $color = $wpdb->get_var( "SELECT color from $table_name");
    $opacity = $wpdb->get_var( "SELECT opacity from $table_name");
    $_POST['opacity'] = $_POST['opacity'];
    if(isset($_POST['submit'])){
        $selection = $_POST['optie'];
        $table_optie ="UPDATE $table_name SET optie='".$selection."'WHERE id=1";
         $wpdb->query($table_optie);
         echo 'Success, now displaying: '.$selection;
         if ($position != $_POST['position']){
             $position = $_POST['position'];
             $table_position ="UPDATE $table_name SET position='".$position."'WHERE id=1";
             $wpdb->query($table_position);
         }
         if ($color != $_POST['color']){
             $color = $_POST['color'];
             $table_color ="UPDATE $table_name SET color='".$color."'WHERE id=1";
             $wpdb->query($table_color);
         }
         if ($opacity != $_POST['opacity']){
             $opacity = $_POST['opacity'];
             $table_opacity ="UPDATE $table_name SET opacity='".$opacity."'WHERE id=1";
             $wpdb->query($table_opacity);
         }   
    }
?>
<h2>Select your location:</h2>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<form method="POST" action="">
    <select name='optie'>
        <option <?php if($selection=='Staging'){echo 'selected';}?> value="Staging">Staging</option>
        <option <?php if($selection=='Localhost'){echo 'selected';}?> value="Localhost">Localhost</option>
        <option <?php if($selection=='Live'){echo 'selected';}?> value="Live">Live</option>
    </select>
    <h1>Design Options:</h1>
    <h2>Position:</h2>
    <select id="position" name='position'>
        <option <?php if($position=="top: 20px; left: 20px;"){echo 'selected';}?> value="top: 20px; left: 20px;">top-left</option>
        <option <?php if($position=="top: 20px; right: 20px;"){echo 'selected';}?> value="top: 20px; right: 20px;">top-right</option>
        <option <?php if($position=="bottom: 20px; left: 20px;"){echo 'selected';}?> value="bottom: 20px; left: 20px;">bottom-left</option>
        <option <?php if($position=="bottom: 20px; right: 20px;"){echo 'selected';}?> value="bottom: 20px; right: 20px;">bottom-right</option>
    </select>
    <h2>Color:</h2>
    <input type="color" id="colorpicker" name="color" value="<?php echo $color ?>">
    <h2>Opacity:</h2>
    <input id="contrast" name="opacity" type="range" value="<?php echo $opacity;?>" max="1" min="0" step="0.01"/>
    <br><br><input class="button button-primary button-large" id="publish" type="submit" name="submit" value="Save"/>
</form>
<script>
   $( document ).ready(function() {
       //realtime update for opacity
        $('#contrast').on('input', function() {
            $('.alerter').css('opacity', $(this).val());
        });
        //realtime update for color
        $('#colorpicker').on('input', function() {
            $('.alerter').css('background', $(this).val());
        });
    });  
</script>
<?php
//    $wpdb->show_errors();
//    $wpdb->print_error();
?>