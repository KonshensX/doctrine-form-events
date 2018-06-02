<?php
namespace AppBundle\Event;

use AppBundle\Entity\Profile;
use AppBundle\Managers\FileManager;
use Doctrine\Common\EventSubscriber;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;

class GenerateFileSubscriber implements EventSubscriber
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

    public function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            'preUpdate',
            'prePersist'
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
        if (is_null($filename))
        {
            return false;
        }
        $file = new File(
            $this->_fileManager->getUploadsDirectory() . '/' . $filename
        );

        $newData = $data->setProfilePicture($file);
        $event->setData($newData);
    }

    /**
     *
     * @todo
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        /// XXX; this is where we are going tu upload the file
        /// In this case we don't need to delete any old files because this is
        /// a new persistence and there no old files
        /// but the preUpdate should handle this
        $file = $args->getEntity()->getProfilePicture();
        $this->_fileManager->uploadFile($file);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        dump($args->getEntityChangeSet());
        /// XXX: remove the old file if there's any
        /// SO in the preUpdate i only want to update the file if a file was uploaded
        /// if it's null don't update the database with null value
        /// Upload the new file after the removal of the old file
        dump($args);
    }
}