<?php
function trouveNomUnique($dirPath) {
    do {
        $uniqueval=rand(1, 99999).".mp3";
        $path = $dirPath . $uniqueval;
    }
    while (is_file($path));

    return $uniqueval;
}

$repsrc= "C:\\Users\\noodle\\Desktop\\music\\";
$repdst= "C:\\Users\\noodle\\Desktop\\music\\randomized\\";

$tabfile=glob($repsrc."*.mp3");
shuffle($tabfile);

foreach ($tabfile as $filename) {

    $randfile=trouveNomUnique($repdst);
    

    $f=fopen($filename,'rb');
    if ($f) {
          $data=fread($f,filesize($filename));
      fclose($f);
  
     $f = fopen($repdst.$randfile, "wb");
      fwrite($f,$data,strlen($data));
      fclose($f);  
      }
    echo "$filename (".$randfile.") occupe " . filesize($filename) . "<br/>\n";
}
?>
