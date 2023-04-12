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
 * @package   theme_alpha
 * @copyright 2019 - 2020 Marcin Czaja - Rosea Themes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {


    $settings = new theme_alpha_admin_settingspage_tabs('themesettingalpha', get_string('configtitle', 'theme_alpha'));


          $page = new admin_settingpage('theme_alpha_general', get_string('generalsettings', 'theme_alpha'));

                //HR
                $name = 'theme_alpha/hintro';
                $heading = get_string('hintro', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hintro_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                // Show/hide author info
                $name = 'theme_alpha/showauthorinfo';
                $title = get_string('showauthorinfo', 'theme_alpha');
                $description = get_string('showauthorinfo_desc', 'theme_alpha');
                $default = 1;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

                $name = 'theme_alpha/displaynavdrawerfp';
                $title = get_string('displaynavdrawerfp', 'theme_alpha');
                $description = get_string('displaynavdrawerfp_desc', 'theme_alpha');
                $default = 0;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

               // Setting to display a hint to the hidden visibility of a course.
                $name = 'theme_alpha/showhintcoursehidden';
                $title = get_string('showhintcoursehiddensetting', 'theme_alpha');
                $description = get_string('showhintcoursehiddensetting_desc', 'theme_alpha');
                $default = 0;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

                // Setting to display a hint to the guest accessing of a course
                $name = 'theme_alpha/showhintcourseguestaccess';
                $title = get_string('showhintcourseguestaccesssetting', 'theme_alpha');
                $description = get_string('showhintcourseguestaccesssetting_desc', 'theme_alpha');
                $default = 0;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

                $name = 'theme_alpha/boostfumblingnav';
                $title = get_string('boostfumblingnav', 'theme_alpha');
                $description = get_string('boostfumblingnav_desc', 'theme_alpha');
                $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
                $page->add($setting);

                // Favicon setting.
                $name = 'theme_alpha/favicon';
                $title = get_string('favicon', 'theme_alpha');
                $description = get_string('favicon_desc', 'theme_alpha');
                $opts = array('accepted_types' => array('.ico'), 'maxfiles' => 1);
                $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                // Preset.
                $name = 'theme_alpha/preset';
                $title = get_string('preset', 'theme_alpha');
                $description = get_string('preset_desc', 'theme_alpha');
                $default = 'default.scss';

                $context = context_system::instance();
                $fs = get_file_storage();
                $files = $fs->get_area_files($context->id, 'theme_alpha', 'preset', 0, 'itemid, filepath, filename', false);

                $choices = [];
                foreach ($files as $file) {
                $choices[$file->get_filename()] = $file->get_filename();
                }
                // These are the built in presets.
                $choices['default.scss'] = 'default.scss';
                $choices['plain.scss'] = 'plain.scss';

                $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                // Preset files setting.
                $name = 'theme_alpha/presetfiles';
                $title = get_string('presetfiles','theme_alpha');
                $description = get_string('presetfiles_desc', 'theme_alpha');

                $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
                array('maxfiles' => 20, 'accepted_types' => array('.scss')));
                $page->add($setting);

                // Variable $body-color.
                // Heading
                $name = 'theme_alpha/HVariable';
                $heading = get_string('HVariable', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('HVariable_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);


                // Heading
                $name = 'theme_alpha/docH1';
                $heading = get_string('docH1', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('docH1_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);


                $name = 'theme_alpha/bodybgfp';
                $title = get_string('bodybgfp', 'theme_alpha');
                $description = get_string('bodybgfp_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/bodybg';
                $title = get_string('bodybg', 'theme_alpha');
                $description = get_string('bodybg_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/containerbg';
                $title = get_string('containerbg', 'theme_alpha');
                $description = get_string('containerbg_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/bodycolor';
                $title = get_string('bodycolor', 'theme_alpha');
                $description = get_string('bodycolor_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/bodycolorsecondary';
                $title = get_string('bodycolorsecondary', 'theme_alpha');
                $description = get_string('bodycolorsecondary_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/bodycolorlight';
                $title = get_string('bodycolorlight', 'theme_alpha');
                $description = get_string('bodycolorlight_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/linkcolor';
                $title = get_string('linkcolor', 'theme_alpha');
                $description = get_string('linkcolor_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/linkcolorhover';
                $title = get_string('linkcolorhover', 'theme_alpha');
                $description = get_string('linkcolorhover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                // We use an empty default value because the default color should come from the preset.
                $name = 'theme_alpha/themecolor';
                $title = get_string('themecolor', 'theme_alpha');
                $description = get_string('themecolor_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor2';
                $title = get_string('themecolor2', 'theme_alpha');
                $description = get_string('themecolor2_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor3';
                $title = get_string('themecolor3', 'theme_alpha');
                $description = get_string('themecolor3_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor4';
                $title = get_string('themecolor4', 'theme_alpha');
                $description = get_string('themecolor4_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor5';
                $title = get_string('themecolor5', 'theme_alpha');
                $description = get_string('themecolor5_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor6';
                $title = get_string('themecolor6', 'theme_alpha');
                $description = get_string('themecolor6_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor7';
                $title = get_string('themecolor7', 'theme_alpha');
                $description = get_string('themecolor7_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor8';
                $title = get_string('themecolor8', 'theme_alpha');
                $description = get_string('themecolor8_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themecolor9';
                $title = get_string('themecolor9', 'theme_alpha');
                $description = get_string('themecolor9_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themegradient1';
                $title = get_string('themegradient1', 'theme_alpha');
                $description = get_string('themegradient1_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/themegradient2';
                $title = get_string('themegradient2', 'theme_alpha');
                $description = get_string('themegradient2_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);


                // Heading
                $name = 'theme_alpha/docH2';
                $heading = get_string('docH2', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('docH2_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/gray100';
                $title = get_string('gray100', 'theme_alpha');
                $description = get_string('gray100_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray200';
                $title = get_string('gray200', 'theme_alpha');
                $description = get_string('gray200_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray300';
                $title = get_string('gray300', 'theme_alpha');
                $description = get_string('gray300_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray400';
                $title = get_string('gray400', 'theme_alpha');
                $description = get_string('gray400_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray500';
                $title = get_string('gray500', 'theme_alpha');
                $description = get_string('gray500_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray600';
                $title = get_string('gray600', 'theme_alpha');
                $description = get_string('gray600_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray700';
                $title = get_string('gray700', 'theme_alpha');
                $description = get_string('gray700_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray800';
                $title = get_string('gray800', 'theme_alpha');
                $description = get_string('gray800_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/gray900';
                $title = get_string('gray900', 'theme_alpha');
                $description = get_string('gray900_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                // Heading
                $name = 'theme_alpha/docH3';
                $heading = get_string('docH3', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('docH3_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/btnprimarybg1';
                $title = get_string('btnprimarybg1', 'theme_alpha');
                $description = get_string('btnprimarybg1_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnprimarybg2';
                $title = get_string('btnprimarybg2', 'theme_alpha');
                $description = get_string('btnprimarybg2_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnprimarytext';
                $title = get_string('btnprimarytext', 'theme_alpha');
                $description = get_string('btnprimarytext_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnprimarybg1hover';
                $title = get_string('btnprimarybg1hover', 'theme_alpha');
                $description = get_string('btnprimarybg1hover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnprimarybg2hover';
                $title = get_string('btnprimarybg2hover', 'theme_alpha');
                $description = get_string('btnprimarybg2hover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnprimarytexthover';
                $title = get_string('btnprimarytexthover', 'theme_alpha');
                $description = get_string('btnprimarytexthover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);


                // Heading
                $name = 'theme_alpha/docH4';
                $heading = get_string('docH4', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('docH4_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/btnsecondarybg';
                $title = get_string('btnsecondarybg', 'theme_alpha');
                $description = get_string('btnsecondarybg_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnsecondarybghover';
                $title = get_string('btnsecondarybghover', 'theme_alpha');
                $description = get_string('btnsecondarybghover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnsecondarybordercolor';
                $title = get_string('btnsecondarybordercolor', 'theme_alpha');
                $description = get_string('btnsecondarybordercolor_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnsecondarybordercolorhover';
                $title = get_string('btnsecondarybordercolorhover', 'theme_alpha');
                $description = get_string('btnsecondarybordercolorhover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnsecondarytext';
                $title = get_string('btnsecondarytext', 'theme_alpha');
                $description = get_string('btnsecondarytext_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/btnsecondarytexthover';
                $title = get_string('btnsecondarytexthover', 'theme_alpha');
                $description = get_string('btnsecondarytexthover_desc', 'theme_alpha');
                $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);





    // Must add the page after definiting all the settings!
    $settings->add($page);

    /***
    *
    *    Login page settings
    *
    ***/
    $page = new admin_settingpage('theme_alpha_loginpage', get_string('loginpagesettings', 'theme_alpha'));

        // Heading
        $name = 'theme_alpha/hloginpage';
        $heading = get_string('hloginpage', 'theme_alpha');
        $setting = new admin_setting_heading($name, $heading, format_text(get_string('hloginpage_desc', 'theme_alpha'), FORMAT_MARKDOWN));
        $page->add($setting);

        $name = 'theme_alpha/customloginlogo';
				$title = get_string('customloginlogo', 'theme_alpha');
				$description = get_string('customloginlogo_desc', 'theme_alpha');
				$opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.svg'));
				$setting = new admin_setting_configstoredfile($name, $title, $description, 'customloginlogo', 0, $opts);
				$setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

				$name = 'theme_alpha/loginalignment';
				$title = get_string('loginalignment', 'theme_alpha');
				$description = get_string('loginalignment_desc', 'theme_alpha');
				$options = [];
				$options[1] = get_string('loginalignment-left', 'theme_alpha');
				$options[2] = get_string('loginalignment-center', 'theme_alpha');
        $options[3] = get_string('loginalignment-right', 'theme_alpha');
        $default = 1;
				$setting = new admin_setting_configselect($name, $title, $description, $default, $options);
				$setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

				$name = 'theme_alpha/showloginbg';
				$title = get_string('showloginbg', 'theme_alpha');
				$description = get_string('showloginbg_desc', 'theme_alpha');
				$default = 0;
				$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
				$page->add($setting);

				$name = 'theme_alpha/logincustombg';
				$title = get_string('logincustombg', 'theme_alpha');
				$description = get_string('logincustombg_desc', 'theme_alpha');
				$opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
				$setting = new admin_setting_configstoredfile($name, $title, $description, 'logincustombg', 0, $opts);
				$page->add($setting);


	  $settings->add($page);




    /***
    *
    *    Block Order settings
    *
    ***/
    $page = new admin_settingpage('theme_alpha_blockorder', get_string('blockordersettings', 'theme_alpha'));

        //HR
        $name = 'theme_alpha/blockordertitle';
        $heading = get_string('blockordertitle', 'theme_alpha');
        $setting = new admin_setting_heading($name, $heading, format_text(get_string('blockordertitle_desc', 'theme_alpha'), FORMAT_MARKDOWN));
        $page->add($setting);

        $name = 'theme_alpha/fpsectionspadding';
        $title = get_string('fpsectionspadding', 'theme_alpha');
        $description = get_string('fpsectionspadding_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);


        // Slider/Hero
        $name = 'theme_alpha/slotblock14';
        $title = get_string('slotblock14', 'theme_alpha');
        $description = get_string('slotblock14_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '1', $choices);
        $page->add($setting);


        // BLOCK #13
        $name = 'theme_alpha/slotblock13';
        $title = get_string('slotblock13', 'theme_alpha');
        $description = get_string('slotblock13_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '1', $choices);
        $page->add($setting);

        // BLOCK #15
        $name = 'theme_alpha/slotblock15';
        $title = get_string('slotblock15', 'theme_alpha');
        $description = get_string('slotblock15_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '1', $choices);
        $page->add($setting);

        // BLOCK #1
        $name = 'theme_alpha/slotblock1';
        $title = get_string('slotblock1', 'theme_alpha');
        $description = get_string('slotblock1_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '3', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock1hr';
        $title = get_string('showfpblock1hr', 'theme_alpha');
        $description = get_string('showfpblock1hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #2
        $name = 'theme_alpha/slotblock2';
        $title = get_string('slotblock2', 'theme_alpha');
        $description = get_string('slotblock2_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '3', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock2hr';
        $title = get_string('showfpblock2hr', 'theme_alpha');
        $description = get_string('showfpblock2hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #3
        $name = 'theme_alpha/slotblock3';
        $title = get_string('slotblock3', 'theme_alpha');
        $description = get_string('slotblock3_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '8', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock3hr';
        $title = get_string('showfpblock3hr', 'theme_alpha');
        $description = get_string('showfpblock3hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #4
        $name = 'theme_alpha/slotblock4';
        $title = get_string('slotblock4', 'theme_alpha');
        $description = get_string('slotblock4_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '9', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock4hr';
        $title = get_string('showfpblock4hr', 'theme_alpha');
        $description = get_string('showfpblock4hr_desc', 'theme_alpha');
        $default = 0;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #5
        $name = 'theme_alpha/slotblock5';
        $title = get_string('slotblock5', 'theme_alpha');
        $description = get_string('slotblock5_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '7', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock5hr';
        $title = get_string('showfpblock5hr', 'theme_alpha');
        $description = get_string('showfpblock5hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #6
        $name = 'theme_alpha/slotblock6';
        $title = get_string('slotblock6', 'theme_alpha');
        $description = get_string('slotblock6_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '12', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock6hr';
        $title = get_string('showfpblock6hr', 'theme_alpha');
        $description = get_string('showfpblock6hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #7
        $name = 'theme_alpha/slotblock7';
        $title = get_string('slotblock7', 'theme_alpha');
        $description = get_string('slotblock7_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '5', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock7hr';
        $title = get_string('showfpblock7hr', 'theme_alpha');
        $description = get_string('showfpblock7hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #8
        $name = 'theme_alpha/slotblock8';
        $title = get_string('slotblock8', 'theme_alpha');
        $description = get_string('slotblock8_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '2', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock8hr';
        $title = get_string('showfpblock8hr', 'theme_alpha');
        $description = get_string('showfpblock8hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #9
        $name = 'theme_alpha/slotblock9';
        $title = get_string('slotblock9', 'theme_alpha');
        $description = get_string('slotblock9_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '10', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock9hr';
        $title = get_string('showfpblock9hr', 'theme_alpha');
        $description = get_string('showfpblock9hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #10
        $name = 'theme_alpha/slotblock10';
        $title = get_string('slotblock10', 'theme_alpha');
        $description = get_string('slotblock10_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '6', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock10hr';
        $title = get_string('showfpblock10hr', 'theme_alpha');
        $description = get_string('showfpblock10hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);


        // BLOCK #11
        $name = 'theme_alpha/slotblock11';
        $title = get_string('slotblock11', 'theme_alpha');
        $description = get_string('slotblock11_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '10', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock11hr';
        $title = get_string('showfpblock11hr', 'theme_alpha');
        $description = get_string('showfpblock11hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);

        // BLOCK #12
        $name = 'theme_alpha/slotblock12';
        $title = get_string('slotblock12', 'theme_alpha');
        $description = get_string('slotblock12_desc', 'theme_alpha');
        $choices = array(
          "1" => "1",
          "2" => "2",
          "3" => "3",
          "4" => "4",
          "5" => "5",
          "6" => "6",
          "7" => "7",
          "8" => "8",
          "9" => "9",
          "10" => "10",
          "11" => "11",
          "12" => "12",
          "13" => "13",
          "14" => "14",
          "15" => "15"
        );
        $setting = new admin_setting_configselect($name, $title, $description, '12', $choices);
        $page->add($setting);

        // Show/hide HR
        $name = 'theme_alpha/showfpblock12hr';
        $title = get_string('showfpblock12hr', 'theme_alpha');
        $description = get_string('showfpblock12hr_desc', 'theme_alpha');
        $default = 1;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);

    $settings->add($page);





    /***
    *
    *    Front page settings
    *
    ***/
    $page = new admin_settingpage('theme_alpha_frontpage', get_string('frontpagesettings', 'theme_alpha'));


          /***
          *
          *   Hero
          *
          ***/
          $name = 'theme_alpha/heroimg';
          $title = get_string('heroimg', 'theme_alpha');
          $description = get_string('heroimg_desc', 'theme_alpha');
          $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
          $setting = new admin_setting_configstoredfile($name, $title, $description, 'heroimg', 0, $opts);
          $page->add($setting);

          $name = 'theme_alpha/herotextalign';
          $title = get_string('herotextalign', 'theme_alpha');
          $description = get_string('herotextalign_desc', 'theme_alpha');
          $default = 2;
          $options = array();
          $options[1] = 'left';
          $options[2] = 'center';
          $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
          $page->add($setting);

          $name = 'theme_alpha/herotext2';
          $title = get_string('herotext2', 'theme_alpha');
          $description = get_string('herotext2_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/heroheading';
          $title = get_string('heroheading', 'theme_alpha');
          $description = get_string('heroheading_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/herotext';
          $title = get_string('herotext', 'theme_alpha');
          $description = get_string('herotext_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);


          $name = 'theme_alpha/herohtml';
          $title = get_string('herohtml', 'theme_alpha');
          $description = get_string('herohtml_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);


      $settings->add($page);




      $page = new admin_settingpage('theme_alpha_herovideo', get_string('herovideosettings', 'theme_alpha'));

            $name = 'theme_alpha/herovideoenabled';
            $title = get_string('herovideoenabled', 'theme_alpha');
            $description = get_string('herovideoenabled_desc', 'theme_alpha');
            $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
            $page->add($setting);

            $name = 'theme_alpha/herovideofwenabled';
            $title = get_string('herovideofwenabled', 'theme_alpha');
            $description = get_string('herovideofwenabled_desc', 'theme_alpha');
            $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
            $page->add($setting);

            $name = 'theme_alpha/herovideocontent';
            $title = get_string('herovideocontent', 'theme_alpha');
            $description = get_string('herovideocontent_desc', 'theme_alpha');
            $default = '';
            $setting = new admin_setting_configtextarea($name, $title, $description, $default);
            $page->add($setting);

            $name = 'theme_alpha/herovideomp4';
            $title = get_string('herovideomp4', 'theme_alpha');
            $description = get_string('herovideomp4_desc', 'theme_alpha');
            $opts = array('accepted_types' => array('.mp4'), 'maxfiles' => 1);
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'herovideomp4', 0, $opts);
            $page->add($setting);

            $name = 'theme_alpha/herovideowebm';
            $title = get_string('herovideowebm', 'theme_alpha');
            $description = get_string('herovideowebm_desc', 'theme_alpha');
            $opts = array('accepted_types' => array('.webm'), 'maxfiles' => 1);
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'herovideowebm', 0, $opts);
            $page->add($setting);

            $name = 'theme_alpha/herovideoposter';
            $title = get_string('herovideoposter', 'theme_alpha');
            $description = get_string('herovideoposter_desc', 'theme_alpha');
            $opts = array('accepted_types' => array('.jpg, .png, .gif'), 'maxfiles' => 1);
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'herovideoposter', 0, $opts);
            $page->add($setting);

      $settings->add($page);




      $page = new admin_settingpage('theme_alpha_heroslider', get_string('heroslidersettings', 'theme_alpha'));

              // Enable or disable Slideshow settings.
              $name = 'theme_alpha/sliderenabled';
              $title = get_string('sliderenabled', 'theme_alpha');
              $description = get_string('sliderenabled_desc', 'theme_alpha');
              $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
              $page->add($setting);

              $name = 'theme_alpha/sliderfwenabled';
              $title = get_string('sliderfwenabled', 'theme_alpha');
              $description = get_string('sliderfwenabled_desc', 'theme_alpha');
              $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
              $page->add($setting);

              $name = 'theme_alpha/sliderwithouttext';
              $title = get_string('sliderwithouttext', 'theme_alpha');
              $description = get_string('sliderwithouttext_desc', 'theme_alpha');
              $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
              $page->add($setting);

              $name = 'theme_alpha/sliderintervalenabled';
              $title = get_string('sliderintervalenabled', 'theme_alpha');
              $description = get_string('sliderintervalenabled_desc', 'theme_alpha');
              $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
              $page->add($setting);

              $name = 'theme_alpha/sliderinterval';
          		$title = get_string('sliderinterval', 'theme_alpha');
          		$description = get_string('sliderinterval_desc', 'theme_alpha');
          		$default = '6000';
          		$setting = new admin_setting_configtext($name, $title, $description, $default);
          		$setting->set_updatedcallback('theme_reset_all_caches');
          		$page->add($setting);

              $name = 'theme_alpha/slidertextalign';
              $title = get_string('slidertextalign', 'theme_alpha');
              $description = get_string('slidertextalign_desc', 'theme_alpha');
              $default = 2;
              $options = array();
              $options[1] = 'left';
              $options[2] = 'center';
              $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
              $page->add($setting);

              // Heading
              $name = 'theme_alpha/h2slider';
              $heading = get_string('h2slider', 'theme_alpha');
              $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2slider_desc', 'theme_alpha'), FORMAT_MARKDOWN));
              $page->add($setting);

              $name = 'theme_alpha/slidercount';
              $title = get_string('slidercount', 'theme_alpha');
              $description = get_string('slidercount_desc', 'theme_alpha');
              $default = 1;
              $options = array();
              for ($i = 1; $i < 7; $i++) {
                  $options[$i] = $i;
              }
              $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
              $page->add($setting);

              // If we don't have an slide yet, default to the preset.
              $slidercount = get_config('theme_alpha', 'slidercount');

              if (!$slidercount) {
                  $slidercount = 1;
              }

              for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
                  $fileid = 'sliderimage' . $sliderindex;
                  $name = 'theme_alpha/sliderimage' . $sliderindex;
                  $title = get_string('sliderimage', 'theme_alpha');
                  $description = get_string('sliderimage_desc', 'theme_alpha');
                  $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
                  $setting = new admin_setting_configstoredfile($name, $sliderindex. $title, $description, $fileid, 0, $opts);
                  $page->add($setting);

                  $name = 'theme_alpha/slidertitle' . $sliderindex;
                  $title = get_string('slidertitle', 'theme_alpha');
                  $description = get_string('slidertitle_desc', 'theme_alpha');
                  $default = '';
                  $setting = new admin_setting_configtext($name, $sliderindex . $title, $description, $default);
                  $page->add($setting);

                  $name = 'theme_alpha/slidersubtitle' . $sliderindex;
                  $title = get_string('slidersubtitle', 'theme_alpha');
                  $description = get_string('slidersubtitle_desc', 'theme_alpha');
                  $default = '';
                  $setting = new admin_setting_configtext($name, $sliderindex . $title, $description, $default);
                  $page->add($setting);

                  $name = 'theme_alpha/slidercap' . $sliderindex;
                  $title = get_string('slidercaption', 'theme_alpha');
                  $description = get_string('slidercaption_desc', 'theme_alpha');
                  $default = '';
                  $setting = new admin_setting_configtextarea($name, $sliderindex . $title, $description, $default);
                  $page->add($setting);
              }

      $settings->add($page);








          /***
          *
          *   Top Bar
          *
          ***/
          $page = new admin_settingpage('theme_alpha_topbar', get_string('topbarsettings', 'theme_alpha'));

            //Heading
            $name = 'theme_alpha/hcustomtopnav';
            $heading = get_string('hcustomtopnav', 'theme_alpha');
            $setting = new admin_setting_heading($name, $heading, format_text(get_string('hcustomtopnav_desc', 'theme_alpha'), FORMAT_MARKDOWN));
            $page->add($setting);

            $name = 'theme_alpha/customlogotopbar';
            $title = get_string('customlogotopbar', 'theme_alpha');
            $description = get_string('customlogotopbar_desc', 'theme_alpha');
            $opts = array('accepted_types' => array('.png', '.jpg', '.svg', '.gif'));
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'customlogotopbar', 0, $opts);
            $page->add($setting);

            // Custom nav
            $name = 'theme_alpha/customtopnavhtml';
            $title = get_string('customtopnavhtml', 'theme_alpha');
            $description = get_string('customtopnavhtml_desc', 'theme_alpha');
            $default = '';
            $setting = new admin_setting_configtextarea($name, $title, $description, $default);
            $page->add($setting);

            //Additional NAv
            $name = 'theme_alpha/additionaltopbarnav';
            $title = get_string('additionaltopbarnav', 'theme_alpha');
            $description = get_string('additionaltopbarnav_desc', 'theme_alpha');
            $default = '';
            $setting = new admin_setting_configtextarea($name, $title, $description, $default);
            $page->add($setting);


          $settings->add($page);



          /***
          *
          *   Sidebar
          *
          ***/
          $page = new admin_settingpage('theme_alpha_sidebar', get_string('sidebarsettings', 'theme_alpha'));

            // Sidebar Button
            $name = 'theme_alpha/SidebarButtonIconOpen';
            $title = get_string('SidebarButtonIconOpen', 'theme_alpha');
            $description = get_string('SidebarButtonIconOpen_desc', 'theme_alpha');
            $default = '<i class="fas fa-equals opened"></i>';
            $setting = new admin_setting_configtext($name, $title, $description, $default);
            $page->add($setting);

            $name = 'theme_alpha/SidebarButtonIconClose';
            $title = get_string('SidebarButtonIconClose', 'theme_alpha');
            $description = get_string('SidebarButtonIconClose_desc', 'theme_alpha');
            $default = '<i class="fas fa-arrow-left closed"></i>';
            $setting = new admin_setting_configtext($name, $title, $description, $default);
            $page->add($setting);

            $name = 'theme_alpha/customlogosidebar';
            $title = get_string('customlogosidebar', 'theme_alpha');
            $description = get_string('customlogosidebar_desc', 'theme_alpha');
            $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
            $setting = new admin_setting_configstoredfile($name, $title, $description, 'customlogosidebar', 0, $opts);
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/customrooturl';
            $title = get_string('customrooturl', 'theme_alpha');
            $description = get_string('customrooturl_desc', 'theme_alpha');
            $default = '';
            $setting = new admin_setting_configtext($name, $title, $description, $default);
            $page->add($setting);

            // Show/hide logo
            $name = 'theme_alpha/showsidebarlogo';
            $title = get_string('showsidebarlogo', 'theme_alpha');
            $description = get_string('showsidebarlogo_desc', 'theme_alpha');
            $default = 1;
            $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
            $page->add($setting);

            // Hidden sidebar
            $name = 'theme_alpha/hiddensidebar';
            $title = get_string('hiddensidebar', 'theme_alpha');
            $description = get_string('hiddensidebar_desc', 'theme_alpha');
            $default = 0;
            $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
            $page->add($setting);

            // Expand my coruses
            $name = 'theme_alpha/showmycourses';
            $title = get_string('showmycourses', 'theme_alpha');
            $description = get_string('showmycourses_desc', 'theme_alpha');
            $default = 0;
            $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
            $page->add($setting);

            //Heading
            $name = 'theme_alpha/hsidebarcustombox';
            $heading = get_string('hsidebarcustombox', 'theme_alpha');
            $setting = new admin_setting_heading($name, $heading, format_text(get_string('hsidebarcustombox_desc', 'theme_alpha'), FORMAT_MARKDOWN));
            $page->add($setting);

      			// Sidebar Custom Heading and Text
      			$name = 'theme_alpha/sidebarcustombox';
      			$title = get_string('sidebarcustombox', 'theme_alpha');
      			$description = get_string('sidebarcustombox_desc', 'theme_alpha');
      			$default = 0;
      			$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
      			$page->add($setting);

      			// Sidebar Custom Heading
      			$name = 'theme_alpha/sidebarcustomheading';
      			$title = get_string('sidebarcustomheading', 'theme_alpha');
      			$description = get_string('sidebarcustomheading_desc', 'theme_alpha');
      			$default = '';
      			$setting = new admin_setting_configtext($name, $title, $description, $default);
      			$setting->set_updatedcallback('theme_reset_all_caches');
      			$page->add($setting);

      			// Sidebar Custom Text.
      			$name = 'theme_alpha/sidebarcustomtext';
      			$title = get_string('sidebarcustomtext', 'theme_alpha');
      			$description = get_string('sidebarcustomtext_desc', 'theme_alpha');
      			$default = '';
      			$setting = new admin_setting_configtextarea($name, $title, $description, $default);
      			$setting->set_updatedcallback('theme_reset_all_caches');
      			$page->add($setting);

            //Heading
            $name = 'theme_alpha/hsidebarcustomnav';
            $heading = get_string('hsidebarcustomnav', 'theme_alpha');
            $setting = new admin_setting_heading($name, $heading, format_text(get_string('hsidebarcustomnav_desc', 'theme_alpha'), FORMAT_MARKDOWN));
            $page->add($setting);

      			// Sidebar Custom Nav
      			$name = 'theme_alpha/sidebarcustomnav';
      			$title = get_string('sidebarcustomnav', 'theme_alpha');
      			$description = get_string('sidebarcustomnav_desc', 'theme_alpha');
      			$default = '';
      			$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
      			$page->add($setting);

      			// Sidebar Custom Navigation Title.
      			$name = 'theme_alpha/sidebarcustomnavtitle';
      			$title = get_string('sidebarcustomnavtitle', 'theme_alpha');
      			$description = get_string('sidebarcustomnavtitle_desc', 'theme_alpha');
      			$setting = new admin_setting_configtext($name, $title, $description, $default);
      			$page->add($setting);

      			// Sidebar Custom Navigation Links.
      			$name = 'theme_alpha/sidebarcustomnavigationlinks';
      			$title = get_string('sidebarcustomnavigationlinks', 'theme_alpha');
      			$description = get_string('sidebarcustomnavigationlinks_desc', 'theme_alpha');
      			$default = '';
      			$setting = new admin_setting_configtextarea($name, $title, $description, $default);
      			$page->add($setting);


            //Heading
            $name = 'theme_alpha/hadditionaltext';
            $heading = get_string('hadditionaltext', 'theme_alpha');
            $setting = new admin_setting_heading($name, $heading, format_text(get_string('hadditionaltext_desc', 'theme_alpha'), FORMAT_MARKDOWN));
            $page->add($setting);

            $name = 'theme_alpha/showadditionaltext';
            $title = get_string('showadditionaltext', 'theme_alpha');
            $description = get_string('showadditionaltext_desc', 'theme_alpha');
            $default = 0;
            $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
            $page->add($setting);

            $name = 'theme_alpha/additionaltext';
            $title = get_string('additionaltext', 'theme_alpha');
            $description = get_string('additionaltext_desc', 'theme_alpha');
            $default = '';
            $setting = new admin_setting_configtextarea($name, $title, $description, $default);
            $page->add($setting);




            //Heading
            $name = 'theme_alpha/hsidebarcolors';
            $heading = get_string('hsidebarcolors', 'theme_alpha');
            $setting = new admin_setting_heading($name, $heading, format_text(get_string('hsidebarcolors_desc', 'theme_alpha'), FORMAT_MARKDOWN));
            $page->add($setting);

            $name = 'theme_alpha/drawerbg';
            $title = get_string('drawerbg', 'theme_alpha');
            $description = get_string('drawerbg_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerbordercolor';
            $title = get_string('drawerbordercolor', 'theme_alpha');
            $description = get_string('drawerbordercolor_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawericonscolor';
            $title = get_string('drawericonscolor', 'theme_alpha');
            $description = get_string('drawericonscolor_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawericonscolorhover';
            $title = get_string('drawericonscolorhover', 'theme_alpha');
            $description = get_string('drawericonscolorhover_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerheadingcolor';
            $title = get_string('drawerheadingcolor', 'theme_alpha');
            $description = get_string('drawerheadingcolor_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerlinkactivecolor';
            $title = get_string('drawerlinkactivecolor', 'theme_alpha');
            $description = get_string('drawerlinkactivecolor_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerlinkhovercolor';
            $title = get_string('drawerlinkhovercolor', 'theme_alpha');
            $description = get_string('drawerlinkhovercolor_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawertext';
            $title = get_string('drawertext', 'theme_alpha');
            $description = get_string('drawertext_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerscrollbar';
            $title = get_string('drawerscrollbar', 'theme_alpha');
            $description = get_string('drawerscrollbar_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerbtngradient1';
            $title = get_string('drawerbtngradient1', 'theme_alpha');
            $description = get_string('drawerbtngradient1_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);

            $name = 'theme_alpha/drawerbtngradient2';
            $title = get_string('drawerbtngradient2', 'theme_alpha');
            $description = get_string('drawerbtngradient2_desc', 'theme_alpha');
            $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
            $setting->set_updatedcallback('theme_reset_all_caches');
            $page->add($setting);


          $settings->add($page);





          /***
          *
          *  Custom nav
          *
          ***/

        	$page = new admin_settingpage('theme_alpha_customnav', get_string('customnavsettings', 'theme_alpha'));
                /***
                *
                *   Custom navigation
                *
                ***/

                $name = 'theme_alpha/hcustomnav';
                $heading = get_string('hcustomnav', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hcustomnav_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/showcustomnav';
                $title = get_string('showcustomnav', 'theme_alpha');
                $description = get_string('showcustomnav_desc', 'theme_alpha');
                $default = 0;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

                // Custom nav Icon
                $name = 'theme_alpha/customnavicon';
                $title = get_string('customnavicon', 'theme_alpha');
                $description = get_string('customnavicon_desc', 'theme_alpha');
                $default = '<i class="fas fa-list-ul"></i>';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // Custom nav
                $name = 'theme_alpha/customnavhtml';
                $title = get_string('customnavhtml', 'theme_alpha');
                $description = get_string('customnavhtml_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtextarea($name, $title, $description, $default);
                $page->add($setting);

                // Extra Custom Nav
                $name = 'theme_alpha/extracustomnavhtml';
                $title = get_string('extracustomnavhtml', 'theme_alpha');
                $description = get_string('extracustomnavhtml_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtextarea($name, $title, $description, $default);
                $page->add($setting);


        	$settings->add($page);





          /***
          *
          *   Footer Settings
          *
          ***/
          $page = new admin_settingpage('theme_alpha_footer', get_string('footersettings', 'theme_alpha'));


                $name = 'theme_alpha/showsociallist';
                $title = get_string('showsociallist', 'theme_alpha');
                $description = get_string('showsociallist_desc', 'theme_alpha');
                $default = 0;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

                // website.
                $name = 'theme_alpha/website';
                $title = get_string('website', 'theme_alpha');
                $description = get_string('website_desc', 'theme_alpha');
                $default = 'Moodle Themes';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // website.
                $name = 'theme_alpha/cwebsiteurl';
                $title = get_string('cwebsiteurl', 'theme_alpha');
                $description = get_string('cwebsiteurl_desc', 'theme_alpha');
                $default = 'https://rosea.io';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // mobile.
                $name = 'theme_alpha/mobile';
                $title = get_string('mobile', 'theme_alpha');
                $description = get_string('mobile_desc', 'theme_alpha');
                $default = 'mobile : +55 (18) 00123-45678';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // mail.
                $name = 'theme_alpha/mail';
                $title = get_string('mail', 'theme_alpha');
                $description = get_string('mail_desc', 'theme_alpha');
                $default = 'sample@mail.com';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // facebook url setting.
                $name = 'theme_alpha/facebook';
                $title = get_string('facebook', 'theme_alpha');
                $description = get_string('facebook_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // twitter url setting.
                $name = 'theme_alpha/twitter';
                $title = get_string('twitter', 'theme_alpha');
                $description = get_string('twitter_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // Linkdin url setting.
                $name = 'theme_alpha/linkedin';
                $title = get_string('linkedin', 'theme_alpha');
                $description = get_string('linkedin_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // youtube url setting.
                $name = 'theme_alpha/youtube';
                $title = get_string('youtube', 'theme_alpha');
                $description = get_string('youtube_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // instagram url setting.
                $name = 'theme_alpha/instagram';
                $title = get_string('instagram', 'theme_alpha');
                $description = get_string('instagram_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                // Cutsom icons setting.
                $name = 'theme_alpha/customsocialicon';
                $title = get_string('customsocialicon', 'theme_alpha');
                $description = get_string('customsocialicon_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtextarea($name, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                //Heading
                $name = 'theme_alpha/hcustomfooter';
                $heading = get_string('hcustomfooter', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hcustomfooter_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                // Custom Text
                $name = 'theme_alpha/customfootertext';
                $title = get_string('customfootertext', 'theme_alpha');
                $description = get_string('customfootertext_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
                $page->add($setting);

                // Custom Copyright Text
                $name = 'theme_alpha/copyrighttext';
                $title = get_string('copyrighttext', 'theme_alpha');
                $description = get_string('copyrighttext_desc', 'theme_alpha');
                $default = 'All rights reserved';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);

                //Heading
                $name = 'theme_alpha/hcustomalert';
                $heading = get_string('hcustomalert', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hcustomalert_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                // Custom Alert
                $name = 'theme_alpha/customalert';
                $title = get_string('customalert', 'theme_alpha');
                $description = get_string('customalert_desc', 'theme_alpha');
                $default = 0;
                $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
                $page->add($setting);

                $name = 'theme_alpha/customalertcontent';
                $title = get_string('customalertcontent', 'theme_alpha');
                $description = get_string('customalertcontent_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtextarea($name, $title, $description, $default);
                $page->add($setting);

          $settings->add($page);



      $page = new admin_settingpage('theme_alpha_fpblock1', get_string('fpblock1settings', 'theme_alpha'));

          // Heading
          $name = 'theme_alpha/hfpblock1';
          $heading = get_string('hfpblock1', 'theme_alpha');
          $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock1_desc', 'theme_alpha'), FORMAT_MARKDOWN));
          $page->add($setting);

          /***
          *
          *   HTML Block 1
          *
          ***/
          $name = 'theme_alpha/fpblock1';
          $title = get_string('fpblock1', 'theme_alpha');
          $description = get_string('fpblock1_desc', 'theme_alpha');
          $default = 0;
          $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/showfpblock1intro';
          $title = get_string('showfpblock1intro', 'theme_alpha');
          $description = get_string('showfpblock1intro_desc', 'theme_alpha');
          $default = 0;
          $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock1title';
          $title = get_string('fpblock1title', 'theme_alpha');
          $description = get_string('fpblock1title_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtext($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock1content';
          $title = get_string('fpblock1content', 'theme_alpha');
          $description = get_string('fpblock1content_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
          $page->add($setting);

          // Heading
          $name = 'theme_alpha/h2fpblock1';
          $heading = get_string('h2fpblock1', 'theme_alpha');
          $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2fpblock1_desc', 'theme_alpha'), FORMAT_MARKDOWN));
          $page->add($setting);

          $name = 'theme_alpha/fpblock1layout';
          $title = get_string('fpblock1layout', 'theme_alpha');
          $description = get_string('fpblock1layout_desc', 'theme_alpha');
          $choices = array(
            "col-8 m-auto" => "1",
            "col-sm-11 col-md-6 col-lg-6" => "2",
            "col-sm-11 col-md-4" => "3",
            "col-sm-11 col-md-4 col-lg-3" => "4"
          );
          $setting = new admin_setting_configselect($name, $title, $description, 'col-sm-11 col-md-4 col-lg-3', $choices);
          $page->add($setting);

          $name = 'theme_alpha/fpblock1count';
          $title = get_string('fpblock1count', 'theme_alpha');
          $description = get_string('fpblock1count_desc', 'theme_alpha');
          $default = 1;
          $options = array();
          for ($i = 1; $i <= 60; $i++) {
              $options[$i] = $i;
          }
          $setting = new admin_setting_configselect($name, $title, $description, $default, $options);

          $page->add($setting);

          $fpblock1count = get_config('theme_alpha', 'fpblock1count');

          if (!$fpblock1count) {
              $fpblock1count = 1;
          }

          for ($fpblock1index = 1; $fpblock1index <= $fpblock1count; $fpblock1index++) {

              $name = 'theme_alpha/fpblock1icon' . $fpblock1index;
              $title = get_string('fpblock1icon', 'theme_alpha');
              $description = get_string('fpblock1icon_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtext($name, $fpblock1index . $title, $description, $default);
              $page->add($setting);

              $fileid = 'fpblock1imgicon' . $fpblock1index;
              $name = 'theme_alpha/fpblock1imgicon' . $fpblock1index;
              $title = get_string('fpblock1imgicon', 'theme_alpha');
              $description = get_string('fpblock1imgicon_desc', 'theme_alpha');
              $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
              $setting = new admin_setting_configstoredfile($name, $fpblock1index . $title, $description, $fileid, 0, $opts);
              $page->add($setting);

              $name = 'theme_alpha/fpblock1heading' . $fpblock1index;
              $title = get_string('fpblock1heading', 'theme_alpha');
              $description = get_string('fpblock1heading_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtextarea($name, $fpblock1index . $title, $description, $default);
              $page->add($setting);

              $name = 'theme_alpha/fpblock1text' . $fpblock1index;
              $title = get_string('fpblock1text', 'theme_alpha');
              $description = get_string('fpblock1text_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtextarea($name, $fpblock1index . $title, $description, $default);
              $page->add($setting);
      }

      $settings->add($page);





      $page = new admin_settingpage('theme_alpha_fpblock2', get_string('fpblock2settings', 'theme_alpha'));

          // Heading
          $name = 'theme_alpha/hfpblock2';
          $heading = get_string('hfpblock2', 'theme_alpha');
          $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock2_desc', 'theme_alpha'), FORMAT_MARKDOWN));
          $page->add($setting);

          /***
          *
          *   HTML Block 2
          *
          ***/
          $name = 'theme_alpha/fpblock2';
          $title = get_string('fpblock2', 'theme_alpha');
          $description = get_string('fpblock2_desc', 'theme_alpha');
          $default = 0;
          $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/showfpblock2intro';
          $title = get_string('showfpblock2intro', 'theme_alpha');
          $description = get_string('showfpblock2intro_desc', 'theme_alpha');
          $default = 0;
          $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock2title';
          $title = get_string('fpblock2title', 'theme_alpha');
          $description = get_string('fpblock2title_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtext($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock2content';
          $title = get_string('fpblock2content', 'theme_alpha');
          $description = get_string('fpblock2content_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
          $page->add($setting);

          // Heading
          $name = 'theme_alpha/h2fpblock2';
          $heading = get_string('h2fpblock2', 'theme_alpha');
          $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2fpblock2_desc', 'theme_alpha'), FORMAT_MARKDOWN));
          $page->add($setting);

          $name = 'theme_alpha/fpblock2layout';
          $title = get_string('fpblock2layout', 'theme_alpha');
          $description = get_string('fpblock2layout_desc', 'theme_alpha');
          $choices = array(
            "col-8 m-auto" => "1",
            "col-sm-12 col-md-5" => "2",
            "col-sm-12 col-md-4" => "3",
            "col-sm-12 col-md-4 col-lg-3" => "4"
          );
          $setting = new admin_setting_configselect($name, $title, $description, 'col-sm-12 col-md-5', $choices);
          $page->add($setting);

          $name = 'theme_alpha/fpblock2count';
          $title = get_string('fpblock2count', 'theme_alpha');
          $description = get_string('fpblock2count_desc', 'theme_alpha');
          $default = 1;
          $options = array();
          for ($i = 1; $i <= 60; $i++) {
              $options[$i] = $i;
          }
          $setting = new admin_setting_configselect($name, $title, $description, $default, $options);

          $page->add($setting);

          $fpblock2count = get_config('theme_alpha', 'fpblock2count');

          if (!$fpblock2count) {
              $fpblock2count = 1;
          }

          for ($fpblock2index = 1; $fpblock2index <= $fpblock2count; $fpblock2index++) {

  	          $fileid = 'fpblock2image' . $fpblock2index;
  	          $name = 'theme_alpha/fpblock2image' . $fpblock2index;
  	          $title = get_string('fpblock2image', 'theme_alpha');
  	          $description = get_string('fpblock2image_desc', 'theme_alpha');
  	          $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
  	          $setting = new admin_setting_configstoredfile($name, $fpblock2index . $title, $description, $fileid, 0, $opts);

  	          $page->add($setting);

              $name = 'theme_alpha/fpblock2heading' . $fpblock2index;
              $title = get_string('fpblock2heading', 'theme_alpha');
              $description = get_string('fpblock2heading_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtext($name, $fpblock2index . $title, $description, $default);

              $page->add($setting);

              $name = 'theme_alpha/fpblock2text' . $fpblock2index;
              $title = get_string('fpblock2text', 'theme_alpha');
              $description = get_string('fpblock2text_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtextarea($name, $fpblock2index . $title, $description, $default);

              $page->add($setting);

              $name = 'theme_alpha/fpblock2label' . $fpblock2index;
              $title = get_string('fpblock2label', 'theme_alpha');
              $description = get_string('fpblock2label_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtext($name, $fpblock2index . $title, $description, $default);

              $page->add($setting);

              $name = 'theme_alpha/fpblock2url' . $fpblock2index;
              $title = get_string('fpblock2url', 'theme_alpha');
              $description = get_string('fpblock2url_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtext($name, $fpblock2index . $title, $description, $default);

              $page->add($setting);
      }

      $settings->add($page);





      $page = new admin_settingpage('theme_alpha_fpblock3', get_string('fpblock3settings', 'theme_alpha'));

          // Heading
          $name = 'theme_alpha/hfpblock3';
          $heading = get_string('hfpblock3', 'theme_alpha');
          $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock3_desc', 'theme_alpha'), FORMAT_MARKDOWN));
          $page->add($setting);

          /***
          *
          *   HTML Block 3
          *
          ***/
          $name = 'theme_alpha/fpblock3';
          $title = get_string('fpblock3', 'theme_alpha');
          $description = get_string('fpblock3_desc', 'theme_alpha');
          $default = 0;
          $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
          $page->add($setting);


          $name = 'theme_alpha/fpblock3heading';
          $title = get_string('fpblock3heading', 'theme_alpha');
          $description = get_string('fpblock3heading_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtext($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock3text';
          $title = get_string('fpblock3text', 'theme_alpha');
          $description = get_string('fpblock3text_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock3html';
          $title = get_string('fpblock3html', 'theme_alpha');
          $description = get_string('fpblock3html_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock3bg';
          $title = get_string('fpblock3bg', 'theme_alpha');
          $description = get_string('fpblock3bg_desc', 'theme_alpha');
          $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
          $setting = new admin_setting_configstoredfile($name, $title, $description, 'fpblock3bg', 0, $opts);
          $page->add($setting);

      $settings->add($page);



      $page = new admin_settingpage('theme_alpha_fpblock4', get_string('fpblock4settings', 'theme_alpha'));

          // Heading
          $name = 'theme_alpha/hfpblock4';
          $heading = get_string('hfpblock4', 'theme_alpha');
          $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock4_desc', 'theme_alpha'), FORMAT_MARKDOWN));
          $page->add($setting);

          /***
          *
          *   HTML Block 4
          *
          ***/
          $name = 'theme_alpha/fpblock4';
          $title = get_string('fpblock4', 'theme_alpha');
          $description = get_string('fpblock4_desc', 'theme_alpha');
          $default = 0;
          $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock4heading';
          $title = get_string('fpblock4heading', 'theme_alpha');
          $description = get_string('fpblock4heading_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtext($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock4text';
          $title = get_string('fpblock4text', 'theme_alpha');
          $description = get_string('fpblock4text_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
          $page->add($setting);

          $name = 'theme_alpha/fpblock4content';
          $title = get_string('fpblock4content', 'theme_alpha');
          $description = get_string('fpblock4content_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $title, $description, $default);
          $page->add($setting);


    $settings->add($page);





    $page = new admin_settingpage('theme_alpha_fpcustomcategoryblock', get_string('fpcustomcategoryblocksettings', 'theme_alpha'));

        // Heading
        $name = 'theme_alpha/hfpcustomcategoryblock';
        $heading = get_string('hfpcustomcategoryblock', 'theme_alpha');
        $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpcustomcategoryblock_desc', 'theme_alpha'), FORMAT_MARKDOWN));
        $page->add($setting);

        /***
        *
        *    Custom Category Block
        *
        ***/
        $name = 'theme_alpha/fpcustomcategoryblock';
        $title = get_string('fpcustomcategoryblock', 'theme_alpha');
        $description = get_string('fpcustomcategoryblock_desc', 'theme_alpha');
        $default = 0;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/showfpcustomcategoryintro';
        $title = get_string('showfpcustomcategoryintro', 'theme_alpha');
        $description = get_string('showfpcustomcategoryintro_desc', 'theme_alpha');
        $default = 0;
        $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpcustomcategorytitle';
        $title = get_string('fpcustomcategorytitle', 'theme_alpha');
        $description = get_string('fpcustomcategorytitle_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtext($name, $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpcustomcategorycontent';
        $title = get_string('fpcustomcategorycontent', 'theme_alpha');
        $description = get_string('fpcustomcategorycontent_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpcustomcategoryblockhtml1';
        $title = get_string('fpcustomcategoryblockhtml1', 'theme_alpha');
        $description = get_string('fpcustomcategoryblockhtml1_desc', 'theme_alpha');
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpcustomcategoryblockhtml2';
        $title = get_string('fpcustomcategoryblockhtml2', 'theme_alpha');
        $description = get_string('fpcustomcategoryblockhtml2_desc', 'theme_alpha');
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpcustomcategoryblockhtml3';
        $title = get_string('fpcustomcategoryblockhtml3', 'theme_alpha');
        $description = get_string('fpcustomcategoryblockhtml3_desc', 'theme_alpha');
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);




    $settings->add($page);




    $page = new admin_settingpage('theme_alpha_logos', get_string('logossettings', 'theme_alpha'));


    // Heading
    $name = 'theme_alpha/hlogos';
    $heading = get_string('hlogos', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('hlogos_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

		$name = 'theme_alpha/fplogos';
		$title = get_string('fplogos', 'theme_alpha');
		$description = get_string('fplogos_desc', 'theme_alpha');
		$default = 0;
		$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
		$page->add($setting);

    $name = 'theme_alpha/showfpblock6intro';
    $title = get_string('showfpblock6intro', 'theme_alpha');
    $description = get_string('showfpblock6intro_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

		$name = 'theme_alpha/fplogostitle';
		$title = get_string('fplogostitle', 'theme_alpha');
		$description = get_string('fplogostitle_desc', 'theme_alpha');
		$default = '';
		$setting = new admin_setting_configtext($name, $title, $description, $default);
		$page->add($setting);

		$name = 'theme_alpha/fplogoscontent';
		$title = get_string('fplogoscontent', 'theme_alpha');
		$description = get_string('fplogoscontent_desc', 'theme_alpha');
		$default = '';
		$setting = new admin_setting_confightmleditor($name, $title, $description, $default);
		$page->add($setting);

    // Heading
    $name = 'theme_alpha/h2logos';
    $heading = get_string('h2logos', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2logos_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    $name = 'theme_alpha/logosperrow';
    $title = get_string('logosperrow', 'theme_alpha');
    $description = get_string('logosperrow_desc', 'theme_alpha');
    $default = 1;
    $options = array();
    $options[1] = '6 per row';
    $options[2] = '4 per row';
    $options[3] = '3 per row';
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $page->add($setting);


		$name = 'theme_alpha/logoscount';
		$title = get_string('logoscount', 'theme_alpha');
		$description = get_string('logoscount_desc', 'theme_alpha');
		$default = 1;
		$options = array();
		for ($i = 1; $i <= 30; $i++) {
		  $options[$i] = $i;
		}
		$setting = new admin_setting_configselect($name, $title, $description, $default, $options);
		$page->add($setting);

		$logoscount = get_config('theme_alpha', 'logoscount');

		if (!$logoscount) {
		    $logoscount = 1;
		}

		for ($logosindex = 1; $logosindex <= $logoscount; $logosindex++) {
		    $fileid = 'logosimage' . $logosindex;
		    $name = 'theme_alpha/logosimage' . $logosindex;
		    $title = get_string('logosimage', 'theme_alpha');
		    $description = get_string('logosimage_desc', 'theme_alpha');
		    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
		    $setting = new admin_setting_configstoredfile($name, $logosindex . $title, $description, $fileid, 0, $opts);
		    $page->add($setting);

		    $name = 'theme_alpha/logosurl' . $logosindex;
		    $title = get_string('logosurl', 'theme_alpha');
		    $description = get_string('logosurl_desc', 'theme_alpha');
		    $default = '';
		    $setting = new admin_setting_configtext($name, $logosindex . $title, $description, $default);
		    $page->add($setting);

		    $name = 'theme_alpha/logosname' . $logosindex;
		    $title = get_string('logosname', 'theme_alpha');
		    $description = get_string('logosname_desc', 'theme_alpha');
		    $setting = new admin_setting_configtext($name, $logosindex . $title, $description, $default);
		    $page->add($setting);
		}

    $settings->add($page);


   $page = new admin_settingpage('theme_alpha_team', get_string('teamsettings', 'theme_alpha'));

             // Heading
             $name = 'theme_alpha/hteam';
             $heading = get_string('hteam', 'theme_alpha');
             $setting = new admin_setting_heading($name, $heading, format_text(get_string('hteam_desc', 'theme_alpha'), FORMAT_MARKDOWN));
             $page->add($setting);

              /***
              *
              *   Team
              *
              ***/
              $name = 'theme_alpha/fpteam';
              $title = get_string('fpteam', 'theme_alpha');
              $description = get_string('fpteam_desc', 'theme_alpha');
              $default = 0;
              $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
              $page->add($setting);

              $name = 'theme_alpha/fpteamtitle';
              $title = get_string('fpteamtitle', 'theme_alpha');
              $description = get_string('fpteamtitle_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_configtext($name, $title, $description, $default);

              $page->add($setting);

              $name = 'theme_alpha/fpteamcontent';
              $title = get_string('fpteamcontent', 'theme_alpha');
              $description = get_string('fpteamcontent_desc', 'theme_alpha');
              $default = '';
              $setting = new admin_setting_confightmleditor($name, $title, $description, $default);

              $page->add($setting);

              // Heading
              $name = 'theme_alpha/h2team';
              $heading = get_string('h2team', 'theme_alpha');
              $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2team_desc', 'theme_alpha'), FORMAT_MARKDOWN));
              $page->add($setting);

              $name = 'theme_alpha/teammemberno';
              $title = get_string('teammemberno', 'theme_alpha');
              $description = get_string('teammemberno_desc', 'theme_alpha');
              $default = '4';
              $setting = new admin_setting_configtext($name, $title, $description, $default);

              $page->add($setting);

              $name = 'theme_alpha/teamcount';
              $title = get_string('teamcount', 'theme_alpha');
              $description = get_string('teamcount_desc', 'theme_alpha');
              $default = 1;
              $options = array();
              for ($i = 1; $i <= 60; $i++) {
                  $options[$i] = $i;
              }
              $setting = new admin_setting_configselect($name, $title, $description, $default, $options);

              $page->add($setting);

              $teamcount = get_config('theme_alpha', 'teamcount');

              if (!$teamcount) {
                  $teamcount = 1;
              }

              for ($teamindex = 1; $teamindex <= $teamcount; $teamindex++) {
                  $fileid = 'teamimage' . $teamindex;
                  $name = 'theme_alpha/teamimage' . $teamindex;
                  $title = get_string('teamimage', 'theme_alpha');
                  $description = get_string('teamimage_desc', 'theme_alpha');
                  $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
                  $setting = new admin_setting_configstoredfile($name, $teamindex . $title, $description, $fileid, 0, $opts);

                  $page->add($setting);

                  $name = 'theme_alpha/teamurl' . $teamindex;
                  $title = get_string('teamurl', 'theme_alpha');
                  $description = get_string('teamurl_desc', 'theme_alpha');
                  $default = '';
                  $setting = new admin_setting_configtext($name, $teamindex . $title, $description, $default);

                  $page->add($setting);

                  $name = 'theme_alpha/teamname' . $teamindex;
                  $title = get_string('teamname', 'theme_alpha');
                  $description = get_string('teamname_desc', 'theme_alpha');
                  $setting = new admin_setting_configtext($name, $teamindex . $title, $description, $default);

                  $page->add($setting);

                  $name = 'theme_alpha/teamtext' . $teamindex;
                  $title = get_string('teamtext', 'theme_alpha');
                  $description = get_string('teamtext_desc', 'theme_alpha');
                  $default = '';
                  $setting = new admin_setting_configtextarea($name, $teamindex . $title, $description, $default);

                  $page->add($setting);

                  $name = 'theme_alpha/teamcustomtext' . $teamindex;
                  $title = get_string('teamcustomtext', 'theme_alpha');
                  $description = get_string('teamcustomtext_desc', 'theme_alpha');
                  $default = '';
                  $setting = new admin_setting_configtextarea($name, $teamindex . $title, $description, $default);

                  $page->add($setting);
              }

    $settings->add($page);



$page = new admin_settingpage('theme_alpha_fpblock8', get_string('fpblock8settings', 'theme_alpha'));

    // Heading
    $name = 'theme_alpha/hfpblock8';
    $heading = get_string('hfpblock8', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock8_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    /***
    *
    *   HTML Block 8
    *
    ***/
    $name = 'theme_alpha/fpblock8';
    $title = get_string('fpblock8', 'theme_alpha');
    $description = get_string('fpblock8_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/showfpblock8intro';
    $title = get_string('showfpblock8intro', 'theme_alpha');
    $description = get_string('showfpblock8intro_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock8title';
    $title = get_string('fpblock8title', 'theme_alpha');
    $description = get_string('fpblock8title_desc', 'theme_alpha');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock8content';
    $title = get_string('fpblock8content', 'theme_alpha');
    $description = get_string('fpblock8content_desc', 'theme_alpha');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock8showbg';
    $title = get_string('fpblock8showbg', 'theme_alpha');
    $description = get_string('fpblock8showbg_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Heading
    $name = 'theme_alpha/h2fpblock8';
    $heading = get_string('h2fpblock8', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2fpblock8_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    $name = 'theme_alpha/fpblock8slidesperrow';
    $title = get_string('fpblock8slidesperrow', 'theme_alpha');
    $description = get_string('fpblock8slidesperrow_desc', 'theme_alpha');
    $choices = array(
      "1" => "1",
      "2" => "2",
      "3" => "3",
      "4" => "4"
    );
    $setting = new admin_setting_configselect($name, $title, $description, '4', $choices);
    $page->add($setting);

    $name = 'theme_alpha/fpblock8count';
    $title = get_string('fpblock8count', 'theme_alpha');
    $description = get_string('fpblock8count_desc', 'theme_alpha');
    $default = 1;
    $options = array();
    for ($i = 1; $i <= 60; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);

    $page->add($setting);

    $fpblock8count = get_config('theme_alpha', 'fpblock8count');

    if (!$fpblock8count) {
        $fpblock8count = 1;
    }

    for ($fpblock8index = 1; $fpblock8index <= $fpblock8count; $fpblock8index++) {
        $fileid = 'fpblock8image' . $fpblock8index;
        $name = 'theme_alpha/fpblock8image' . $fpblock8index;
        $title = get_string('fpblock8image', 'theme_alpha');
        $description = get_string('fpblock8image_desc', 'theme_alpha');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $fpblock8index . $title, $description, $fileid, 0, $opts);

        $page->add($setting);

        $name = 'theme_alpha/fpblock8first' . $fpblock8index;
        $title = get_string('fpblock8first', 'theme_alpha');
        $description = get_string('fpblock8first_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtext($name, $fpblock8index . $title, $description, $default);

        $page->add($setting);

        $name = 'theme_alpha/fpblock8second' . $fpblock8index;
        $title = get_string('fpblock8second', 'theme_alpha');
        $description = get_string('fpblock8second_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $fpblock8index . $title, $description, $default);

        $page->add($setting);

        $name = 'theme_alpha/fpblock8third' . $fpblock8index;
        $title = get_string('fpblock8third', 'theme_alpha');
        $description = get_string('fpblock8third_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $fpblock8index . $title, $description, $default);

        $page->add($setting);
}

$settings->add($page);




$page = new admin_settingpage('theme_alpha_fpblock9', get_string('fpblock9settings', 'theme_alpha'));

    // Heading
    $name = 'theme_alpha/hfpblock9';
    $heading = get_string('hfpblock9', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock9_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    /***
    *
    *   HTML Block 9
    *
    ***/
    $name = 'theme_alpha/fpblock9';
    $title = get_string('fpblock9', 'theme_alpha');
    $description = get_string('fpblock9_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/showfpblock9intro';
    $title = get_string('showfpblock9intro', 'theme_alpha');
    $description = get_string('showfpblock9intro_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock9title';
    $title = get_string('fpblock9title', 'theme_alpha');
    $description = get_string('fpblock9title_desc', 'theme_alpha');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock9content';
    $title = get_string('fpblock9content', 'theme_alpha');
    $description = get_string('fpblock9content_desc', 'theme_alpha');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);

    // Heading
    $name = 'theme_alpha/h2fpblock9';
    $heading = get_string('h2fpblock9', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2fpblock9_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    $name = 'theme_alpha/fpblock9count';
    $title = get_string('fpblock9count', 'theme_alpha');
    $description = get_string('fpblock9count_desc', 'theme_alpha');
    $default = 1;
    $options = array();
    for ($i = 1; $i <= 60; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $page->add($setting);


    $fpblock9count = get_config('theme_alpha', 'fpblock9count');

    if (!$fpblock9count) {
        $fpblock9count = 1;
    }

    if (!$fpblock9count) {
        $fpblock9count = 1;
    }

    for ($fpblock9index = 1; $fpblock9index <= $fpblock9count; $fpblock9index++) {
        $name = 'theme_alpha/fpblock9question' . $fpblock9index;
        $title = get_string('fpblock9question', 'theme_alpha');
        $description = get_string('fpblock9question_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtext($name, $fpblock9index . $title, $description, $default);

        $page->add($setting);

        $name = 'theme_alpha/fpblock9answer' . $fpblock9index;
        $title = get_string('fpblock9answer', 'theme_alpha');
        $description = get_string('fpblock9answer_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $fpblock9index . $title, $description, $default);

        $page->add($setting);
    }

$settings->add($page);




$page = new admin_settingpage('theme_alpha_fpblock10', get_string('fpblock10settings', 'theme_alpha'));

    // Heading
    $name = 'theme_alpha/hfpblock10';
    $heading = get_string('hfpblock10', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock10_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    /***
    *
    *   HTML Block 10
    *
    ***/
    $name = 'theme_alpha/fpblock10';
    $title = get_string('fpblock10', 'theme_alpha');
    $description = get_string('fpblock10_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/showfpblock10intro';
    $title = get_string('showfpblock10intro', 'theme_alpha');
    $description = get_string('showfpblock10intro_desc', 'theme_alpha');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock10title';
    $title = get_string('fpblock10title', 'theme_alpha');
    $description = get_string('fpblock10title_desc', 'theme_alpha');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_alpha/fpblock10content';
    $title = get_string('fpblock10content', 'theme_alpha');
    $description = get_string('fpblock10content_desc', 'theme_alpha');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $page->add($setting);

    // Heading
    $name = 'theme_alpha/h2fpblock10';
    $heading = get_string('h2fpblock10', 'theme_alpha');
    $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2fpblock10_desc', 'theme_alpha'), FORMAT_MARKDOWN));
    $page->add($setting);

    $name = 'theme_alpha/fpblock10layout';
    $title = get_string('fpblock10layout', 'theme_alpha');
    $description = get_string('fpblock10layout_desc', 'theme_alpha');
    $choices = array(
      "col-8 m-auto" => "1",
      "col-sm-11 col-md-6 col-lg-6" => "2",
      "col-sm-11 col-md-4" => "3",
      "col-sm-11 col-md-4 col-lg-3" => "4"
    );
    $setting = new admin_setting_configselect($name, $title, $description, 'col-sm-11 col-md-4 col-lg-3', $choices);
    $page->add($setting);

    $name = 'theme_alpha/fpblock10count';
    $title = get_string('fpblock10count', 'theme_alpha');
    $description = get_string('fpblock10count_desc', 'theme_alpha');
    $default = 1;
    $options = array();
    for ($i = 1; $i <= 60; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $page->add($setting);

    $fpblock10count = get_config('theme_alpha', 'fpblock10count');

    if (!$fpblock10count) {
        $fpblock10count = 1;
    }

    for ($fpblock10index = 1; $fpblock10index <= $fpblock10count; $fpblock10index++) {

        $fileid = 'fpblock10imgicon' . $fpblock10index;
        $name = 'theme_alpha/fpblock10imgicon' . $fpblock10index;
        $title = get_string('fpblock10imgicon', 'theme_alpha');
        $description = get_string('fpblock10imgicon_desc', 'theme_alpha');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $fpblock10index . $title, $description, $fileid, 0, $opts);
        $page->add($setting);


        $name = 'theme_alpha/fpblock10heading' . $fpblock10index;
        $title = get_string('fpblock10heading', 'theme_alpha');
        $description = get_string('fpblock10heading_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $fpblock10index . $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpblock10subheading' . $fpblock10index;
        $title = get_string('fpblock10subheading', 'theme_alpha');
        $description = get_string('fpblock10subheading_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $fpblock10index . $title, $description, $default);
        $page->add($setting);

        $name = 'theme_alpha/fpblock10additionaltext' . $fpblock10index;
        $title = get_string('fpblock10additionaltext', 'theme_alpha');
        $description = get_string('fpblock10additionaltext_desc', 'theme_alpha');
        $default = '';
        $setting = new admin_setting_configtextarea($name, $fpblock10index . $title, $description, $default);
        $page->add($setting);

      }

      $settings->add($page);


      $page = new admin_settingpage('theme_alpha_fpblock12', get_string('fpblock12settings', 'theme_alpha'));

      // Heading
      $name = 'theme_alpha/hfpblock12';
      $heading = get_string('hfpblock12', 'theme_alpha');
      $setting = new admin_setting_heading($name, $heading, format_text(get_string('hfpblock12_desc', 'theme_alpha'), FORMAT_MARKDOWN));
      $page->add($setting);

      /***
      *
      *   HTML Block 12
      *
      ***/
      $name = 'theme_alpha/fpblock12';
      $title = get_string('fpblock12', 'theme_alpha');
      $description = get_string('fpblock12_desc', 'theme_alpha');
      $default = 0;
      $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
      $page->add($setting);

      $name = 'theme_alpha/showfpblock12intro';
      $title = get_string('showfpblock12intro', 'theme_alpha');
      $description = get_string('showfpblock12intro_desc', 'theme_alpha');
      $default = 0;
      $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
      $page->add($setting);

      $name = 'theme_alpha/fpblock12title';
      $title = get_string('fpblock12title', 'theme_alpha');
      $description = get_string('fpblock12title_desc', 'theme_alpha');
      $default = '';
      $setting = new admin_setting_configtext($name, $title, $description, $default);
      $page->add($setting);

      $name = 'theme_alpha/fpblock12content';
      $title = get_string('fpblock12content', 'theme_alpha');
      $description = get_string('fpblock12content_desc', 'theme_alpha');
      $default = '';
      $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
      $page->add($setting);

      $name = 'theme_alpha/fpblock12slidesperrow';
      $title = get_string('fpblock12slidesperrow', 'theme_alpha');
      $description = get_string('fpblock12slidesperrow_desc', 'theme_alpha');
      $choices = array(
        "1" => "1",
        "2" => "2",
        "3" => "3",
        "4" => "4"
      );
      $setting = new admin_setting_configselect($name, $title, $description, '3', $choices);
      $page->add($setting);

      $name = 'theme_alpha/fpblock12grid';
      $title = get_string('fpblock12grid', 'theme_alpha');
      $description = get_string('fpblock12grid_desc', 'theme_alpha');
      $default = 0;
      $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
      $page->add($setting);

      // Heading
      $name = 'theme_alpha/h2fpblock12';
      $heading = get_string('h2fpblock12', 'theme_alpha');
      $setting = new admin_setting_heading($name, $heading, format_text(get_string('h2fpblock12_desc', 'theme_alpha'), FORMAT_MARKDOWN));
      $page->add($setting);

      $name = 'theme_alpha/fpblock12count';
      $title = get_string('fpblock12count', 'theme_alpha');
      $description = get_string('fpblock12count_desc', 'theme_alpha');
      $default = 1;
      $options = array();
      for ($i = 1; $i <= 60; $i++) {
          $options[$i] = $i;
      }
      $setting = new admin_setting_configselect($name, $title, $description, $default, $options);

      $page->add($setting);

      $fpblock12count = get_config('theme_alpha', 'fpblock12count');

      if (!$fpblock12count) {
          $fpblock12count = 1;
      }

      for ($fpblock12index = 1; $fpblock12index <= $fpblock12count; $fpblock12index++) {
          $fileid = 'fpblock12image' . $fpblock12index;
          $name = 'theme_alpha/fpblock12image' . $fpblock12index;
          $title = get_string('fpblock12image', 'theme_alpha');
          $description = get_string('fpblock12image_desc', 'theme_alpha');
          $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
          $setting = new admin_setting_configstoredfile($name, $fpblock12index . $title, $description, $fileid, 0, $opts);

          $page->add($setting);

          $name = 'theme_alpha/fpblock12html' . $fpblock12index;
          $title = get_string('fpblock12html', 'theme_alpha');
          $description = get_string('fpblock12html_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $fpblock12index . $title, $description, $default);

          $page->add($setting);

          $name = 'theme_alpha/fpblock12first' . $fpblock12index;
          $title = get_string('fpblock12first', 'theme_alpha');
          $description = get_string('fpblock12first_desc', 'theme_alpha');
          $setting = new admin_setting_configtextarea($name, $fpblock12index . $title, $description, $default);

          $page->add($setting);

          $name = 'theme_alpha/fpblock12second' . $fpblock12index;
          $title = get_string('fpblock12second', 'theme_alpha');
          $description = get_string('fpblock12second_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $fpblock12index . $title, $description, $default);

          $page->add($setting);

          $name = 'theme_alpha/fpblock12third' . $fpblock12index;
          $title = get_string('fpblock12third', 'theme_alpha');
          $description = get_string('fpblock12third_desc', 'theme_alpha');
          $default = '';
          $setting = new admin_setting_configtextarea($name, $fpblock12index . $title, $description, $default);

          $page->add($setting);
  }

  $settings->add($page);


            /***
          *
          *  Advanced Settings
          *
          ***/
          $page = new admin_settingpage('theme_alpha_advanced', get_string('advancedsettings', 'theme_alpha'));
                $name = 'theme_alpha/showloader';
        				$title = get_string('showloader', 'theme_alpha');
        				$description = get_string('showloader_desc', 'theme_alpha');
        				$default = 0;
        				$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        				$page->add($setting);

                // Google analytics block.
                $name = 'theme_alpha/hgoogleanalytics';
                $heading = get_string('hgoogleanalytics', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hgoogleanalytics_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/googleanalytics';
                $title = get_string('googleanalytics', 'theme_alpha');
                $description = get_string('googleanalytics_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $page->add($setting);


                $name = 'theme_alpha/hscss';
                $heading = get_string('hscss', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hscss_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                // Raw SCSS to include before the content.
                $setting = new admin_setting_scsscode('theme_alpha/scsspre',
                    get_string('rawscsspre', 'theme_alpha'), get_string('rawscsspre_desc', 'theme_alpha'), '', PARAM_RAW);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                // Raw SCSS to include after the content.
                $setting = new admin_setting_scsscode('theme_alpha/scss', get_string('rawscss', 'theme_alpha'),
                    get_string('rawscss_desc', 'theme_alpha'), '', PARAM_RAW);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                // Google Font.
                $name = 'theme_alpha/hgooglefont';
                $heading = get_string('hgooglefont', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hgooglefont_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/googlefonturl';
                $title = get_string('googlefonturl', 'theme_alpha');
                $description = get_string('googlefonturl_desc', 'theme_alpha');
                $default = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap';
                $setting = new admin_setting_configtextarea($name, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/googlefontname';
                $title = get_string('googlefontname', 'theme_alpha');
                $description = get_string('googlefontname_desc', 'theme_alpha');
                $default = "'Inter', sans-serif";
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/fontweightregular';
                $title = get_string('fontweightregular', 'theme_alpha');
                $description = get_string('fontweightregular_desc', 'theme_alpha');
                $default = '400';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/fontweightmedium';
                $title = get_string('fontweightmedium', 'theme_alpha');
                $description = get_string('fontweightmedium_desc', 'theme_alpha');
                $default = '600';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);

                $name = 'theme_alpha/fontweightbold';
                $title = get_string('fontweightbold', 'theme_alpha');
                $description = get_string('fontweightbold_desc', 'theme_alpha');
                $default = '800';
                $setting = new admin_setting_configtext($name, $title, $description, $default);
                $setting->set_updatedcallback('theme_reset_all_caches');
                $page->add($setting);


                // Custom Font
                // Heading
                $name = 'theme_alpha/hcustomfont';
                $heading = get_string('hcustomfont', 'theme_alpha');
                $setting = new admin_setting_heading($name, $heading, format_text(get_string('hcustomfont_desc', 'theme_alpha'), FORMAT_MARKDOWN));
                $page->add($setting);

                $name = 'theme_alpha/customwebfont';
        				$title = get_string('customwebfont', 'theme_alpha');
        				$description = get_string('customwebfont_desc', 'theme_alpha');
        				$default = 0;
        				$setting = new admin_setting_configcheckbox($name, $title, $description, $default);
        				$page->add($setting);

                $name = 'theme_alpha/customwebfonthtml';
                $title = get_string('customwebfonthtml', 'theme_alpha');
                $description = get_string('customwebfonthtml_desc', 'theme_alpha');
                $default = '';
                $setting = new admin_setting_configtextarea($name, $title, $description, $default);
                $page->add($setting);


          $settings->add($page);
}
