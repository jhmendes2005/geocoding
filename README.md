# EF5 Geocoding

EF5 Geocoding é um módulo customizado para Drupal que permite a geocodificação de endereços usando a API HERE Geocoding. Este módulo inclui um formulário para entrada de endereços e uma página de configuração para armazenar a chave da API.

## Funcionalidades

- **Formulário de Geocodificação**: Permite que os usuários insiram um endereço e obtenham as coordenadas de latitude e longitude correspondentes.
- **Página de Configuração**: Permite que os administradores configurem a chave da API HERE diretamente do painel administrativo do Drupal.

## Requisitos

- Drupal 9.x ou superior
- Conta na API HERE para obter a chave de API

## Instalação

1. Clone o repositório na pasta `modules/custom` do seu projeto Drupal:
    ```sh
    git clone https://github.com/seuusuario/ef5_geocoding.git modules/custom/ef5_geocoding
    ```

2. Ative o módulo:
    ```sh
    drush en ef5_geocoding
    ```

3. Limpe o cache do Drupal:
    ```sh
    drush cr
    ```

## Configuração

1. Navegue até a página de configuração do módulo:
    ```
    Administração > Configuração > Serviços Web > Configurações do EF5 Geocoding
    ```
    ou vá diretamente para `/admin/config/services/ef5-geocoding`.

2. Insira sua chave de API HERE e salve as configurações.

3. Para obter uma chave de API HERE, acesse [HERE Developer](https://developer.here.com/develop/rest-apis).

## Uso

1. Acesse o formulário de geocodificação:
    ```
    /geocoding-form
    ```

2. Insira um endereço e um email, e clique em "Enviar".

3. Se o endereço for encontrado, você será redirecionado para uma página com as coordenadas geográficas.

## Estrutura do Código

- **src/Form/GeocodingForm.php**: Define o formulário de entrada de endereço.
- **src/Form/GeocodingSettingsForm.php**: Define o formulário de configuração para a chave da API.
- **src/GeoServicesAPI/GeoCodingAPI.php**: Classe responsável por fazer a chamada à API HERE e obter as coordenadas de latitude e longitude.

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests.

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

## Problemas Conhecidos

- Certifique-se de que a chave da API HERE está correta e ativa.
- Limpe o cache do Drupal após instalar ou atualizar o módulo.

## Suporte

Para suporte, abra um issue no repositório do GitHub.

---

Feito por João Henrique Mendes
