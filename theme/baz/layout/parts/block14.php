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
$block14introtitle = format_text(theme_baz_get_setting('block14introtitle'),FORMAT_HTML, array('noclean' => true));
$block14introcontent = format_text(theme_baz_get_setting('block14introcontent'),FORMAT_HTML, array('noclean' => true));
$block14html = format_text(theme_baz_get_setting('block14htmlcontent'),FORMAT_HTML, array('noclean' => true));
$block14css = theme_baz_get_setting('block14customcss');
$block14img  = $PAGE->theme->setting_file_url("block14bg", "block14bg");
$block14textalign = theme_baz_get_setting('block14textalign');
$block14class = theme_baz_get_setting('block14class');

echo '<!-- Start Block 14 -->';
if(!empty($block14img)) {
   echo '<div class="rui-fp-block--14 rui-fp-block-mt rui-fp-block-mb rounded '.$block14class.'" style="background-image: url(' . $block14img . '); ' . $block14css . '">';
} else {
   echo '<div class="rui-fp-block--14 rui-fp-block-mt rui-fp-block-mb rounded p-4 p-md-6" style="' . $block14css . '">';
}
          echo '<div class="col-12 col-md-6 p-6 text-' . $block14textalign . '">';
                    echo $block14introtitle;
                    echo $block14introcontent;
                    echo $block14html;
          echo '</div>';
echo '</div>';
if(theme_baz_get_setting("displayhrblock14") == '1') {
   echo '<hr class="rui-block-hr wrapper-md" />';
}
echo '<!-- End Block 14 -->';