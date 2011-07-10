<?php

/*

TeaPot Class for accessing the Steam Web API
http://steamcommunity.com/dev

Matt Vickers
http://envexlabs.com | http://heyitsv2.com


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


*/

class TeaPot{

	/*


		                  888                      
		                  888                      
		                  888                      
		.d8888b   .d88b.  888888 888  888 88888b.  
		88K      d8P  Y8b 888    888  888 888 "88b 
		"Y8888b. 88888888 888    888  888 888  888 
		     X88 Y8b.     Y88b.  Y88b 888 888 d88P 
		 88888P'  "Y8888   "Y888  "Y88888 88888P"  
		                                  888      
		                                  888      
		                                  888
	
	*/
	
	//Change this to your API key
	var $api_key = 'C3DE5AEB41DF8BD7410CAB0F0C746BD7';
	
	var $format = 'json';
	var $version = 'v0002';

	var $username;
	var $steam_id;
	
	var $items_schema;

	var $game_codes = array(
		'TF2' => 440,
		'TF2-Beta' => 520,
		'Portal2' => 620
	);

	function __construct($username){
		
		$this->username = $username;
		
		$this->get_steam_id_from_username();
		
		//try and simplify this
		$this->items_schema = $this->get_schema();
		$this->items_schema = $this->sort_items();
						
	}
	
	/*
	
		         888                                             
		         888                                             
		         888                                             
		88888b.  888  8888b.  888  888  .d88b.  888d888 .d8888b  
		888 "88b 888     "88b 888  888 d8P  Y8b 888P"   88K      
		888  888 888 .d888888 888  888 88888888 888     "Y8888b. 
		888 d88P 888 888  888 Y88b 888 Y8b.     888          X88 
		88888P"  888 "Y888888  "Y88888  "Y8888  888      88888P' 
		888                        888                           
		888                   Y8b d88P                           
		888                    "Y88P"                            

	
	*/
	
	/**
	 * Get the info for the current user
	 *
	 * @return object
	 * @author Matt Vickers
	 */
	
	function get_player(){
						
		$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/$this->version/?key=$this->api_key&steamids=$this->steam_id&format=$this->format";
						
		$response = json_decode($this->make_request($url));
		
		return $response->response->players[0];
				
	}

	/*

		d8b 888                                   
		Y8P 888                                   
		    888                                   
		888 888888 .d88b.  88888b.d88b.  .d8888b  
		888 888   d8P  Y8b 888 "888 "88b 88K      
		888 888   88888888 888  888  888 "Y8888b. 
		888 Y88b. Y8b.     888  888  888      X88 
		888  "Y888 "Y8888  888  888  888  88888P'
	
	*/
		
	/**
	 * Get the entire list of all available items and their info
	 *
	 * @param string $game_code 
	 * @return object
	 * @author Matt Vickers
	 */
	
		
	function get_schema($game_code = 'TF2'){

		$game = $this->game_codes[$game_code];
		
		$url = "http://api.steampowered.com/IEconItems_$game/GetSchema/v0001/?key=$this->api_key";

		$response = json_decode($this->make_request($url));
		
		return $response->result;
								
	}
	
	/**
	 * Returns a re-sorted array of the items
	 * 
	 * The defindex doesn't match the array key when the original
	 * schema is returned. This fixes that
	 *
	 * @return array
	 * @author Matt Vickers
	 */
	
	
	function sort_items(){
		
		$new_items_sort = array();
		
		foreach($this->items_schema->items as $item){
			
			$new_items_sort[$item->defindex] = $item;
			
		}
		
		return $new_items_sort;
		
	}
		
	/**
	 * Returns an object will all the items for the current player
	 *
	 * @param string $game_code 
	 * @return object
	 * @author Matt Vickers
	 */
	
	function get_player_items($game_code = 'TF2'){

		$status_codes = array(
			'1' => 'OK. Data returned as specified below.',
			'8' => '("SteamID parameter was missing"): The "steamID" parameter of the URL was not included, or if present was not a valid SteamID64 value.',
			'15' => '("Permission denied"): The player\'s profile is set to Private.',
			'18' => '("Unknown account"): The "steamID" parameter was not registered to an account.'		
		);

		$game = $this->game_codes[$game_code];
		
		$url = "http://api.steampowered.com/IEconItems_$game/GetPlayerItems/v0001/?key=$this->api_key&steamid=$this->steam_id";
					
		$response = json_decode($this->make_request($url));
		
		if($response->result->status != 1){
			
			echo $status_codes[$response->result->status];
			return;
			
		}else{
			
			return $response->result;
			
		}
						
	}
	
	/**
	 * Get all the attributes for a single item
	 *
	 * @param object $item 
	 * @return object
	 * @author Matt Vickers
	 */
	
	function get_single_item($item){
		
		return $this->items_schema[$item->defindex];
		
	}

	/*

		888                     888 888                        
		888                     888 888                        
		888                     888 888                        
		888888 .d88b.   .d88b.  888 88888b.   .d88b.  888  888 
		888   d88""88b d88""88b 888 888 "88b d88""88b `Y8bd8P' 
		888   888  888 888  888 888 888  888 888  888   X88K   
		Y88b. Y88..88P Y88..88P 888 888 d88P Y88..88P .d8""8b. 
		 "Y888 "Y88P"   "Y88P"  888 88888P"   "Y88P"  888  888                                                 
	
	*/
	
	/**
	 * Get the proper steamID from a username
	 *
	 * @return string
	 * @author Matt Vickers
	 */
	
	function get_steam_id_from_username(){
												
		$url = "http://steamcommunity.com/id/" . $this->username . "?xml=1";
		
		$request = $this->make_request($url);
		
		preg_match("/<steamID64[^>]*>(.*)<\/steamID64>/i", $request, $matches);
				
		if(is_array($matches)){
		
			$this->steam_id = $matches[1];	
			
		}
				
	}

	/**
	 * Make the CURL request
	 * (Probably going to be used by every function)
	 *
	 * @param string $url 
	 * @return string
	 * @author Matt Vickers
	 */
	
	private function make_request($url){

		/*
		
			CURL wasn't working on local host
			file_get_contents may not work on some servers,
			change this back when testing on live server
		
		*/
		
		return file_get_contents($url);
		
		// $ch = curl_init($url);
		// curl_setopt($ch, CURLOPT_HEADER, 0);
		// curl_setopt($ch, CURLOPT_POST, 1);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// output = curl_exec($ch);       
		// curl_close($ch);
		// return $output;
		
	}

}