<?php

namespace App\Form;

use App\Entity\Prediction;
use App\Service\ApiClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PredictionType extends AbstractType
{
    private $apiClient;
    private $drivers;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        $this->drivers = $this->apiClient->getDrivers();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pole', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('bestLap', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('first', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('second', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('third', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('fourth', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('fifth', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('sixth', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('seventh', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('eighth', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('ninth', ChoiceType::class, [
                'choices' => [$this->drivers]
            ])
            ->add('tenth', ChoiceType::class, [
                'choices' => [$this->drivers]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prediction::class,
        ]);
    }
}
