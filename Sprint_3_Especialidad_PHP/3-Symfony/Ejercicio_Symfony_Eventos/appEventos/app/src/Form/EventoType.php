<?php
namespace App\Form;

use App\Entity\Evento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'required' => true,
                'label' => 'Nombre del Evento'
            ])
            ->add('fecha', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'label' => 'Fecha del Evento',
                
            ])
            ->add('hora', TimeType::class, [
                'widget' => 'single_text',
                'required' => true,
                'label' => 'Hora del Evento',
                'attr' => [
                    'min' => 0,
                    'max' => 23,
                    'class' => 'form-control',
                ],
                'attr' => [
                    'min' => 0,
                    'max' => 59,
                    'class' => 'form-control',
                ],
            ])            
            ->add('ubicacion', TextType::class, [
                'required' => true,
                'label' => 'Ubicación'
            ])
            ->add('detalles', TextareaType::class, [
                'required' => true,
                'label' => 'Detalles'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}

?>