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
 * Theme functions.
 *
 * @package    theme_alpha
 * @copyright  2019 - 2020 Marcin Czaja - Rosea Themes
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Post process the CSS tree.
 *
 * @param string $tree The CSS tree.
 * @param theme_config $theme The theme config object.
 */
function theme_alpha_css_tree_post_processor($tree, $theme) {
    $prefixer = new theme_alpha\autoprefixer($tree);
    $prefixer->prefix();
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_alpha_get_extra_scss($theme) {
    $content = '';
    // Always return the background image with the scss when we have it.
    return !empty($theme->settings->scss) ? $theme->settings->scss . ' ' . $content : $content;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_alpha_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {

    if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^teamimage[1-9][0-9]?$/", $filearea) !== false ||
        $context->contextlevel == CONTEXT_SYSTEM and preg_match("/^fpblock2image[1-9][0-9]?$/", $filearea) !== false ||
        $context->contextlevel == CONTEXT_SYSTEM and preg_match("/^fpblock8image[1-9][0-9]?$/", $filearea) !== false ||
        $context->contextlevel == CONTEXT_SYSTEM and preg_match("/^fpblock10image[1-9][0-9]?$/", $filearea) !== false ||
        $context->contextlevel == CONTEXT_SYSTEM and preg_match("/^logosimage[1-9][0-9]?$/", $filearea) !== false ||
        $context->contextlevel == CONTEXT_SYSTEM and preg_match("/^herosliderimage[1-9][0-9]?$/", $filearea) !== false ||
        $context->contextlevel == CONTEXT_SYSTEM and preg_match("/^fpblock12image[1-9][0-9]?$/", $filearea) !== false ) {
        $theme = theme_config::load('alpha');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM && ( $filearea === 'logo' ||
                                                      $filearea === 'heroimg' ||
                                                      $filearea === 'herovideomp4' ||
                                                      $filearea === 'herovideowebm' ||
                                                      $filearea === 'herovideoposter' ||
                                                      $filearea === 'customlogosidebar' ||
                                                      $filearea === 'fpblock3bg' ||
                                                      $filearea === 'loginbg' ||
                                                      $filearea === 'customloginlogo' ||
                                                      $filearea === 'customlogotopbar' ||
                                                      $filearea === 'favicon'
                                                    )) {
        $theme = theme_config::load('alpha');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}

/**
 * Get theme setting
 *
 * @param string $setting
 * @param bool $format
 * @return string
 */
function theme_alpha_get_setting($setting, $format = false) {
    $theme = theme_config::load('alpha');

    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}


/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_alpha_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/alpha/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/alpha/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_alpha', 'preset', 0, '/', $filename))) {
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/alpha/scss/preset/default.scss');
    }

    return $scss;
}

/**
 * Initialize page
 * @param moodle_page $page
 */
function theme_alpha_page_init(moodle_page $page) {
    global $CFG;
    $page->requires->jquery();
    // REMOVED: Deprecated function: error_log($CFG->version).
    if ($CFG->version < 2015051100) {
        $page->requires->jquery_plugin('bootstrap', 'theme_alpha');
        $page->requires->jquery_plugin('dropdown', 'theme_alpha');
    }
}

/**
 * Get compiled css.
 *
 * @return string compiled css
 */
function theme_alpha_get_precompiled_css() {
    global $CFG;
    return file_get_contents($CFG->dirroot . '/theme/alpha/style/bootstrap.css');
}


/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
function theme_alpha_get_pre_scss($theme) {
    global $CFG;

    $scss = '';
    $configurable = [
        // Config key => [variableName, ...].
        'fpsectionspadding'   => ['section-padding-top'],
        'bodybgfp'            => ['body-bg-fp'],
        'containerbg'         => ['container-bg'],
        'bodycolor'           => ['body-color'],
        'bodycolorsecondary'  => ['body-color-secondary'],
        'bodycolorlight'      => ['body-color-light'],
        'linkcolor'           => ['link-color'],
        'linkhovercolor'      => ['link-hover-color'],
        'themecolor' => ['theme-color-1'],
        'themecolor2' => ['theme-color-2'],
        'themecolor3' => ['theme-color-3'],
        'themecolor4' => ['theme-color-4'],
        'themecolor5' => ['theme-color-5'],
        'themecolor6' => ['theme-color-6'],
        'themecolor7' => ['theme-color-7'],
        'themecolor8' => ['theme-color-8'],
        'themecolor9' => ['theme-color-9'],
        'themegradient1' => ['theme-gradient-1'],
        'themegradient2' => ['theme-gradient-2'],
        'gray100' => ['gray-100'],
        'gray200' => ['gray-200'],
        'gray300' => ['gray-300'],
        'gray400' => ['gray-400'],
        'gray500' => ['gray-500'],
        'gray600' => ['gray-600'],
        'gray700' => ['gray-700'],
        'gray800' => ['gray-800'],
        'gray900' => ['gray-900'],
        'drawerbg' => ['drawer-bg'],
        'linkcolor' => ['link-color'],
        'linkcolorhover' => ['link-hover-color'],
        'btnprimarybg1' => ['btn-primary-gradient-1'],
        'btnprimarybg2' => ['btn-primary-gradient-2'],
        'btnprimarybg1hover' => ['btn-primary-gradient-1-hover'],
        'btnprimarybg2hover' => ['btn-primary-gradient-2-hover'],
        'btnprimarytext' => ['btn-primary-text'],
        'btnprimarytexthover' => ['btn-primary-text-hover'],
        'btnsecondarybg' => ['btn-secondary-bg'],
        'btnsecondarybghover' => ['btn-secondary-bg-hover'],
        'btnsecondarybordercolor' => ['btn-secondary-border'],
        'btnsecondarybordercolorhover' => ['btn-secondary-border-hover'],
        'btnsecondarytext' => ['btn-secondary-text'],
        'btnsecondarytexthover' => ['btn-secondary-text-hover'],
        'drawerbordercolor' => ['drawer-border-color'],
        'drawericonscolor' => ['drawer-icons-color'],
        'drawericonscolorhover' => ['drawer-icons-color-hover'],
        'drawerheadingcolor' => ['drawer-headings-color'],
        'drawertext' => ['drawer-text'],
        'drawerlinkactivecolor' => ['drawer-link-active'],
        'drawerlinkhovercolor' => ['drawer-link-hover'],
        'drawerscrollbar' => ['drawer-scrollbar'],
        'drawerbtngradient1' => ['drawer-btn-gradient-1'],
        'drawerbtngradient2' => ['drawer-btn-gradient-2'],
        'fontweightregular' => ['font-weight-regular'],
        'fontweightmedium' => ['font-weight-sm-bold'],
        'fontweightbold' => ['font-weight-bold'],
        'googlefontname' => ['font-family-base']
    ];

    // Prepend variables first.
    foreach ($configurable as $configkey => $targets) {
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$scss, $value) {
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Extend theme navigation
 * Author: Willian Mano Araújo
 * https://moodle.org/plugins/theme_moove
 * @param flat_navigation $flatnav
 */
function theme_alpha_extend_flat_navigation(\flat_navigation $flatnav) {
    theme_alpha_rebuildcoursesections($flatnav);
    theme_alpha_delete_menuitems($flatnav);
}

/**
 * Remove items from navigation
 * Author: Willian Mano Araújo
 * https://moodle.org/plugins/theme_moove
 * @param flat_navigation $flatnav
 */
function theme_alpha_delete_menuitems(\flat_navigation $flatnav) {

  foreach ($flatnav as $item) {

      $itemstodelete = [];

      if (in_array($item->key, $itemstodelete)) {
          $flatnav->remove($item->key);

          continue;
      }

      // modified by Marcin Czaja
      if (is_numeric($item->key)) {

          $flatnav->remove($item->key);

          continue;
      }
      // end of modification

      if (isset($item->parent->key) && $item->parent->key == 'mycourses' &&
          isset($item->type) && $item->type == \navigation_node::TYPE_COURSE) {

          $flatnav->remove($item->key);

          continue;
      }

  }
}

/**
 * Improve flat navigation menu
 *
 * @param flat_navigation $flatnav
 */
function theme_alpha_rebuildcoursesections(\flat_navigation $flatnav) {
    global $PAGE;

    if (!isguestuser() ) {
        $participantsitem = $flatnav->find('participants', \navigation_node::TYPE_CONTAINER);

        if (!$participantsitem) {
            return;
        }

        if ($PAGE->course->format != 'singleactivity') {
            $coursesectionsoptions = [
                'text' => get_string('coursesections', 'theme_alpha'),
                'shorttext' => get_string('coursesections', 'theme_alpha'),
                'icon' => new pix_icon('t/viewdetails', ''),
                'type' => \navigation_node::COURSE_CURRENT,
                'key' => 'course-sections',
                'parent' => $participantsitem->parent
            ];

            $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);

            foreach ($flatnav as $item) {
                if ($item->type == \navigation_node::TYPE_SECTION) {
                    $coursesections->add_node(new \navigation_node([
                        'text' => $item->text,
                        'shorttext' => $item->shorttext,
                        'icon' => $item->icon,
                        'type' => $item->type,
                        'key' => $item->key,
                        'parent' => $coursesections,
                        'action' => $item->action
                    ]));
                }
            }

            $flatnav->add($coursesections, 'myhome');

        }

    }
}
