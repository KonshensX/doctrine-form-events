<?php
namespace AppBundle\Event;

use AppBundle\Entity\Profile;
use AppBundle\Managers\FileManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Intl\Exception\NotImplementedException;

class ProfileEntitySubscriber implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface $_container
     */
    private $_container;

    /**
     * @var FileManager $_fileManager
     */
    private $_fileManager;

    /**
     * ProfileEntitySubscriber constructor.
     * @param ContainerInterface $container
     * @param FileManager $fileManager
     */
    public function __construct(ContainerInterface $container, FileManager $fileManager)
    {
        $this->_container = $container;
        $this->_fileManager = $fileManager;
    }


    public static function getSubscribedEvents()
    {
        return [
            'postLoad',
            'preUpdate',
            'prePersist'
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        // XXX: this needs to transfered to the FormEvent section
//        if ($args->getEntity() instanceof Profile)
//        {
//            /**
//             * @var Profile $entity
//             */
//            $entity = $args->getEntity();
//            if (!is_null($entity->getProfilePicture())) {
//                $entity->setProfilePicture(
//                    new File(
//                        $this->_fileManager->getUploadsDirectory() . '/' . $entity->getProfilePicture()
//                    )
//                );
//            }
//        }
    }

    /**
     *
     * @todo
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        throw new NotImplementedException();
    }
}