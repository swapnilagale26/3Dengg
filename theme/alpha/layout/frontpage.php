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
 * @copyright 2018 Marcin Czaja
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav-fp', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');
// MODIFICATION Start: Require own locallib.php.
require_once($CFG->dirroot . '/theme/alpha/locallib.php');


$bodyattributes = $OUTPUT->body_attributes([]);
$siteurl = $CFG->wwwroot;

$extraclasses = [];
$frontpagenavdrawer = theme_alpha_get_setting('displaynavdrawerfp');

if ($frontpagenavdrawer == 0) {
    $extraclasses[] = 'hide-fp-drawer';
    $navdraweropen = false;
} else {
    if (isloggedin()) {
        $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
    } else {
        $navdraweropen = false;
    }
    if ($navdraweropen) {
        $extraclasses[] = 'drawer-open-left';
    }
}

$logos = theme_alpha_get_setting('logosperrow');
if ($logos == 1) {
    $logosno = 'col-md-4 col-lg-2';
}
if ($logos == 2) {
    $logosno = 'col-md-4 col-lg-3';
}
if ($logos == 3) {
    $logosno = 'col-md-4 col-lg-4';
}

$slidertextalignment = theme_alpha_get_setting('slidertextalign');
if ($slidertextalignment == 1) {
    $slidertxtalign = 'c-hero-left justify-content-start text-left';
}
if ($slidertextalignment == 2) {
    $slidertxtalign = 'c-hero-center justify-content-center text-center';
}

$isslider = false;
if (theme_alpha_get_setting('fpblock12', true) == true || theme_alpha_get_setting('fpblock8', true) == true || theme_alpha_get_setting('fpteam', true) == true || theme_alpha_get_setting('sliderenabled', true) == true) {
    $isslider = true;
}

$herotextalignment = theme_alpha_get_setting('herotextalign');
if ($herotextalignment == 1) {
    $herotxtalign = 'c-hero-left justify-content-start text-left';
}
if ($herotextalignment == 2) {
    $herotxtalign = 'c-hero-center justify-content-center text-center';
}

//Simple content builder
$pluginsettings = get_config("theme_alpha");

$showfpblock1hr = theme_alpha_get_setting('showfpblock1hr');
$showfpblock2hr = theme_alpha_get_setting('showfpblock2hr');
$showfpblock4hr = theme_alpha_get_setting('showfpblock4hr');
$showfpblock6hr = theme_alpha_get_setting('showfpblock6hr');
$showfpblock7hr = theme_alpha_get_setting('showfpblock7hr');
$showfpblock8hr = theme_alpha_get_setting('showfpblock8hr');

//Simple content builder
$elements = 15;
$pluginsettings = get_config("theme_alpha");
for ($i = 1; $i <= $elements; $i++) {
    ${"slotblock". $i} = theme_alpha_get_setting("slotblock" . $i);
}

for ($i = 1; $i <= $elements; $i++) {
    ${"slotblock". $i} = $pluginsettings->{"slotblock" . $i};

    for ($j = 1; $j <= $elements; $j++) {
        if( ${"slotblock" . $j} == "$i")
        {
            ${"slot" . $i . "block" . $j} = true;
        } else
        {
            ${"slot" . $i . "block" . $j}  = false;
        }

    }
}
//End


$siteurl = $CFG->wwwroot;
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$blockshtml2 = $OUTPUT->blocks('sidebar');
$blockshtml3 = $OUTPUT->blocks('maintopwidgets');
$blockshtml4 = $OUTPUT->blocks('mainfwidgets');
$blockshtml5 = $OUTPUT->blocks('sidebar-top');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$hastopblocks = strpos($blockshtml3, 'data-block=') !== false;
$hasbottomblocks = strpos($blockshtml4, 'data-block=') !== false;
$hassidebartopblocks = strpos($blockshtml5, 'data-block=') !== false;
$hassidebarblocks = strpos($blockshtml2, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'sidebarblocks' => $blockshtml2,
    'maintopwidgets' => $blockshtml3,
    'mainfwidgets' => $blockshtml4,
    'hasblocks' => $hasblocks,
    'navdraweropen' => $navdraweropen,
    'bodyattributes' => $bodyattributes,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'slidertxtalign' => $slidertxtalign,
    'herotxtalign' => $herotxtalign,
    'isslider' => $isslider,
    'logosno' => $logosno,
    'siteurl' => $siteurl,
    'hassidebarblocks' => !empty($blockshtml2),
    'hassidebartopblocks' => !empty($blockshtml5),
    'showfpblock1hr' => $showfpblock1hr,
    'showfpblock2hr' => $showfpblock2hr,
    'showfpblock4hr' => $showfpblock4hr,
    'showfpblock6hr' => $showfpblock6hr,
    'showfpblock7hr' => $showfpblock7hr,
    'showfpblock8hr' => $showfpblock8hr
];

// Content Builder - add element to the array
for ($i = 1; $i <= $elements; $i++) {
    for ($j = 1; $j <= $elements; $j++) {
        $n = "slot" . $i . "block" . $j;
        $templatecontext[$n] = ${"slot" . $i . "block" . $j};
    }
}
//End content buidler

// Improve Alpha navigation.
$boostfumblingnav = theme_alpha_get_setting('boostfumblingnav');
if (!$boostfumblingnav) {
    theme_alpha_extend_flat_navigation($PAGE->flatnav);
}
$templatecontext['flatnavigation'] = $PAGE->flatnav;
$themesettings = new \theme_alpha\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->head_elements());
$templatecontext = array_merge($templatecontext, $themesettings->footer_items());
$templatecontext = array_merge($templatecontext, $themesettings->front_page_block());
$templatecontext = array_merge($templatecontext, $themesettings->heroslider());
$templatecontext = array_merge($templatecontext, $themesettings->team());
$templatecontext = array_merge($templatecontext, $themesettings->logos());
$templatecontext = array_merge($templatecontext, $themesettings->block1());
$templatecontext = array_merge($templatecontext, $themesettings->block2());
$templatecontext = array_merge($templatecontext, $themesettings->block8());
$templatecontext = array_merge($templatecontext, $themesettings->block9());
$templatecontext = array_merge($templatecontext, $themesettings->block10());
$templatecontext = array_merge($templatecontext, $themesettings->block12());
$templatecontext = array_merge($templatecontext, $themesettings->customnav());
$templatecontext = array_merge($templatecontext, $themesettings->sidebar_custom_block());
$templatecontext = array_merge($templatecontext, $themesettings->top_bar_custom_block());

echo $OUTPUT->render_from_template('theme_alpha/frontpage', $templatecontext);
