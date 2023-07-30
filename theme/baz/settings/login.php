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

// Login settings.
$page = new admin_settingpage('theme_baz_settingslogin', get_string('settingslogin', 'theme_baz'));

	$name = 'theme_baz/hlogin';
	$heading = get_string('hlogin', 'theme_baz');
	$setting = new admin_setting_heading($name, $heading, format_text(get_string('hlogin_desc', 'theme_baz'), FORMAT_MARKDOWN));
	$page->add($setting);

	$name = 'theme_baz/setloginlayout';
	$title = get_string('setloginlayout', 'theme_baz');
	$description = get_string('setloginlayout_desc', 'theme_baz');
	$options = [];
	$options[1] = get_string('loginlayout1', 'theme_baz');
	$options[2] = get_string('loginlayout2', 'theme_baz');
	$options[3] = get_string('loginlayout3', 'theme_baz');
	$setting = new admin_setting_configselect($name, $title, $description, 1, $options);
	$page->add($setting);

	$name = 'theme_baz/customloginlogo';
	$title = get_string('customloginlogo', 'theme_baz');
	$description = get_string('customloginlogo_desc', 'theme_baz');
	$opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.svg'));
	$setting = new admin_setting_configstoredfile($name, $title, $description, 'customloginlogo', 0, $opts);
	$page->add($setting);

	$name = 'theme_baz/loginbg';
	$title = get_string('loginbg', 'theme_baz');
	$description = get_string('loginbg_desc', 'theme_baz');
	$opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
	$setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbg', 0, $opts);
	$page->add($setting);

	$name = 'theme_baz/loginadditionalcontent';
	$title = get_string('loginadditionalcontent', 'theme_baz');
	$description = get_string('loginadditionalcontent_desc', 'theme_baz');
	$default = '';
	$setting = new baz_setting_confightmleditor($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/loginadditionalcontent2';
	$title = get_string('loginadditionalcontent2', 'theme_baz');
	$description = get_string('loginadditionalcontent2_desc', 'theme_baz');
	$default = '';
	$setting = new baz_setting_confightmleditor($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/loginfootercontent';
	$title = get_string('loginfootercontent', 'theme_baz');
	$description = get_string('loginfootercontent_desc', 'theme_baz');
	$default = '';
	$setting = new baz_setting_confightmleditor($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/loginintrotext';
	$title = get_string('loginintrotext', 'theme_baz');
	$description = get_string('loginintrotext_desc', 'theme_baz');
	$default = '';
	$setting = new baz_setting_confightmleditor($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/stringca';
	$title = get_string('stringca', 'theme_baz');
	$description = get_string('stringca_desc', 'theme_baz');
	$default = 'Don\'t have an account?';
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$page->add($setting);


	$name = 'theme_baz/stringbacktologin';
	$title = get_string('stringbacktologin', 'theme_baz');
	$description = get_string('stringbacktologin_desc', 'theme_baz');
	$default = 'Already have an account?';
	$setting = new admin_setting_configtextarea($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/hsignup';
	$heading = get_string('hsignup', 'theme_baz');
	$setting = new admin_setting_heading($name, $heading, format_text(get_string('hsignup_desc', 'theme_baz'), FORMAT_MARKDOWN));
	$page->add($setting);

	$name = 'theme_baz/signupintrotext';
	$title = get_string('signupintrotext', 'theme_baz');
	$description = get_string('signupintrotext_desc', 'theme_baz');
	$default = '';
	$setting = new baz_setting_confightmleditor($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/signuptext';
	$title = get_string('signuptext', 'theme_baz');
	$description = get_string('signuptext_desc', 'theme_baz');
	$default = '';
	$setting = new baz_setting_confightmleditor($name, $title, $description, $default);
	$page->add($setting);

	$name = 'theme_baz/colorloginbgtext';
	$title = get_string('colorloginbgtext', 'theme_baz');
	$description = get_string('colorloginbgtext_desc', 'theme_baz');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

$settings->add($page);