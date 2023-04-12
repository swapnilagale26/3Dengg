<?php
// This file is part of the Certificate module for Moodle - http://moodle.org/
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
 * Handles uploading files
 *
 * @package    local_batch
 * @copyright  
 * @copyright  
 */

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/jquery-3.5.1.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/jquery.dataTables.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/dataTables.buttons.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/buttons.flash.min.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/jszip.min.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/pdfmake.min.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/vfs_fonts.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/buttons.html5.min.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/buttons.print.min.js'), true);


$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/jquery-ui.js'), true);


$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/custom.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/script.js'), true);
