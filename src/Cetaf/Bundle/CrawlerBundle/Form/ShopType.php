<?php

namespace Cetaf\Bundle\CrawlerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ShopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shopName')
            ->add('shopAdress')
            ->add('shopPhoneNumber')
            ->add('updatedAt')
            ->add('createdAt')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cetaf\Bundle\CrawlerBundle\Entity\Shop'
        ));
    }

    public function getName()
    {
        return 'cetaf_bundle_crawlerbundle_shoptype';
    }
}
