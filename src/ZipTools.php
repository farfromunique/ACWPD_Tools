<?php

namespace ACWPD\Tools;

	
/* Provides parsing tools for ACWPD Projects
 * Feel free to use this in your projects! Just provide Attribution by keeping this block in place!
 * 
 * This is version 1.2
 * 
 * For the latest version, please visit: https://github.com/farfromunique/ACWPD_Tools
 * 
 * This code is copyright (C) 2018 Aaron Coquet / ACWPD
 */ 
class ZipTools {
	function zipWithPassword(string $ZipFilename = 'output.zip', string $password,string ...$files) {
	$zip = new ZipArchive;
	$zip->open($ZipFilename, ZipArchive::CREATE);
	$zip->setPassword($password);
	foreach ($files as $file) {
		$zip->addFile($file);
		$zip->setEncryptionName($file, ZipArchive::EM_AES_256);
	}
	$zip->close();

	///Then download the zipped file.
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$ZipFilename);
	header('Content-Length: ' . filesize($ZipFilename));
	readfile($ZipFilename);
}
}