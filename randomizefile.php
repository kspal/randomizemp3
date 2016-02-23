<?php
function trouveNomUnique($dirPath) {
    do {
        $uniqueval=rand(1, 99999).".mp3";
        $path = $dirPath . $uniqueval;
    }
    while (is_file($path));

    return $uniqueval;
}



if (!array_key_exists(1, $argv)) {
  echo "usage : randomizefile.php repertoire";
  exit();
}

$repsrc= $argv[1];


if (!is_dir($repsrc)) {
  echo "Le répertoire ".$repsrc." n'existe pas.";
  exit();
}




if (substr($repsrc, -1)!=DIRECTORY_SEPARATOR) {
  $repsrc=$repsrc.DIRECTORY_SEPARATOR;
}
$repsrc=str_replace("\\", "\\\\", $repsrc);


//"C:\\Users\\noodle\\Desktop\\music\\";
$repdst= $repsrc.'randomized'.DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
//$repdst=str_replace("\\", "/", $repdst);
if (!is_dir($repdst)) {
  mkdir($repdst);
}

array_map('unlink', glob($repdst.'*'));

$tabfile=glob($repsrc."*.mp3");
shuffle($tabfile);

foreach ($tabfile as $filename) {    

    $f=fopen($filename,'rb');
    if ($f) {
      $data=fread($f,filesize($filename));
      fclose($f);

      $randfile=trouveNomUnique($repdst);

      $fd = fopen($repdst.$randfile, "wb");
      fwrite($fd,$data,strlen($data));
      fclose($fd);  
      echo $filename,'-->',$randfile, "\n";
      }   
    
}
?>
