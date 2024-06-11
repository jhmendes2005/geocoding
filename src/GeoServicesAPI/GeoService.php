<?php

namespace Drupal\ef5_geocoding\GeoServicesAPI;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Http\ClientFactory;
use GuzzleHttp\Exception\RequestException;

class GeoService {

  protected $configFactory;

  public function __construct($config_factory) {
    $this->configFactory = $config_factory;
  }

  public function obterLatLngEndereco($endereco) {
    $client = \Drupal::service('http_client');
    $config = $this->configFactory->get('ef5_geocoding.settings');
    $apiKey = $config->get('api_key');
    $url = 'https://geocode.search.hereapi.com/v1/geocode?q=' . urlencode($endereco) . '&apiKey=' . urlencode($apiKey);

    try {
      $response = $client->get($url);
      if ($response->getStatusCode() === 200) {
        $data = json_decode($response->getBody(), TRUE);

        if (isset($data['items'][0]['position']['lat']) && isset($data['items'][0]['position']['lng'])) {
          $lat = $data['items'][0]['position']['lat'];
          $lng = $data['items'][0]['position']['lng'];
          return ['lat' => $lat, 'lng' => $lng];
        } else {
          \Drupal::logger('ef5_geocoding')->error('Não foi possível encontrar a latitude e longitude para o endereço fornecido.');
          return FALSE;
        }
      } else {
        \Drupal::logger('ef5_geocoding')->error('Erro na requisição HTTP: Código de status @status', ['@status' => $response->getStatusCode()]);
        return FALSE;
      }
    } catch (RequestException $e) {
      \Drupal::logger('ef5_geocoding')->error('Erro na requisição HTTP: Código de status @status', ['@status' => $response->getStatusCode()]);
      return FALSE;
    } catch (\Exception $e) {
      watchdog_exception('ef5_geocoding', $e, 'Ocorreu um erro inesperado: @message', ['@message' => $e->getMessage()]);
      return FALSE;
    }
  }
}
