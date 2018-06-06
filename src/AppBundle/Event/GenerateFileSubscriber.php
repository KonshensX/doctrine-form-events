<?php
namespace AppBundle\Event;

use AppBundle\Entity\Profile;
use AppBundle\Managers\FileManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

class GenerateFileSubscriber implements EventSubscriberInterface
{

    /**
     * @var ContainerInterface $_container
     */
    private $_container;

    /**
     * @var FileManager $_fileManager
     */
    private $_fileManager;

    public function __construct(ContainerInterface $container, FileManager $fileManager)
    {
        $this->_container = $container;
        $this->_fileManager = $fileManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
        ];
    }

    public function onPreSetData(FormEvent $event)
    {
        /// This doesn't handle the case where the value is not and there's
        /// no filename in the database
        /// XXX: generate the file from the filename
        /**
         * @var Profile $data
         */
        $data = $event->getData();
        $filename = $data->getProfilePicture();
        if (is_null($filename) || $filename === "")
        {
            return false;
        }
        $path = $this->_fileManager->getUploadsDirectory() . '/' . $filename;
//        $filesystem = new Filesystem();
        $file = new File($path);

        $newData = $data->setProfilePicture($file);
        $event->setData($newData);
    }


}