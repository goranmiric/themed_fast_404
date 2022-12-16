# Themed fast 404

Creates themed static 404 page and serves it instead of dynamic response.

## How it works

This module provides dynamic 404 `/page-not-found` page.
Cron job will access that page, grab the content from it
and put it into a static html file.

After setting proper configuration for drupal core `fast_404`
it will serve static html file instead of bootstaping drupal.

## Installation

See https://www.drupal.org/docs/extending-drupal/installing-modules
for instructions on how to install or update Drupal modules.

## Configuration page

Module configuration page: `/admin/config/system/themed_fast_404`

* Base URL: On some hosting providers it is impossible to pass parameters 
to cron to tell Drupal which URL to bootstrap with. In that case base URL 
will be invalid/incorrect and drupal will not be able to generate static 404 file.
It is recommended to set it.
* 404 page body: The dynamic page not found body content.

## Setup

* Enable the module
* Visit `/admin/config/system/themed_fast_404` and configure it.
* Update `settings.php`
  * In order for this module to work you have to configure drupal core fast 404
  * Example: 
```php
// The default html response (fallback) if the static file is not available.
$fast_404_html = '<!DOCTYPE html><html><head><title>Page not found</title></head><body><h1>Page not found</h1><p>The requested page could not be found.</p></body>';
if ($site_404_html = @file_get_contents($site_path . '/files/page-not-found.html')) {
  $fast_404_html = $site_404_html;
}

// Drupal core fast_404 configuration. More info is available in default.settings.php 
$config['system.performance']['fast_404']['exclude_paths'] = '/\/(?:styles)|(?:system\/files)\//';
$config['system.performance']['fast_404']['paths'] = '/\.*$/i';
$config['system.performance']['fast_404']['html'] = $fast_404_html;
```
