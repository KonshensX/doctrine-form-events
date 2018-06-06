<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'doctrine.orm.default_entity_manager' shared service.

$a = ${($_ = isset($this->services['annotation_reader']) ? $this->services['annotation_reader'] : $this->getAnnotationReaderService()) && false ?: '_'};

$b = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($a, array(0 => ($this->targetDirs[3].'/src/AppBundle/Entity'), 1 => ($this->targetDirs[3].'/src/RandomBundle/Entity')));

$c = new \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();
$c->addDriver($b, 'AppBundle\\Entity');
$c->addDriver($b, 'RandomBundle\\Entity');

$d = new \Doctrine\ORM\Configuration();
$d->setEntityNamespaces(array('AppBundle' => 'AppBundle\\Entity', 'RandomBundle' => 'RandomBundle\\Entity'));
$d->setMetadataCacheImpl(${($_ = isset($this->services['doctrine_cache.providers.doctrine.orm.default_metadata_cache']) ? $this->services['doctrine_cache.providers.doctrine.orm.default_metadata_cache'] : $this->load('getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService.php')) && false ?: '_'});
$d->setQueryCacheImpl(${($_ = isset($this->services['doctrine_cache.providers.doctrine.orm.default_query_cache']) ? $this->services['doctrine_cache.providers.doctrine.orm.default_query_cache'] : $this->load('getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService.php')) && false ?: '_'});
$d->setResultCacheImpl(${($_ = isset($this->services['doctrine_cache.providers.doctrine.orm.default_result_cache']) ? $this->services['doctrine_cache.providers.doctrine.orm.default_result_cache'] : $this->load('getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService.php')) && false ?: '_'});
$d->setMetadataDriverImpl($c);
$d->setProxyDir(($this->targetDirs[0].'/doctrine/orm/Proxies'));
$d->setProxyNamespace('Proxies');
$d->setAutoGenerateProxyClasses(true);
$d->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
$d->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
$d->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());
$d->setQuoteStrategy(new \Doctrine\ORM\Mapping\DefaultQuoteStrategy());
$d->setEntityListenerResolver(${($_ = isset($this->services['doctrine.orm.default_entity_listener_resolver']) ? $this->services['doctrine.orm.default_entity_listener_resolver'] : $this->services['doctrine.orm.default_entity_listener_resolver'] = new \Doctrine\Bundle\DoctrineBundle\Mapping\ContainerAwareEntityListenerResolver($this)) && false ?: '_'});
$d->setRepositoryFactory(new \Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory(new \Symfony\Component\DependencyInjection\ServiceLocator(array())));

$this->services['doctrine.orm.default_entity_manager'] = $instance = \Doctrine\ORM\EntityManager::create(${($_ = isset($this->services['doctrine.dbal.default_connection']) ? $this->services['doctrine.dbal.default_connection'] : $this->load('getDoctrine_Dbal_DefaultConnectionService.php')) && false ?: '_'}, $d);

${($_ = isset($this->services['doctrine.orm.default_manager_configurator']) ? $this->services['doctrine.orm.default_manager_configurator'] : $this->services['doctrine.orm.default_manager_configurator'] = new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator(array(), array())) && false ?: '_'}->configure($instance);

return $instance;
