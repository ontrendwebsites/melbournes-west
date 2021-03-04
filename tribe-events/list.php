<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

do_action( 'tribe_events_before_template' );
?>
	<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>
	<!-- Main Events Content -->

	<div class="event-images-container">

		<?php
		$attachment_id_left = get_field('left_image', 'option');
		$attachment_id_right = get_field('right_image', 'option');
		$size = "whatson-header"; // (thumbnail, medium, large, full or custom size)
		$image_left = wp_get_attachment_image_src( $attachment_id_left, $size );
		$image_right = wp_get_attachment_image_src( $attachment_id_right, $size );
		?>
		<img src="<?php echo $image_left[0]; ?>" />
		<img src="<?php echo $image_right[0]; ?>" />

	</div>
	<?php tribe_get_template_part( 'list/content' ); ?>
	<div class="tribe-clear"></div>

<?php
do_action( 'tribe_events_after_template' );