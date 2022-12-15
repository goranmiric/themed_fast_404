<?php

namespace Drupal\themed_fast_404\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for themed_fast_404 routes.
 */
class ThemedFast404Controller extends ControllerBase {

  /**
   * Drupal 404 page.
   *
   * @return array
   *   Render array.
   */
  public function pageNotFound() {
    $config = $this->config('themed_fast_404.settings');

    return [
      '#markup' => $config->get('404_body'),
      '#cache' => [
        'tags' => [
          'config:current-temperature',
        ],
      ],
    ];
  }

}
