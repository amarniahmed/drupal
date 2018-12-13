<?php

namespace Drupal\console_tests\Plugin\ImageEffect;

use Drupal\Core\Image\ImageInterface;
use Drupal\image\ImageEffectBase;

/**
 * Provides a 'ConsoleTestsImageEffectt' image effect.
 *
 * @ImageEffect(
 *  id = "console_tests_image_effectt",
 *  label = @Translation("Console tests image effectt"),
 *  description = @Translation("console tests Image blur")
 * )
 */
class ConsoleTestsImageEffectt extends ImageEffectBase {

  /**
   * {@inheritdoc}
   */
  public function applyEffect(ImageInterface $image) {
    // Implement Image Effect.
    return imagefilter($image->getToolkit()->getResource(), IMG_FILTER_NEGATE, NULL);
  }

}
