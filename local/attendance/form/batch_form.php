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
 * @copyright  mallamma<mallamma@elearn10.com>
 * @copyright  Dhruv Infoline Pvt Ltd <lmsofindia.com>
 * @license    http://www.lmsofindia.com 2019 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir.'/formslib.php');

class select_batch extends moodleform
{
    public function definition(){
        global $CFG,$OUTPUT,$DB,$USER,$PAGE;
        $courseid = optional_param('course','',PARAM_INT);
        $mform = $this->_form;
        $mform->addElement('hidden', 'course', $courseid);
        $mform->setType('course', PARAM_INT);
        //check for the center incharge.
        $checkforcenterincharge = $DB->get_record('role_assignments',array('roleid'=>10,'userid'=>$USER->id));
        //check for the center incharge.
        $checkfortrainer = $DB->get_record('role_assignments',array('roleid'=>16,'userid'=>$USER->id));



        if(is_siteadmin()){

            $batches = $DB->get_records('local_batch',array('course_name'=>$courseid));

        }else{
            if(!empty($checkforcenterincharge)){
            //Get all the batches related to this center.
                $companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
            //get all the batches for this center.
                $batches = $DB->get_records('local_batch',array('center_name'=>$companyid,'course_name'=>$courseid));

            }elseif (!empty($checkfortrainer)) {

                $companyid = $DB->get_field('trainer_module','center',array('userid'=>$USER->id));
                $userid = $USER->id;
                $batches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE center_name = $companyid AND course_name = $courseid  AND trainer1 = $userid OR trainer2 = $userid");

            }
        }


        $batcharray = array();
        $batcharray[0] = "Select Batch";
        if(!empty($batches)){
            foreach ($batches as $batch) {
                if($batch->course_name == $courseid){
                    $batcharray[$batch->id] = $batch->batch_code;
                } 
            }
        }

        $mform->addElement('select', 'batch', "Select Batch", $batcharray);

        $mform->addElement('submit', 'submit', get_string('submit', 'local_attendance'));
    }   
}