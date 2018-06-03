<?php
namespace RandomBundle\Event;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\Event;

class UserEntitySubscriber implements EventSubscriberInterface
{
    public function __construct()
    {

    }

    public function prePersist(LifecycleEventArgs $args)
    {
        dump('prePersist');
        dump($args);
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        dump("PostLoad");
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        dump('PreUpdate from the UserSubscriber');
        dump($args);
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::postLoad,
            Events::preUpdate,
            Events::prePersist
        ];
    }
}