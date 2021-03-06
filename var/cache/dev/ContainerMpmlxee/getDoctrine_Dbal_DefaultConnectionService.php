<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'doctrine.dbal.default_connection' shared service.

$a = ${($_ = isset($this->services['AppBundle\Managers\FileManager']) ? $this->services['AppBundle\Managers\FileManager'] : $this->services['AppBundle\Managers\FileManager'] = new \AppBundle\Managers\FileManager($this)) && false ?: '_'};
$b = ${($_ = isset($this->services['RandomBundle\Event\UserEntitySubscriber']) ? $this->services['RandomBundle\Event\UserEntitySubscriber'] : $this->services['RandomBundle\Event\UserEntitySubscriber'] = new \RandomBundle\Event\UserEntitySubscriber()) && false ?: '_'};

$c = new \Doctrine\DBAL\Logging\LoggerChain();
$c->addLogger(new \Symfony\Bridge\Doctrine\Logger\DbalLogger(${($_ = isset($this->services['monolog.logger.doctrine']) ? $this->services['monolog.logger.doctrine'] : $this->load('getMonolog_Logger_DoctrineService.php')) && false ?: '_'}, ${($_ = isset($this->services['debug.stopwatch']) ? $this->services['debug.stopwatch'] : $this->services['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch(true)) && false ?: '_'}));
$c->addLogger(${($_ = isset($this->services['doctrine.dbal.logger.profiling.default']) ? $this->services['doctrine.dbal.logger.profiling.default'] : $this->services['doctrine.dbal.logger.profiling.default'] = new \Doctrine\DBAL\Logging\DebugStack()) && false ?: '_'});

$d = new \Doctrine\DBAL\Configuration();
$d->setSQLLogger($c);

$e = new \AppBundle\Event\ProfileEventListener($a);

$f = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);
$f->addEventListener(array(0 => 'preUpdate'), $e);
$f->addEventListener(array(0 => 'prePersist'), $e);
$f->addEventListener(array(0 => 'postLoad'), $e);
$f->addEventListener(array(0 => 'preUpdate'), $b);
$f->addEventListener(array(0 => 'postLoad'), $b);
$f->addEventListener(array(0 => 'prePersist'), $b);
$f->addEventListener(array(0 => 'loadClassMetadata'), ${($_ = isset($this->services['doctrine.orm.default_listeners.attach_entity_listeners']) ? $this->services['doctrine.orm.default_listeners.attach_entity_listeners'] : $this->services['doctrine.orm.default_listeners.attach_entity_listeners'] = new \Doctrine\ORM\Tools\AttachEntityListenersListener()) && false ?: '_'});

return $this->services['doctrine.dbal.default_connection'] = ${($_ = isset($this->services['doctrine.dbal.connection_factory']) ? $this->services['doctrine.dbal.connection_factory'] : $this->services['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array())) && false ?: '_'}->createConnection(array('driver' => 'pdo_sqlite', 'host' => '127.0.0.1', 'port' => NULL, 'dbname' => 'symfony', 'user' => 'root', 'password' => NULL, 'charset' => 'UTF8', 'path' => ($this->targetDirs[2].'/data/data.sqlite'), 'driverOptions' => array(), 'defaultTableOptions' => array()), $d, $f, array());
