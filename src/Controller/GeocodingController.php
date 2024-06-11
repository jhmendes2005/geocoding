<?php

namespace Drupal\ef5_geocoding\Controller;

use Drupal\Core\Controller\ControllerBase;

class GeocodingController extends ControllerBase {
  public function showResults($lat, $lng) {
    return [
      '#theme' => 'ef5_geocoding_results',
      '#lat' => $lat,
      '#lng' => $lng
    ];
  }
}