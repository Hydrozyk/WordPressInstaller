<?php
/*Function to check for directory */
function is_dir_empty( $dir ){
  if (!is_readable($dir)) return NULL;
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}

//Sanitizing user input
function sanitUserInput($add){
	$add = trim($add);
	$add = strtolower($add);
  $add = htmlspecialchars($add);
	$add = filter_var($add, FILTER_SANITIZE_STRING, FILTER_VALIDATE_EMAIL);
	$add = stripslashes($add);
	$add = preg_replace('/[^A-Za-z0-9\-_]/', '', $add);

	return $add;

}
//Finding files in WP dir
function find_all_files($dir) {
  $root = scandir($dir);
  foreach($root as $value) {
      if($value === '.' || $value === '..') {continue;}
      $result[]="$dir/$value";
      if(is_file("$dir/$value")) {continue;}
      foreach(find_all_files("$dir/$value") as $value)
      {
          $result[]=$value;
      }
  }
  return $result;
}
//Getting server name
function srv_name(){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
      $link = "https";
    }else{
      $link = "http";
    }
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'] . '/';

    return $link;
  }
 ?>
