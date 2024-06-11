<?php

namespace Drupal\ef5_geocoding\Controller;

use Drupal\Core\Controller\ControllerBase;

class GeocodingErrorController extends ControllerBase {
  
  public function showError() {
    return [
      '#markup' => "Erro ao carregar seu endereço...<br><br>Tente novamente!",
    ];
  }
}