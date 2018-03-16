<?php
/**
* @package SliderEsgiPlugin
*/

class SliderPluginDeactivate
{
  public static function deactivate() {
    flush_rewrite_rules();
  }
}
