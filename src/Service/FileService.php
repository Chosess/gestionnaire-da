<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FileService
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(UploadedFile $file, ?string $folder = '')
    {
        $fichier = md5(uniqid(rand(), true)) . '---' . $file->getClientOriginalName();

        $file_infos = filetype($file);

        if($file_infos === false){
            throw new Exception('Format de fichier incorrect');
        }

        $path = $this->params->get('images_directory') . $folder;
        
        if(!file_exists($path)){
            mkdir($path, 0755, true);
        }

        $file->move($path . '/', $fichier);

        return $fichier;
    }

    public function delete(string $fichier, ?string $folder = '')
    {
        if($fichier !== 'default.webp'){
            $success = false;
            $path = $this->params->get('images_directory') . $folder;

            $original = $path . '/' . $fichier;

            if(file_exists($original)){
                unlink($original);
                $success = true;
            }

            return $success;
        }
        return false;
    }
}