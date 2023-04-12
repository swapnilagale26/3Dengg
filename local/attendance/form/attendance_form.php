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
 * @package    local_attendance
 * @copyright  Manjunath B K
 */

defined('MOODLE_INTERNAL') || die();

global $OUTPUT, $CFG;
require_once($CFG->libdir.'/formslib.php');
class local_attendance extends moodleform {
    function definition() {
        global $DB,$CFG,$USER,$COURSE;
        $courseid = optional_param('course','',PARAM_INT);
        $batch = optional_param('batch','',PARAM_INT);
        $mform =& $this->_form;
        
        $mform->addElement('hidden', 'course', $courseid);
        $mform->setType('course', PARAM_INT);

        $mform->addElement('hidden', 'user', $USER->id);
        $mform->setType('user', PARAM_INT);

        $check = $DB->get_field('role_assignments','id',array('userid'=>$USER->id,'roleid'=>10));

        $check2 = $DB->get_field('role_assignments','id',array('userid'=>$USER->id,'roleid'=>16));
        $batchobject = $DB->get_record('local_batch',array('id'=>$batch));

        if(is_siteadmin() || !empty($check) || !empty($check2)){

            if(empty($check2)){
                $mform->addElement('header', 'trainersection', 'Trainers Attendance');
            }

            if(!empty($batchobject->trainer1) && empty($check2)){
                $trainer1object = $DB->get_record('user',array('id'=>$batchobject->trainer1));
                $radioarray = array();
                $radioarray[] = $mform->createElement('radio', 'trainer1', '', "P", 1);
                $radioarray[] = $mform->createElement('radio', 'trainer1', '', "A", 0);
                $mform->addGroup($radioarray, 't1', fullname($trainer1object), array(' '), false);
            }

            if(!empty($batchobject->trainer2) && empty($check2)){
                $traine2robject = $DB->get_record('user',array('id'=>$batchobject->trainer2));
                $radioarray1 = array();
                $radioarray1[] = $mform->createElement('radio', 'trainer2', '', "P", 1);
                $radioarray1[] = $mform->createElement('radio', 'trainer2', '', "A", 0);
                $mform->addGroup($radioarray1, 't2', fullname($traine2robject), array(' '), false);
            }
        }

        //Get all the users from the trainer batch.
        $record = $DB->get_record('local_batch',array('trainer1'=>$batchobject->trainer1,'course_name'=>$courseid));


        if(!empty($record)){
            $result = $DB->get_record('batch_student_details',array('batch_id'=>$record->id));

            if(!empty($result)){
                $userids = explode(",",$result->user_id);
                if(!empty($userids)){

                    $mform->addElement('header', 'header1', "Participant Attendance: ".date("d-m-Y",time())."/ Batch: ".$result->batch_code);

                    $mform->addElement('hidden', 'batch', $record->id);
                    $mform->setType('batch', PARAM_INT);

                    $counter = 1;
                    foreach ($userids as $userid) {
                        $user = $DB->get_record('user',array('id'=>$userid));
                        $fullname = fullname($user);
                        $radioarray = array();
                        $radioarray[] = $mform->createElement('radio', 'yesno'.$counter, '', "P", 1);
                        $radioarray[] = $mform->createElement('radio', 'yesno'.$counter, '', "A", 0);
                        $mform->addGroup($radioarray, 'radioar'.$counter, $fullname, array(' '), false);
                        $counter++;
                    }
                }
            }
        }
        $mform->addElement('submit', 'submitbutton', 'Submit');
    }
}