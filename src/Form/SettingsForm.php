<?php

namespace Drupal\themed_fast_404\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provide settings for Themed Fast 404.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'themed_fast_404_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'themed_fast_404.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $field_type = NULL) {
    $config = $this->config('themed_fast_404.settings');

    // Tree element.
    $form['settings'] = [
      '#tree' => TRUE,
    ];

    $form['settings']['base_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Base URL'),
      '#default_value' => $config->get('base_url'),
      '#required' => FALSE,
      '#description' => $this->t('On some hosting providers it is impossible to pass parameters to cron to tell Drupal which URL to bootstrap with.
        In that case base URL will be invalid/incorrect and drupal will not be able to generate static 404 file.
        In that case the base URL can be set here.<br>Example: <em>@url</em>', ['@url' => $GLOBALS['base_url']]),
    ];

    $form['settings']['404_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('404 page body'),
      '#default_value' => $config->get('404_body'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('themed_fast_404.settings')
      ->setData($form_state->getValue('settings'))
      ->save();
  }

}
