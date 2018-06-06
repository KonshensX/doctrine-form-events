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

    /**
     *
     * @todo
     * 
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        // throw new NotImplementedException("This function is not impelemented yet");
    }

    /**
     * This bitch ass event is never triggered and i don't know why
     * even tho i keep changing the value but nothing is happening
     * So this event is trigerred but somehow i don't even see the dump, using the die to end the script does trick for now
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        // getting the entity and checking if the file was changed??
        // but the file value is always changed 
        // actually not, after the file is hydrated we will always have a File instance 
        // what 
        $args->getEntity();
        dump($args);
        if ($args->hasChangedField('profilePicture')) {
            // not really sure if doctrine is checking this field too or just the db fields ???
            // don't need to check if the file instanceof UploadedFile already done in the _fileManager
            // uploading the new file
            $oldfilename = $args->getOldValue('profilePicture'); // this is always null??
            dump($oldfilename);

            $newfilename = $this->_fileManager->uploadFile($args->getNewValue('profilePicture'));
            dump($newfilename);
            // settin' the new filename
            // this, instead of getting the entity and callin the setProfilePicture
            $args->setNewValue('profilePicture', $newfilename);
            //i need to remove the old file
            // only remove the old file if !== null, null means there's nothing to remove
            if (!is_null($oldfilename)) {
                $this->_fileManager->removeFile($oldfilename);
            }
        }
    }
}