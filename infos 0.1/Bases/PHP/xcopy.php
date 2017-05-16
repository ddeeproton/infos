<?php
# ===================================================================================================== #
# Description: Ce script copie le contenu d\'un repertoire dans un autre. 
#              Si le fichier existe déjà dans le repertoire de destination celui-ci ne sera pas écrasé.
# ===================================================================================================== #

set_time_limit(0);

$dirOrigine = "C:\\!NEW";
$dirDestination = "D:\\!Share";
   
$fp = fopen("logs.txt","w+");                 
        

$dir = array();
$dir[] = $dirOrigine;


for($i=0;$i<count($dir);$i++)
{
  Affiche("Dossier: ".$dir[$i]."\n");
  if ($handle = opendir($dir[$i])) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != "..") {
        if(is_dir($dir[$i]."\\".$file)){
          Affiche("Dossier: ".$dir[$i]."\\".$file."\n");
          $dir[] = $dir[$i]."\\".$file;
          if(!is_dir(str_replace($dirOrigine,$dirDestination, $dir[$i]."\\".$file))) {
            mkdir(str_replace($dirOrigine,$dirDestination, $dir[$i]."\\".$file),0777);
          }
        }
        if(is_file($dir[$i]."\\".$file)){
          if(!is_file(str_replace($dirOrigine,$dirDestination, $dir[$i]."\\".$file))) {
            Affiche("copy: ".$dir[$i]."\\".$file); 
            if(copy($dir[$i]."\\".$file, str_replace($dirOrigine,$dirDestination, $dir[$i]."\\".$file)))
              Affiche(" [OK]"); 
            else
              Affiche(" [Failed]!!!!! ");
            Affiche("\n");
          }
          else
            Affiche("Skip ".$dir[$i]."\\".$file."\n"); 
        }
      }
    }
    closedir($handle);
  }
}
   
fclose($fp);

function Affiche($txt) {
  global $fp;
  print $txt;
  ob_flush();
  fwrite($fp, $txt);     

}
?>
