<?php

namespace Drupal\themed_fast_404;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Url;
use Drupal\file\FileRepositoryInterface;

/**
 * Fast 404 manager service.
 */
class ThemedFast404Manager implements ThemedFast404ManagerInterface {

  /**
   * The file repository.
   *
   * @var \Drupal\file\FileRepositoryInterface
   */
  protected $fileRepository;

  /**
   * The config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Themed fast 404 constructor.
   *
   * @param \Drupal\file\FileRepositoryInterface $fileRepository
   *   File repository.
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The config factory service.
   */
  public function __construct(FileRepositoryInterface $fileRepository, ConfigFactory $config_factory) {
    $this->fileRepository = $fileRepository;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritDoc}
   */
  public function buildStatic404() {
    // Get base_url form config.
    $base_url = $this->configFactory->get('themed_fast_404.settings')
      ->get('base_url');

    // Generate Drupal 404 absolute url.
    $path = Url::fromRoute(static::DRUPAL_404_ROUTE_NAME);
    $url = $base_url ? $base_url . $path->toString() : $path->setAbsolute()->toString();

    // Get Drupal 404 page contents.
    $html = file_get_contents($url);

    $this->fileRepository->writeData($html, static::PAGE_NOT_FOUND_FILE_URI, FileSystemInterface::EXISTS_REPLACE);
  }

}
