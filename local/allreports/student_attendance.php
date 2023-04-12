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
 * @package    local_allreports
 * @copyright  Manjunath B K
 * @license    Manjunath B K
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');

class local_attendance_students extends moodleform{

    public function definition(){
        global $CFG,$DB,$USER,$PAGE;
        require_once($CFG->dirroot . '/local/iomad/lib/company.php');
        $cid = iomad::get_my_companyid(context_system::instance(), false);
        $mform = $this->_form;
        //Startdate.
        $mform->addElement('date_selector', 'startdate', get_string('startdate', 'local_allreports'));
        $mform->setType('startdate', PARAM_RAW);

        //Enddate.
        $mform->addElement('date_selector', 'enddate', get_string('enddate', 'local_allreports'));
        $mform->setType('enddate', PARAM_RAW);

        if(is_siteadmin()){
            //5. Center Name
            $companies = $DB->get_records('company',array('suspended'=>0));
            $comparray = array();
            $comparray[''] = "Select Center";
            foreach($companies as $company){
                $comparray[$company->id] = $company->name;
            }
            
            $mform->addElement('select', 'institution', 'Center Name', $comparray,array('onchange'=>'Get_Trainers();'));
            $mform->addRule('institution', 'Missing Center', 'required', null, 'server');  
        }else{
            $companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
            $mform->addElement('hidden', 'institution', $companyid);
            $mform->setType('institution', PARAM_INT);
        }

        $user_array = [];
        $user_array[0] = "Select Batch";
        $companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
        if(is_siteadmin()){
            $batches = $DB->get_records('local_batch');
        }else{
            $batches = $DB->get_records('local_batch',array('center_name'=>$companyid));
        }
        if(!empty($batches)){
            foreach($batches as $batch){
                $user_array[$batch->id] = $batch->batch_code;
            } 
        }
        $mform->addElement('select','batch',"Batch",$user_array);
        $mform->settype('batch', PARAM_RAW);
        $mform->addRule('batch', get_string('required'), 'required', null, 'client');

        $mform->addElement('submit', 'submit', get_string('submit', 'local_allreports'));
    }
}