<?php
namespace AppBundle\Event;

use AppBundle\Entity\Profile;
use AppBundle\Managers\FileManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

class ProfileEventListener
{
    /**
     * @var FileManager $_fileManager
     */
    private $_fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->_fileManager = $fileManager;
    }

//    public function getSubscribedEvents()
//    {
//        return [
//            Events::preUpdate,
//            Events::prePersist,
//            Events::postLoad
//        ];
//    }

    /**
     *
     * @todo
     * @param LifecycleEventArgs $args
     * @return bool
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        if(!$args->getEntity() instanceof Profile)
        {
            return false;
        }
        /// XXX; this is where we are going tu upload the file
        /// In this case we don't need to delete any old files because this is
        /// a new persistence and there no old files
        /// but the preUpdate should handle this
        $file = $args->getEntity()->getProfilePicture();
        $filename = $this->_fileManager->uploadFile($file);
        $args->getEntity()->setProfilePicture($filename);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        dump("PostLoad");
        dump($args);
    }

    /**
     * This bitch ass event is never triggered and i don't know why
     * even tho i keep changing the value but nothing is happening
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        dump("PreUpdate");
        dump($args->getEntityChangeSet());
        /// XXX: remove the old file if there's any
        /// SO in the preUpdate i only want to update the file if a file was uploaded
        /// if it's null don't update the database with null value
        /// Upload the new file after the removal of the old file
        dump($args);
    }
}