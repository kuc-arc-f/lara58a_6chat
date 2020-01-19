<?php

function debug_dump($dat){
//	var_dump($dat);
	echo '<pre>' . var_export($dat, true) . '</pre>';
}