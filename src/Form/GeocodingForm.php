<?php

namespace Drupal\ef5_geocoding\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\ef5_geocoding\GeoServicesAPI;

class GeocodingForm extends FormBase
{

  public function getFormId()
  {
    return 'geocoding_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['#attached']['library'][] = 'ef5_geocoding/custom-styles';
    $form['#attributes']['class'][] = 'custom-form';

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Endereço'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Enviar'),
      '#button_type' => 'primary',
    ];

    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $endereco = $form_state->getValue('address');

    if (strlen($endereco) < 3) {
      $formState->setErrorByName('address', $this->t('Endereço inválido!'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $geocoding = \Drupal::service('ef5_geocoding.geoservicesapi');
    $endereco = $form_state->getValue('address');
    $result = $geocoding->obterLatLngEndereco($endereco);

    if ($result !== FALSE) {
      $form_state->setRedirect('ef5_geocoding.results', ['lat' => $result['lat'], 'lng' => $result['lng']]);
    } else {
      \Drupal::logger('ef5_geocoding')->error('Não foi possível obter a latitude e longitude para o endereço: @address', ['@address' => $endereco]);
      $form_state->setRedirect('ef5_geocoding.error');
    }
  }
}
