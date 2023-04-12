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
 * @package    local_batch
 * @copyright  
 * @copyright  
 * @license    
 */

require_once('../../config.php');
require_once('lib.php');
global $CFG;

$stubatch_id = optional_param('stubatch_id','',PARAM_INT); 
$deleteid = optional_param('flag', '', PARAM_INT); 
$context = context_system::instance();
$contextid = $context->contextlevel;
require_login();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$local = get_string('local','local_batch');
$url = $CFG->wwwroot;
global $DB,$CFG;
//for delete and cancel url//
$deleteurl = new moodle_url('/local/batch/student_list.php', array('stubatch_id' =>
$stubatch_id, 'flag' =>2));
$pageheadding = get_string("deleteheadding",'local_batch');
$message = get_string("deletedata",'local_batch');

$continuebutton = new single_button($deleteurl, get_string('delete','local_batch'), 'post');
$cancelurl = new moodle_url('/local/batch/student_list.php');
$previewnode = $PAGE->navbar->add($local,$url);
$thingnode = $previewnode->add($pageheadding);
$thingnode->make_active();
$PAGE->set_heading($pageheadding);
echo $OUTPUT->header();
echo $OUTPUT->confirm($message, $continuebutton,$cancelurl);
echo $OUTPUT->footer();
exit;
