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
 * Handles uploading files
 *
 * @package    local_trainer
 * @copyright  Manjunath B K<manjunath@elearn10.com>
 * @copyright  Dhruv Infoline Pvt Ltd <lmsofindia.com>
 * @license    http://www.lmsofindia.com 2017 or lat
 */

require_once('../../config.php');
require_once('lib.php');
global $CFG,$COURSE;
$vidid = optional_param('id','',PARAM_INT);
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot.'/local/trainer/delete.php');
global $DB,$CFG;
require_login();
//for delete and cancel url//
$deleteurl = new moodle_url('/local/trainer/create_trainer.php', array('did' => $vidid,'flag'=>2));
$pageheadding = "Delete Trainer";
$message = "Are you sure to delete the trainer.? All enrollments related to this trainer will be remained.";

$continuebutton = new single_button($deleteurl, get_string('delete','local_trainer'), 'post');
$cancelurl = new moodle_url('/local/trainer/index.php',array('did' => 0,'flag'=>0));
$PAGE->navbar->add($pageheadding);
$PAGE->set_heading($pageheadding);
echo $OUTPUT->header();
echo $OUTPUT->confirm($message, $continuebutton,$cancelurl);
echo $OUTPUT->footer();
exit;