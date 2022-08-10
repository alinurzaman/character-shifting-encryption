<?php
function encode($N,$alphabet,$msg){

  // Initialization

  $M = count($alphabet);
  $encrypt = array();
  $encode = array();
  $plain = preg_split("//",$msg, -1, PREG_SPLIT_NO_EMPTY);
  
  $encode[' '] = ' ';
  foreach ($alphabet as $n=>$v){
    $encode[$v] =  $alphabet[($n+$N) % $M];		// Compute the encoding map for $v
  }

  foreach ($plain as $v){
    $encrypt[] = $encode[$v];
  }

  return join('',$encrypt);
}

function decode($N,$alphabet,$msg){

  // Initialization

  $M = count($alphabet);
  $decrypt = array();
  $decode = array();

  $encrypted = preg_split("//",$msg, -1, PREG_SPLIT_NO_EMPTY);

  // Compute the decoding map
  $decode[' '] = ' ';
  foreach ($alphabet as $n=>$v){
    $decode[$v] = $alphabet[($M+($n-$N)) % $M];	  	// Compute the decoding map for $v
  }

  foreach ($encrypted as $v){
    $decrypt[] = $decode[$v];
  }

  return join('',$decrypt);
}
?>