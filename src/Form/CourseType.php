<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Форма для создания и редактирования "Курса".
 */
class CourseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('active', CheckboxType::class, [
                'required' => false,
                'label' => 'Активность',
            ])
            ->add('sort', NumberType::class, [
                'label' => 'Индекс сортировки',
            ])
            ->add('slug', TextType::class, [
                'label' => 'Символьный код',
            ])
            ->add('title', TextType::class, [
                'label' => 'Название курса',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Дата',
            ])
            ->add('author', TextType::class, [
                'label' => 'Автор',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
            ])
            ->add('type', TextType::class, [
                'label' => 'Тип курса',
            ])
            ->add('coverImageFile', VichImageType::class, [
                'label' => 'Обложка',
                'allow_delete' => true,
            ])
            //->add('breadcrumbImageName')
            ->add('breadcrumbsTitle')
            ->add('breadcrumbsStyles')
            ->add('realizeAllLessonsSection')
            ->add('agreePrivacyPolicy', CheckboxType::class, [
                'mapped' => false,
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Отправить',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
