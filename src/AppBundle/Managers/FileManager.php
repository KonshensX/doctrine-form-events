<?php
namespace AppBundle\Managers;

use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
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

    /**
     * Uploads the file to the system and returns unique filename
     * @param UploadedFile $uploadedFile
     * @return null|string
     */
    public function uploadFile(UploadedFile $uploadedFile): ?string
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

    /**
     * Removes a fiven file from the system
     * @param string $filename
     * @return bool
     */
    public function removeFile($filename)
    {
        // Filesystem is quite usefull when it comes to dealing with files
        $filesystem = new Filesystem();
        $filesystem->remove($this->getUploadsDirectory() . '/' . $filename);
        return true;
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