
<?php
/**
 * Plugin Name: Carousel ESGI
 * Description: Mon premier plugin
 * Author: ESGI
 * Version: 0.1
 */


add_action('init', 'monslider_init');
add_action('admin_menu', 'parameters_submenu');
add_action('add_meta_boxes', 'monslider_metaboxes');
add_action('save_post', 'monslider_savepost', 10, 2);
add_action('manage_edit-slide_columns', 'monslider_columnfilter');
add_action('manage_posts_custom_column', 'monslider_column');
add_shortcode( 'slider-esgi', 'monslider_show' );


function parameters_submenu()
{
	add_submenu_page( 'edit.php?post_type=slide', 'Paramétrage Slider', 'Paramétrage Slider', 'manage_options', 'slider-parameters', 'parameters_page');
}

function parameters_page()
{
	$post = get_post(array('name' => 'slide'));
  ?>
  <div class="wrap">
    <h2><?php echo $GLOBALS['title'] ?></h2>
  </div>
  <?php
	add_theme_support( 'post-formats' );
  add_meta_box('monslider_2', 'Parametrage du Slider', 'monslider_metaboxe_slider_config', 'slider-parameters', 'normal', 'high');
  do_meta_boxes( 'slider-parameters', 'normal', $post);
}


/*
* Permet d'initialiser les fonctionalités liées au carrousel
*/
function monslider_init()
{
  $labels = array(
    'name' => 'Slide',
    'singular_name' => 'Slide',
    'add_new' => 'Ajouter un Slide',
    'add_new_item' => 'Ajouter un nouveau Slide',
    'edit_item' => 'Editer un Slide',
    'new_item' => 'Nouvelle Slide',
    'view_item' => 'Voir Slide',
    'search_item' => 'Rechercher un Slide',
    'not_found' => 'Aucun Slide',
    'not_found_in_trash' => 'Aucun Slide dans la corbeille',
    'parent_item_colon' => '',
    'menu_name' => 'Slides'
  );

  register_post_type('slide', array(
    'public' => true,
    'labels' => $labels,
    'publicly_queryable' => false,
    'menu_position' => 9,
    'capability_type' => 'post',
    'supports' => array('title', 'thumbnail')
  ));

  add_image_size('slider', 1000, 300, true);
}

/*
* Permet de gérer les metabox Slide
*/
function monslider_metaboxes()
{
  add_meta_box('monslider', 'Lien', 'monslider_metaboxe', 'slide', 'normal', 'high');
}


/*
* Metabox pour gérer le lien
*/
function monslider_metaboxe($object) {
  // Genere token
  wp_nonce_field('monslider', 'monslider_nonce');
  ?>
    <div class="meta-box-item-title">
        <h4>Lien de ce slide</h4>
    </div>
    <div class="meta-box-item-content">
        <input type="text" name="monslider_link" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_link', true));?>">
    </div>
  <?php
}

/*
* Metabox pour paramétrer le slider
*/
function monslider_metaboxe_slider_config($object) {
  // Genere token
  wp_nonce_field('monslider_2', 'monslider_nonce_2');
  ?>
    <div class="meta-box-item-title">
        <h4>Paramères du Slider</h4>
    </div>
    <div class="meta-box-item-content">
			<form class="" action="" method="post">
        <label for="duration">Duration</label>
        <input id="duration" type="text" name="monslider_slider_duration" value="<?= esc_attr(get_post_meta($object->ID, '_parameter-duration', true));?>" placeholder="In milisecond ( ex : 1000 )">
        <br><br>
        <label for="direction">Direction</label>
        <?php $config_direction = esc_attr(get_post_meta($object->ID, '_parameter-direction', true)); ?>
        <select id="direction" name="monslider_slider_direction" value="<?= esc_attr(get_post_meta($object->ID, '_parameter-direction', true));?>">
           <option value="up" <?php if ($config_direction == 'up') { echo "selected"; } ?>>up</option>
           <option value="down" <?php if ($config_direction == 'down') { echo "selected"; } ?>>down</option>
           <option value="left" <?php if ($config_direction == 'left') { echo "selected"; } ?>>left</option>
           <option value="right" <?php if ($config_direction == 'right') { echo "selected"; } ?>>right</option>
        </select>
        <br><br>
        <label for="limit">Limite de Slides</label>
        <input id="limit" type="text" name="monslider_slider_limit" value="<?= esc_attr(get_post_meta($object->ID, '_parameter-limit', true));?>" placeholder="1, 2, 3, 10 ...">
				<br><br>
				<label>Shortcode : </label> [slider-esgi]
				<br><br>
				<div id="publishing-action">
						<input name="original_publish" type="hidden" id="original_publish" value="Update" />
						<input name="save" type="submit" class="button button-primary button-large" id="publish" value="Update" />
				</div>
				<div class="clear"></div>
			</form>
  <?php

	if(isset($_POST['save'])) {
			monslider_savepost_param($object->ID);
	}
}

/*
* Ajout d'une colonne Image dans le tableau des slides
*/
function monslider_columnfilter($columns) {
  $thumb = array('thumbnail' => 'Image');
  $columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns, 1, null);
  return $columns;
}

function monslider_column($column) {
  global $post;
  if($column == 'thumbnail') {
    echo edit_post_link(get_the_post_thumbnail($post->ID, array(300, 200)), null, null, $post->ID);
  }
}

function monslider_savepost_param($post_id) {
	if(isset($_POST['monslider_slider_duration']) && isset($_POST['monslider_slider_direction']) && isset($_POST['monslider_slider_limit']) )
	{
		update_post_meta($post_id, '_parameter-duration', $_POST['monslider_slider_duration']);
		update_post_meta($post_id, '_parameter-direction', $_POST['monslider_slider_direction']);
		update_post_meta($post_id, '_parameter-limit', $_POST['monslider_slider_limit']);
	}
}

/*
* Permet de gérer la sauvegarde de la metabox
*/
function monslider_savepost($post_id, $post) {
	if( ! isset($_POST['monslider_link']) || !wp_verify_nonce($_POST['monslider_nonce'], 'monslider') ) {
    return $post_id;
  }

  // Verifier les permissions
  $type = get_post_type_object($post->post_type);
  if(!current_user_can($type->cap->edit_post)) {
    return $post_id;
  }

	if(isset($_POST['monslider_link'])) {
		  update_post_meta($post_id, '_link', $_POST['monslider_link']);
	}
}


/*
* Permet d'afficher mon carousel
*/
function monslider_show($limit = 10)
{
  // On importe le JavaScript
  wp_enqueue_script('caroufredsel', plugins_url() . '/mon-slider/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), '6.2.1', true);
  add_action('wp_footer', 'monslider_script', 30);

  // On écrit le HTML
  $slides = new WP_query("post_type=slide&post_per_page=$limit");
  echo '<div id="monslider">';
  while($slides->have_posts()) {
    $slides->the_post();
    global $post;
    echo '<a style="display:block; height:300px!important; width=1000px!important;" href="' . esc_attr(get_post_meta($post->ID, '_link', true)) . '">';
    the_post_thumbnail('slider', array('style' => 'width:1000px!important;'));
    echo '</a>';
  }
  echo '</div>';
}

function monslider_script()
{
	$post = get_post(array('name' => 'slide'));
	$duration = esc_attr(get_post_meta($post->ID, '_parameter-duration', true));
	$direction = esc_attr(get_post_meta($post->ID, '_parameter-direction', true));
	?>
  <script>
    (function($) {
      $('#monslider').carouFredSel({
				direction: <?php echo "'".$direction."'"; ?>,
				scroll: {
					duration: <?php echo $duration; ?>,
				}
			});
    })(jQuery);
  </script><?php
}
