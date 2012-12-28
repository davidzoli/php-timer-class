Easy to use timing info machine for your application.

1. Include it at the beginning of your app.
--

```php
include 'debug.php';
$chrono = new timer;
```

2. Start different timers
--

```php
$chrono->add_timer('timer1');
...
$chrono->add_timer('timer2');
```

3. Place checkpoints
--
You can add them to the global timer, or a predefined timer. To add checkpoint to the global, just leave the second parameter.
Global timer started when the $chrono object was created.

```php
$chrono->add_cp('cp_1');
...
$chrono->add_cp('cp_2','timer1');
```


4. Get the informations
--
To get timing infos about a defined timer call showme() with the timer's name. 

```php
$chrono->showme();
$chrono->showme('timer1');
```


5. Timing informations
--

```
Format: [cp_name] - [elapsed] - [duration] - [place]
[cp_name]  - The name of the checkpoint.
[elapsed]  - Elpsed time till previous checkpoint or the timer creation if it's the first checkpoint.
[duration] - Elapsed till the timer creation.
[place]    - The place of the calling add_cp() function. If you forget where to find the checkpoint.
```

6. Information display
--
There are three different displaying method.

```
0 - No output. So you can turn off the timing info table. You don't need to delete timer class function calls.
1 - Output to source. Informations show up in HTML comment. Useful if you use method 0, but you have to get 
    infos without disturbing site viewers. Use $chrono->set_output(1) with some secret $_REQUEST parameter or else...
2 - Development mode. Infos displayed in plain text.
```

7. Example
--

Example code to understand using.

```php
<?php
  include 'debug.php';
	$chrono = new timer;
	$chrono->set_output(2);

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
```

And the output:

```
<!--
PHP timer class output

Checkpoint infos for timer: global
end - 6.999846 - 6.999846 - var/www/timer/index.php:16

Checkpoint infos for timer: timer1
cp1_1 - 0.99962 - 0.99962 - var/www/timer/index.php:8

Checkpoint infos for timer: for_loop
in_the_loop_0 - 0.999971 - 0.999971 - var/www/timer/index.php:14
in_the_loop_1 - 1.000035 - 2.000006 - var/www/timer/index.php:14
in_the_loop_2 - 1.00001 - 3.000016 - var/www/timer/index.php:14
in_the_loop_3 - 2.000047 - 5.000063 - var/www/timer/index.php:14
in_the_loop_4 - 1.000021 - 6.000084 - var/www/timer/index.php:14

-->

<!--
PHP timer class output

Checkpoint infos for timer: for_loop
in_the_loop_0 - 0.999971 - 0.999971 - var/www/timer/index.php:14
in_the_loop_1 - 1.000035 - 2.000006 - var/www/timer/index.php:14
in_the_loop_2 - 1.00001 - 3.000016 - var/www/timer/index.php:14
in_the_loop_3 - 2.000047 - 5.000063 - var/www/timer/index.php:14
in_the_loop_4 - 1.000021 - 6.000084 - var/www/timer/index.php:14

-->
```
