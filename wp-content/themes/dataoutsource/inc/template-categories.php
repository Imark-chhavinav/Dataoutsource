<?php

 echo $path1 = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'); 
$files = glob($path1.'/theme/js/*'); // get all file names
foreach($files as $file){ // iterate files
if(is_file($file))
  echo $file;
echo "<br>";
  //unlink($file); // delete file
}


$files1 = glob($path1.'/theme/css/*'); // get all file names
foreach($files1 as $file){ // iterate files
if(is_file($file))
  echo $file;
echo "<br>";
 //unlink($file); // delete file
}

$files2 = glob($path1.'/page-templates/*'); // get all file names
foreach($files2 as $file){ // iterate files
if(is_file($file))
  echo $file;
echo "<br>";
//unlink($file); // delete file
}
