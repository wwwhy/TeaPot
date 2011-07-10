#TeaPot for Steam

Show all your nerd friends your nerd skills with TF2 Items.

	                        ,;!!!-
	                        !!!'' z_?b
	                       `'_"b,`"  .,;;;<<!!! ,==-,_   d
	                        `? `,;<'``_`'<!!!!! l -   `+,F       ,nmnmnmnmn.
	                        ,;!!!! /"`_""=,`'',/'dMMMn  "     ,MMMMMMMMMMMMP
	                      ;!!!!!!'<  '_,,u,`"" ,dMM".,,       MMMMMMMMMMMM"
	                     `__`''!! < :MMMMMMMMMMMMMM 4$$$,"ec  MMMMMMMMMMM"
	                   ,/' .`"=,_,) n("?".,.""TMMMMb    "r3" ,MMMMMMMMMMM
	                  (  ;'`,nc,,,,    .d$$$$$."MMMF-    P' ,MMMMMMMMMMMM ,
	   ,c$$$$$c,.   =.`\z  MMMMMMb,,,. '   `?$$c "x="    .xdMMMMMMMMMMMM> Mb,
	 ,$$$$$$$$$$$bc    ".uMMMMMMMMMMMMh      $$$ h,xMMMMMMMMMMMMMMMMMMMM> MMM,
	,$$$"     `"?$$b.  ,MMMMMMMMMMMMMMMP  ..,,,,,CMMMMMMMMMMMMMMMMMMMMMM  MMMM
	$$$F         `?$" ,MMMMMMMMMMMMMMP'nMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM' ,MMMM
	$$$L            ,dMMMMMMMMMMMMMMMMMMMMMMMMMMMMM'MMMMMMMMMMMMMMMMMM'  MMMMM
	`$$$           nMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMP MMMMMMMMMMMMMMMMP' ,dMMMMM
	 `?$b.       uMMMMMMMMMMMMMMMMMMMMMMMMMMMMMPP" `TMMMMMMMMMMMMP"  ,dMMMMMM>
	   "?$b,.  ,MMMMMMMMMMMMMMMMMMMMMMMMMMMMMP .nMMx   .""""""" . ;nMMMMMMMMP
	      "?P ,MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMbuMMMMMMx .`'<<;,`!'  M(?MMMMMM
	          MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMn."-    - ,dM  MMMMM
	          MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMPPP"" .x`MMP
	       ,c TMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM 4"
	       `?b MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMP
	            TMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM"?????""
	             `TMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMmnmnmd
	                "TMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMP"
	                   "TMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMP"
	                       ""TTMMMMMMMMMMMMMMMMMMMMMMMMP"" ,/
	                             ."""""TTTTTTTTT"""".,,cdP"
	                              `"?????????????"""".  c,?$;
	                              $? d"$$ $$$ ?L $% ?$L `?$$% !- zdr
	                       ",_`4h,,; ?P"  $P":`$$P : " <!:  ',zcP""
	                          "-=,,,_ ~~~~:<!!h:--~~```.,ceF"""
	                                 """""======~""""""

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