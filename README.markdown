#TeaPot for Steam

Show all your nerd friends your nerd skills with TF2 Items.

##Quick Example

	<?php
	include 'teapot.php';
	
	$teapot = new TeaPot('envex');

	$items = $teapot->get_player_items();

	foreach($items->items as $item):

	 	$single = $teapot->get_single_item($item); ?>
	
		<p><?php echo $single->name; ?></p>
	
		<img src="<?php echo $single->image_url; ?>" />
	
	<?php
	endforeach; ?>