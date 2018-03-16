<?php
/**
* @package SliderEsgiPlugin
*/

class SliderPluginActivate
{
  public static function activate() {
    flush_rewrite_rules();
  }
}
