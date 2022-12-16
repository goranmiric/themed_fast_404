<?php

namespace Drupal\themed_fast_404;

/**
 * Provides an interface for ThemedFast404Manager service.
 */
interface ThemedFast404ManagerInterface {

  /**
   * Drupal (dynamic) 404 page route name.
   */
  const DRUPAL_404_ROUTE_NAME = 'themed_fast_404.page_not_found';

  /**
   * Static 404 file URI.
   */
  const PAGE_NOT_FOUND_FILE_URI = 'public://page-not-found.html';

  /**
   * Build static 404 page.
   */
  public function buildStatic404();

}
