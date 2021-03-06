<?php

namespace App\Form;

use App\Entity\ProgramStep;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProgramStepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('urlVideo')
            ->add('fileExplainFile', VichFileType::class, [
                'label' => 'Fichier à télécharger',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ])
            ->add('begin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProgramStep::class,
        ]);
    }
}
