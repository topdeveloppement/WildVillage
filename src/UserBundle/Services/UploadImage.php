<?php

namespace UserBundle\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class UploadImage
{
    private $targetDir;
    private $tokenStorage;
    private $user;
    private $fileName;
    private $fileDefault;

    public function __construct($targetDir, TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        $this->user = $this->tokenStorage->getToken()->getUser();
        $this->targetDir = $targetDir;
    }

    // Fonction qui retourne le chemin absolue pour une image par default.
    public function getFileDefault()
    {
        $this->fileDefault = 'default/defaultwildvillage.jpeg';
        return $this->fileDefault;
    }

    // Fonction qui retourne le chemin absolue.
    public function getAbsolutePath($fileName)
    {
        $this->fileName = $fileName;

        if(file_exists($this->targetDir.$this->user->getUsername().'_'.$this->user->getId().'/'.$this->fileName)){

        return $this->targetDir.$this->user->getUsername().'_'.$this->user->getId().'/'.$this->fileName;

        }else{

            return $this->targetDir.'default/defaultwildvillage.jpeg';
        }
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir.$this->user->getUsername().'_'.$this->user->getId(), $fileName);

        return $fileName;
    }

    public function update($file)
    {
        if ($file instanceof UploadedFile) {

        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        if($fileName != $this->fileName){

            unlink($this->getAbsolutePath($this->fileName));
        }

        $file->move($this->targetDir.$this->user->getUsername().'_'.$this->user->getId(), $fileName);

        return $fileName;

        }

        return $this->fileName;   
    }
}