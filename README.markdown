#TeaPot for Steam

##Quick Example

	<?php
	$teapot = new TeaPot('envex');

	$items = $teapot->get_player_items();

	foreach($items->items as $item):

	 	$single = $teapot->get_single_item($item); ?>
	
		<p><?php echo $single->name; ?></p>
	
		<img src="<?php echo $single->image_url; ?>" />
	
	<?php
	endforeach; ?>