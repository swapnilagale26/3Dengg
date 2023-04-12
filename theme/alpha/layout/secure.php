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
 * A secure layout for the alpha theme.
 *
 * @package   theme_alpha
 * @copyright 2019 Marcin Czaja
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

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
$bodyattributes = $OUTPUT->body_attributes();
$siteurl = $CFG->wwwroot;
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'sidepreblocks' => $blockshtml,
    'sidebarblocks' => $blockshtml2,
    'maintopwidgets' => $blockshtml3,
    'mainfwidgets' => $blockshtml4,
    'sidebartopblocks' => $blockshtml5,
    'hasblocks' => $hasblocks,
    'hastopblocks' => $hastopblocks,
    'hasbottomblocks' => $hasbottomblocks,
    'hassidebartopblocks' => $hassidebartopblocks,
    'hassidebarblocks' => $hassidebarblocks,
    'topbarstyle1' => $topbarstyle1,
    'topbarstyle2' => $topbarstyle2,
    'topbarstyle3' => $topbarstyle3,
    'topbarstyle4' => $topbarstyle4,
    'topbarstyle5' => $topbarstyle5,
    'topbarstyle6' => $topbarstyle6,
    'siteurl' => $siteurl
];

$themesettings = new \theme_alpha\util\theme_settings();
$templatecontext = array_merge($templatecontext, $themesettings->front_page_block());
$templatecontext = array_merge($templatecontext, $themesettings->customnav());
$templatecontext = array_merge($templatecontext, $themesettings->head_elements());

echo $OUTPUT->render_from_template('theme_alpha/secure', $templatecontext);
