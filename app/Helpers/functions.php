<?php

function rms($data){
  return str_replace(' ', '', $data);
}
function get_id(){
  return time().mt_rand(0,10);
}
function isJson($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}

?>
