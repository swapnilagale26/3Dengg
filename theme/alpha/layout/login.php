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

defined('MOODLE_INTERNAL') || die();

/**
 * A login page layout for the alpha theme.
 *
 * @package   theme_alpha
 * @copyright 2019 Marcin Czaja
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$bodyattributes = $OUTPUT->body_attributes();
$loginalignment = theme_alpha_get_setting('loginalignment');
if ($loginalignment == 1) {
    $extraclasses[] = 'login-left';
}
if ($loginalignment == 2) {
    $extraclasses[] = 'login-center';
}
if ($loginalignment == 3) {
    $extraclasses[] = 'login-right';
}
$siteurl = $CFG->wwwroot;
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'siteurl' => $siteurl
];

$themesettings = new \theme_alpha\util\theme_settings();
$templatecontext = array_merge($templatecontext, $themesettings->login_block());
$templatecontext = array_merge($templatecontext, $themesettings->head_elements());

echo $OUTPUT->render_from_template('theme_alpha/login', $templatecontext);
