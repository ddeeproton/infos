<?php

class files {


// -----------------------------------------------------------------------------
//  Fonction: Retourne dans un tableau la liste de fichiers contenus dans un dossier 
//    @paramÃ¨tres:
//      $dir : Chemin du dossier
//      $type : onlyfile | onlydir | all
//      $type : 
/*
			GLOB_MARK : Ajoute un slash final à chaque dossier retourné
			GLOB_NOSORT : Retourne les fichiers dans l'ordre d'apparence (pas de tri)
			GLOB_NOCHECK : Retourne le masque de recherche si aucun fichier n'a été trouvé
			GLOB_NOESCAPE : Ne protège aucun métacaractère d'un antislash
			GLOB_BRACE : Remplace {a,b,c} par 'a', 'b' ou 'c'
			GLOB_ONLYDIR : Ne retourne que les dossiers qui vérifient le masque
			GLOB_ERR : Stop lors d'une erreur (comme des dossiers non lisibles), par défaut, les erreurs sont ignorées.
*/
//    @retourne:  tableau de fichiers
//------------------------------------------------------------------------------
 	public static function listFilesInDir($dir, $type = GLOB_NOSORT)
	{
		if(is_dir($dir)) $dir .='/*';
		$return = glob($dir, $type);
		return is_array($return) ? $return : array();
		/*
		$result = array();
		if(is_dir($dir)) {
			if ($handle = opendir($dir,$filter)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						switch($type) {
							case "onlyfile":
								if(is_file($dir."/".$file)) {
									$result[] = $fullpath ? $dir."/".$file : $file;
								}
								break;
							case "onlydir":
								if(is_dir($dir."/".$file)) {
									$result[] = $fullpath ? $dir."/".$file : $file;
								}
								break;
							case "all":
								$result[] = $fullpath ? $dir."/".$file : $file;
								break;
						}
						
					}
				}
				closedir($handle);
			}
		}
		return $result;*/
	}


// -----------------------------------------------------------------------------
//  Fonction: Retourne l'extention d'un fichier
//    @paramÃ¨tres:
//      $dir : Nom du fichier
//    @retourne:  l'extention sans le point "."
//------------------------------------------------------------------------------
 	public static function getFileExtention($file)
	{
		$t = array();
		$t = explode(".", $file);
		if(count($t)>0) {
			return $t[count($t)-1];
		}else{
			return "";
		}
	}
	
// -----------------------------------------------------------------------------
//  Fonction: Retourne le nom d'un fichier
//    @paramÃ¨tres:
//      $dir : Nom du fichier
//    @retourne:  l'extention sans le point "."
//------------------------------------------------------------------------------
	public static function filename($f) {
		$f = explode("/", $f);
		return $f[count($f)-1];
	}

public static function getParentPath($dir) {
	$dirname = files::filename($dir);
	return substr($dir,0,strlen($dir)-strlen($dirname));
}
// -----------------------------------------------------------------------------
//  Fonction: Créer un dossier avec les permissions d'écriture
//    @paramÃ¨tres:
//      $dir : Chemin du dossier
//    @retourne:  rien
//------------------------------------------------------------------------------
 	public static function createDir($dir)
	{
		$oldumask = umask(0000);
		mkdir($dir);
		umask($oldumask);
	}
	
// -----------------------------------------------------------------------------
//  Fonction: Lit le contenu d'un fichier
//    @paramÃ¨tres:
//      $file : Chemin du fichier 
//    @retourne:  Le contenu du fichier
//------------------------------------------------------------------------------
 	public static function read($file)
	{
		if(is_file($file) && filesize ($file) > 0) {
			$fp = fopen($file, "rb");
			$txt = fread($fp, filesize ($file));
			fclose($fp);
			return $txt;
		}
	}

 	public static function readFast($file){
		readfile($file);
	}	
 	public static function readFastToString($file){
		return is_file($file) ? file_get_contents($file) : '';
	}	
 	public static function writeFast($file, $txt){
		file_put_contents($file, $txt);
	}	
	
// -----------------------------------------------------------------------------
//  Fonction: Ecrire dans un fichier
//    @paramÃ¨tres:
//      $file : Chemin du fichier
//		$txt : Contenu du fichier 
//    @retourne:  rien
//------------------------------------------------------------------------------
 	
	public static function write($file, $txt)
	{
	    $fp = fopen($file,"w+");                 
	    fputs($fp, $txt);            
	    fclose($fp);
	}

	
}

?>