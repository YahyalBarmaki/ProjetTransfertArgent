<?php

namespace App\Form;

use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montantTr')
            ->add('nomEx')
            ->add('telEx')
            ->add('cniEx')
            ->add('typeDePieceEx')
            ->add('adresseEx')
            ->add('nomB')
            ->add('adrB')
            ->add('cniB')
            ->add('telB')
            ->add('typeDePieceB')
            ->add('user')
            ->add('compte')
            ->add('fraits')
            ->add('code')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
