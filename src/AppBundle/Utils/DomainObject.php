<?php
namespace AppBundle\Utils;

use Doctrine\Common\NotifyPropertyChanged;
use Doctrine\Common\PropertyChangedListener;

class DomainObject implements NotifyPropertyChanged
{
    private $_listeners = [];

    public function addPropertyChangedListener(PropertyChangedListener $listener)
    {
        $this->_listeners[] = $listener;
    }

    protected function onPropertyChanged($prop, $oldValue, $newValue)
    {
        if ($this->_listeners)
        {
            /**
             * @var PropertyChangedListener $listener
             */
            foreach ($this->_listeners as $listener)
            {
                $listener->propertyChanged($this, $prop, $oldValue, $newValue);
            }
        }
    }
}