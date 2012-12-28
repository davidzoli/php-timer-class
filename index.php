<?php
  include 'debug.php';
	$chrono = new timer;
	$chrono->set_output(1); //Ctrl+U in browser! (html comment output)

	$chrono->add_timer('timer1'); //start a new timer name timer1
	sleep(1);
	$chrono->add_cp('cp1_1','timer1'); //create cp for timer1
	
	$chrono->add_timer('for_loop'); //create a timer for the measuring time in loop
	for($i=0;$i<5;$i++){
		if($i==3) sleep(1); //some extra time
		sleep(1);
		$chrono->add_cp('in_the_loop_'.$i,'for_loop'); //create cp for loop
	}
	$chrono->add_cp('end'); //tricky cp. This on belons to global started in line 3

	$chrono->showme(); // show all the timers
	$chrono->showme('for_loop'); //show only the loop timer's cps
