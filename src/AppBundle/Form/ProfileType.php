<?php

namespace AppBundle\Form;

use AppBundle\Event\GenerateFileSubscriber;
use AppBundle\Managers\FileManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProfileType extends AbstractType
{
    /**
     * @var FileManager $_fileManager
     */
    private $_fileManager;

    /**
     * @var ContainerInterface $_container
     */
    private $_container;

    public function __construct(ContainerInterface $container, FileManager $fileManager)
    {
        $this->_container = $container;
        $this->_fileManager = $fileManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('fullname')
            ->add('profilePicture', FileType::class, [
                'required' => false
            ])
            ->addEventSubscriber(new GenerateFileSubscriber($this->_container, $this->_fileManager))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Profile'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_profile';
    }


}
