<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\ByteString;

class FileService
{
	private $fileName;

	public function upload(UploadedFile $file, string $directory):void
	{
		// création d'un nom aléatoire de fichier
		$this->fileName = ByteString::fromRandom(32) . '.' . $file->guessClientExtension();

		// transfert du fichier
		$file->move($directory, $this->fileName);
	}

	public function getFileName():string
	{
		return $this->fileName;
	}

	public function delete(string $fileName, string $directory):void
	{
		unlink("$directory/$fileName");
	}
}