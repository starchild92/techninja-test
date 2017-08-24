<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BankType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
        ->add('code')
        ->add('address')
        // ->add('debitcards',
        //             CollectionType::class, array(
        //                 'required' => false,
        //                 'entry_type' => 'AppBundle\Form\DebitCardType',
        //                 'cascade_validation' => true,
        //                 'attr' => array('class' => 'debitcards'),
        //                 'allow_add'=>'true',
        //                 'by_reference'=>'false',
        //                 'allow_delete' =>'true',
        //                 'data_class' => null,
        //                 'label' => 'Debit Card(s)',
        //                 ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Bank'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_bank';
    }


}
