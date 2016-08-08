<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sexe', ChoiceType::class, array('choices'=> array('homme'=> 'homme','femme'=>'femme'), 'required' => false,'label' => 'Sexe'))
            ->add('telephone', NumberType::class, array('required' => false, 'label' => 'Téléphone'))
            ->add('voie', ChoiceType::class, array('required' => false,'label' => 'Voie'))
            ->add('rue', TextType::class, array('required' => false,'label' => 'Rue'))
            ->add('codepostal', NumberType::class, array('required' => false,'label' => 'Code Postal'))
            ->add('ville', TextType::class, array('required' => false,'label' => 'Ville'))
            ->add('path', FileType::class, array('required' => false,'label' => 'Photo'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\ProfileUser'
        ));
    }
}
