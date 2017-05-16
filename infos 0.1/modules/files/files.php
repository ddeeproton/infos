<?php

class files {


// -----------------------------------------------------------------------------
//  Fonction: Retourne dans un tableau la liste de fichiers contenus dans un dossier
//    @parametres:
//      $dir : Chemin du dossier
//      $type : onlyfile | onlydir | all
//      $type :
//			GLOB_MARK : Ajoute un slash final à chaque dossier retourné
//			GLOB_NOSORT : Retourne les fichiers dans l'ordre d'apparence (pas de tri)
//			GLOB_NOCHECK : Retourne le masque de recherche si aucun fichier n'a été trouvé
//			GLOB_NOESCAPE : Ne protège aucun métacaractère d'un antislash
//			GLOB_BRACE : Remplace {a,b,c} par 'a', 'b' ou 'c'
//			GLOB_ONLYDIR : Ne retourne que les dossiers qui vérifient le masque
//			GLOB_ERR : Stop lors d'une erreur (comme des dossiers non lisibles), par défaut, les erreurs sont ignorées.

//    @retourne:  tableau de fichiers
//------------------------------------------------------------------------------
 	public static function listFilesInDir($dir, $type = GLOB_NOSORT){
		if(is_dir($dir)) $dir .='/*';
		$array = glob($dir, $type);
		$array = is_array($array) ? $array : array();

		// TRI sur $array
		for ($i = 0; $i < sizeof($array); $array[$i] = strtolower($array[$i]).$array[$i], $i++);
		sort($array);
		for ($i = 0; $i < sizeof($array); $i++) {
			$tab = $array[$i];
			$array[$i] = substr($tab, (strlen($tab)/2), strlen($tab));
		}
		
		return $array;
	}
	//use
	//files::listFilesInDir('/images/');
	//files::listFilesInDir('/images/*.[jJpP][pPnN][gG]');

// -----------------------------------------------------------------------------
//  Fonction: Retourne l'extention d'un fichier
//    @parametres:
//      $dir : Nom du fichier
//    @retourne:  l'extention sans le point "."
//------------------------------------------------------------------------------
 	public static function getFileExtention($file){
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
//    @parametres:
//      $dir : Nom du fichier
//    @retourne:  l'extention sans le point "."
//------------------------------------------------------------------------------
 	public static function filename($file){
		$t = array();
		$t = explode("/", $file);
		if(count($t)>0) {
			return $t[count($t)-1];
		}else{
			return "";
		}
	}

	public static function getParentPath($dir) {
		$dirname = files::filename($dir);
		return substr($dir,0,strlen($dir)-strlen($dirname));
	}

	public static function getDirname($dir) {
		$dir = explode("/", $dir);
		return $dir[count($dir)-1];
	}
// -----------------------------------------------------------------------------
//  Fonction: Créer un dossier avec les permissions d'écriture
//    @parametres:
//      $dir : Chemin du dossier
//    @retourne:  rien
//------------------------------------------------------------------------------
 	public static function createDir($dir){
		if(is_dir($dir)) return;
		$oldumask = umask(0000);
		mkdir($dir);
		umask($oldumask);
	}

	function copyDir($source, $dest){
		global $lasterror;
		if (is_file($source)) {
			return copy($source, $dest);
		}
		if (!is_dir($dest)) {
			mkdir($dest);
		}
		$success = true;
		$lasterror = "";
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			if($success) {
				$success = files::copyDir("$source/$entry", "$dest/$entry");
				if(!$success) $lasterror .= "Error on copy file:\n\t$source/$entry\n\t=> $dest/$entry";
			}else{
				files::copyDir("$source/$entry", "$dest/$entry");
			}
		}
		$dir->close();
		return $success;
	}

// -----------------------------------------------------------------------------
//  Fonction: Lit le contenu d'un fichier
//    @parametres:
//      $file : Chemin du fichier
//    @retourne:  Le contenu du fichier
//------------------------------------------------------------------------------
 	public static function read($file){
		//return is_file($file) ? file_get_contents($file) : '';
		
		if(is_file($file) && filesize($file) > 0) {
			$fp = fopen($file, "rb");
			$txt = fread($fp, filesize($file));
			fclose($fp);
			return $txt;
		}
		
	}


// -----------------------------------------------------------------------------
//  Fonction: Ecrire dans un fichier
//    @parametres:
//      $file : Chemin du fichier
//		$txt : Contenu du fichier
//    @retourne:  rien
//------------------------------------------------------------------------------

	public static function write($file, $txt){
	    $fp = fopen($file,"w+");
	    fputs($fp, $txt);
	    fclose($fp);
		chmod($file, 0666);
	}



 	public static function readFast($file){
		readfile($file);
	}
 	public static function readFastToString($file){
		return is_file($file) ? file_get_contents($file) : '';
	}
 	public static function writeFast($file, $txt){
		file_put_contents($file, $txt);
		chmod($file, 0666);
	}
	
		
	public static function copyr($source, $dest){
		global $lasterror;
		if (is_file($source)) {
			return copy($source, $dest);
		}
		if (!is_dir($dest)) {
			mkdir($dest);
		}
		$success = true;
		$lasterror = "";
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			if($success) {
				$success = copyr("$source/$entry", "$dest/$entry");
				if(!$success) $lasterror .= "Error on copy file:\n\t$source/$entry\n\t=> $dest/$entry";
			}else{
				copyr("$source/$entry", "$dest/$entry");
			}
		}
		$dir->close();
		return $success;
	}

	
	public static function unlinkr($dir, $noerror = true) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") {
						unlinkr($dir."/".$object, $noerror);
					}else{
						unlink($dir."/".$object);
						if(is_file($dir."/".$object)) {
							$noerror = false;
						}
					}
				}
			}
			reset($objects);
			rmdir($dir);
		}
		return $noerror;
	 }
}

?>