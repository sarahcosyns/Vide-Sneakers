<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AddArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false])
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'],
                'placeholder' => 'Choisissez le genre',
                'label' => false
            ])
            -> add('taille', ChoiceType::class, [
                'choices' => [
                    '35' => '35',
                    '36' => '36',
                    '37' => '37',
                    '38' => '38',
                    '39' => '39',
                    '40' => '40',
                    '41' => '41',
                    '42' => '42',
                    '43' => '43',
                    '44' => '44',
                    '45' => '45'],
                'placeholder' => 'Choisissez la taille',
                'label' => false
            ])
            -> add('couleur', ChoiceType::class, [
                'choices' => [
                    'Argent' => 'Argent',
                    'Beige' => 'Beige',
                    'Blanc' => 'Blanc',
                    'Bleu' => 'Bleu',
                    'Bordeaux' => 'Bordeaux',
                    'Gris' => 'Gris',
                    'Incolore' => 'Incolore',
                    'Jaune' => 'Jaune',
                    'Marron' => 'Marron',
                    'Multicolo' => 'Multicolo',
                    'Noir' => 'Noir',
                    'Orange' => 'Orange',
                    'Rose' => 'Rose',
                    'Rouge' => 'Rouge',
                    'Vert' => 'Vert',
                    'Violet' => 'Violet'],
                'placeholder' => 'Choisissez la couleur',
                'label' => false
            ])
            ->add('marque', TextType::class, [
                'label' => false])
            ->add('prix', NumberType::class, [
                'label' => false])
            ->add('etat', TextType::class, [
                'label' => false])
            ->add('description', TextType::class, [
                'label' => false])
            ->add('photo', FileType::class, [
                'mapped' => false,
                'multiple' => true,
                'label' => false,
                'required' => false])
            ;
        }
            

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
