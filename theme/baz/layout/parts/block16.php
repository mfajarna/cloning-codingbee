<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package   theme_baz
 * @copyright Copyright © 2021 onwards Marcin Czaja (https://rosea.io)
 * @license   Commercial https://themeforest.net/licenses
 *
 */

defined('MOODLE_INTERNAL') || die();

// Variables - Settings
$block16introtitle = format_text(theme_baz_get_setting('block16introtitle'),FORMAT_HTML, array('noclean' => true));
$block16introcontent = format_text(theme_baz_get_setting('block16introcontent'),FORMAT_HTML, array('noclean' => true));
$block16html = format_text(theme_baz_get_setting('block16htmlcontent'),FORMAT_HTML, array('noclean' => true));
$block16footer = format_text(theme_baz_get_setting('block16footercontent'),FORMAT_HTML, array('noclean' => true));
$block16class = theme_baz_get_setting('block16class');

echo '<!-- Start Block 16 -->';
echo '<div class="rui-fp-block--16 '.$block16class.'">';
          if(!empty($block16introtitle) || !empty($block16introcontent)) {
          echo '<div class="wrapper-md">';
          }
          if(!empty($block16introtitle)) {
          echo '<h3 class="rui-block-title">'.$block16introtitle.'</h3>';
          }
          if(!empty($block16introcontent)) {
          echo '<div class="rui-block-desc">'.$block16introcontent.'</div>';
          }
          if(!empty($block16introtitle) || !empty($block16introcontent)) {
          echo '</div>';
          }
          echo $block16html;
          if(!empty($block16footer)) {
          echo '<div class="rui-block-footer wrapper-md">'.$block16footer.'</div>';
          }
echo '</div>';
if(theme_baz_get_setting("displayhrblock16") == '1') {
          echo '<hr class="rui-block-hr wrapper-md" />';
}
echo '<!-- End Block 16 -->';