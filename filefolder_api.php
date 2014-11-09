<?php
//../../pages/centers/franchisee
///franchisee.php

    $shared = 'Main Dir';
    $folder = $_POST['folder'];
	$info = pathinfo($folder);
	
	if(array_key_exists('extension', $info)){
		$folder = $info['dirname'];
	    ListIn($folder);
	}else{
		$folder = $_POST['folder'];
		ListIn($folder);
	}

 
  
  function ListIn($dir, $prefix = '') {
  $dir = rtrim($dir, '\\/');
  $result = array();
 
    foreach (scandir($dir) as $f) {
      if ($f !== '.' and $f !== '..') {
        if (is_dir("$dir/$f")) {
          //$result = array_merge($result, ListIn("$dir/$f", "$prefix$f/"));
		  echo '<option value="'.$dir.'/'.$f.'">'.$f.'</option>';
        } else {
          //$result[] = $prefix.$f;
		  echo '<option value="'.$prefix.'/'.$f.'">'.$prefix.'/'.$f.'</option>';
        }
      }
    }

  return $result;
}
?>