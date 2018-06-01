<?php
namespace AppBundle\Managers;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    /**
     * @var ContainerInterface $_container
     */
    private $_container;

    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
    }

    public function uploadFile(UploadedFile $uploadedFile)
    {
        if ($uploadedFile instanceof UploadedFile) {
            $filename = $this->generateUniqueFilename() . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move(
                $this->getUploadsDirectory(),
                $filename
            );
            return $filename;
        }
        return null;
    }

    private function generateUniqueFilename()
    {
        return md5(uniqid());
    }

    public function getUploadsDirectory()
    {
        return $this->_container->getParameter('uploads');
    }

}