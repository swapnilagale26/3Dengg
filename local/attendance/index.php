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
 * @package    local_attendance
 * @copyright  Manjunath B K
 */

require_once('../../config.php');
global $DB,$PAGE,$USER,$CFG,$OUTPUT;
require_once($CFG->libdir . '/formslib.php');
require_once('form/batch_form.php');
$context = context_system::instance();
$courseid = optional_param('course','',PARAM_INT);
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_url($CFG->wwwroot . '/local/attendance/index.php?course='.$courseid);
$title = get_string('attendance', 'local_attendance');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();

$mform  =  new select_batch($CFG->wwwroot.'/local/attendance/index.php',array('course'=>$courseid));
if($mform->is_cancelled()){

}elseif($data = $mform->get_data()){
    redirect($CFG->wwwroot.'/local/attendance/attendance.php?course='.$courseid.'&batch='.$data->batch);
}
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();