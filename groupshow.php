<?php
/*
  Plugin Name: Group Show
  Plugin URI: http://www.evoxyz.com
  Description: short code user for all group show and related members [group_show],date 15-7-2016
  Version: 1.0
  Author: Raman Kant Kamboj
  Author URI: http://google.co.in
 */
ob_start();
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// allbus show form
function group_form() {
	

?>

 <link rel="stylesheet" href="<?php echo WP_PLUGIN_URL; ?>/group-show/css/jquery-ui.css">
  
  <script src="<?php echo WP_PLUGIN_URL; ?>/group-show/js/jquery-1.12.4.js"></script>
  <script src="<?php echo WP_PLUGIN_URL; ?>/group-show/js/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
  <div id="accordion">
  <?php 
		  
		  $userid = get_current_user_id();
		  $args = array(
     'per_page' => 5,
     'page' => 1,
	 'type' => 'active',
	 'max' => false,
	 'user_id' => $userid,
	 'slug' => false,
	 'search_terms' => false,
	
    
); ?>
		  
		  <?php
		  if ( bp_has_groups($args) ) : ?>
		 <?php while ( bp_groups() ) : bp_the_group(); ?>  
  
  <h3><?php bp_group_name() ?></h3>
  <?php $group_id = bp_get_group_id();
$args = array( 
    'group_id' => $group_id, 
    'page' => 1, 
    'per_page' => 5, 
    'max' => 0, 
    'exclude' => null, 
    'exclude_admin_mods' => 0, 
    'exclude_banned' => 0, 
    'group_role' => null 
); 

  ?>
  <div>
  <center><h2>All Member Details</h2></center>
        <table id="tableData" class="table table-bordered table-striped">
          <thead>
    <tr>
             
              <th>Mamber Name</th>
			  <th>Action</th>
              
            </tr>
  </thead>
          <tbody>
		  
<?php 

  



		if ( bp_group_has_members($args) ) : ?>
		 <?php while ( bp_group_members() ) : bp_group_the_member(); ?>  
		 <tr>
    <td>
    <?php bp_group_member_name() ?> </td>
	<td><a style="color: #21759b;" href="?memberid=<?php bp_group_member_id() ?>"><img src="<?php echo WP_PLUGIN_URL; ?>/group-show/image/edit-icon.png" alt="edit" height="26" width="26"></a>
	</td>
	</tr>
	<?php endwhile; ?>
			<?php else: ?>
  
  
  
<?php endif;?>
  </tbody>
  </table>
	<div id="member-count" class="pag-count" style="float:left;">
    <?php bp_group_member_pagination_count() ?>
  </div>
  
  <div id="member-pagination" class="pagination-links" style="margin-left:400px;">
    <?php bp_group_member_pagination() ?>
	

  </div>
  
  </div>
  <?php endwhile; ?>
  
    
   <?php do_action( 'bp_after_groups_loop' ) ?>
   <?php else: ?>
 
    
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    
 
<?php endif; ?>

  
  
 
</div>

<div class="pagination">
 
        <div class="pag-count" id="group-dir-count" style="float:left;">
            <?php bp_groups_pagination_count() ?>
        </div>
 
        <div class="pagination-links" id="group-dir-pag" style="margin-left:400px;">
            <?php bp_groups_pagination_links() ?>
        </div>
		
 
    </div>

       
	
<?php 


}
// group_show a new shortcode: [group_show]
add_shortcode('group_show', 'group_form');

?>