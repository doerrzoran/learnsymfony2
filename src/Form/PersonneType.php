<?php

namespace App\Form;

use App\Entity\Hobbie;
use App\Entity\Personne;
use App\Entity\Profile;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('name')
            ->add('age')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('profile', EntityType::class, [
                'expanded' => true,
                'class' => Profile::class,
                'multiple' => false
            ])
            ->add('hobbies', EntityType::class, [
                'expanded' => false,
                'class' => Hobbie::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('h')->orderBy('h.designation', 'ASC');
                },
                'choice_label' => 'designation',
            ])
            ->add('job')
            ->add('photo', FileType::class, [
                'label' => 'Votre photo de profile (Des documents image uniquement)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image document',
                    ])
                ]
            ])
            ->add('edited', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
