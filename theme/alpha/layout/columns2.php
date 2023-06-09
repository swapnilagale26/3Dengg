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
 * A two column layout for the alpha theme.
 *
 * @package   theme_alpha
 * @copyright 2019 Marcin Czaja
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');
// MODIFICATION Start: Require own locallib.php.
require_once($CFG->dirroot . '/theme/alpha/locallib.php');
// MODIFICATION END.

$bodyattributes = $OUTPUT->body_attributes([]);
$siteurl = $CFG->wwwroot;

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = true;
}

$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}

$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$blockshtml2 = $OUTPUT->blocks('sidebar');
$blockshtml3 = $OUTPUT->blocks('maintopwidgets');
$blockshtml4 = $OUTPUT->blocks('mainfwidgets');
$blockshtml5 = $OUTPUT->blocks('sidebar-top');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$siteurl = $CFG->wwwroot;


$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions();
// If the settings menu will be included in the header then don't add it here.
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'sidebarblocks' => $blockshtml2,
    'maintopwidgets' => $blockshtml3,
    'mainfwidgets' => $blockshtml4,
    'sidebartopblocks' => $blockshtml5,
    'hasblocks' => $hasblocks,
    'hasmaintopwidgets' => !empty($blockshtml3),
    'hasmainfwidgets' => !empty($blockshtml4),
    'hassidebarblocks' => !empty($blockshtml2),
    'hassidebartopblocks' => !empty($blockshtml5),
    'navdraweropen' => $navdraweropen,
    'bodyattributes' => $bodyattributes,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'siteurl' => $siteurl
];

// Improve Alpha navigation.
$boostfumblingnav = theme_alpha_get_setting('boostfumblingnav');
if (!$boostfumblingnav) {
    theme_alpha_extend_flat_navigation($PAGE->flatnav);
}
$templatecontext['flatnavigation'] = $PAGE->flatnav;
$themesettings = new \theme_alpha\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->head_elements());
$templatecontext = array_merge($templatecontext, $themesettings->footer_items());
$templatecontext = array_merge($templatecontext, $themesettings->customnav());
$templatecontext = array_merge($templatecontext, $themesettings->sidebar_custom_block());
$templatecontext = array_merge($templatecontext, $themesettings->top_bar_custom_block());

echo $OUTPUT->render_from_template('theme_alpha/columns2', $templatecontext);