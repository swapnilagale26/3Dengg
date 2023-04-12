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
 *
 * @package    local_all_reports
 * @copyright   Ganesh K
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class local_user_report extends moodleform{

	public function definition(){
		global $CFG,$OUTPUT,$DB,$USER,$PAGE;
        require_once($CFG->dirroot . '/local/iomad/lib/company.php');
        $cid = iomad::get_my_companyid(context_system::instance(), false);
        $mform = $this->_form;

		//Start Date.
        $mform->addElement('date_selector', 'startdate', "Start Date");
        $mform->addRule('startdate', get_string('required'), 'required', null, 'client');

		//End date.
        $mform->addElement('date_selector', 'enddate', "End Date");
        $mform->addRule('enddate', get_string('required'), 'required', null, 'client');

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

                //4. select lab.[lab]
        if(!is_siteadmin()){
            $companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
            $cohort = $DB->get_record('company', array('id'=>$companyid), '*', MUST_EXIST);
            $context =  context_coursecat::instance($cohort->category);
            $labs = $DB->get_records("cohort",array('visible'=>1,'contextid'=>$context->id));
        }else{
            $labs = $DB->get_records("cohort",array('visible'=>1));
        }

        $laboption = array();
        $laboption[''] = 'Select Lab';                                                       
        foreach ($labs as $slab) { 
            $laboption[$slab->id] = $slab->name;
        }

        $mform->addElement('select', 'lab', 'Lab', $laboption,array('onChange'=>'SelectBatch();'));

        //$mform->addElement('html', '<div><h2>OR</h2></div>');
        
        //Get all trainers.
        $user_array = [];
        $user_array[0] = "Select Trainer";
        // $trainers = $DB->get_records_sql("SELECT u.* from {user} AS u JOIN {role_assignments} AS ra ON ra.userid = u.id WHERE ra.roleid = 16 AND u.deleted = 0");

        $trainers = $DB->get_records_sql("SELECT DISTINCT(tm.id) as tid, u.* from {user} AS u 
            JOIN {role_assignments} AS ra ON ra.userid = u.id 
            JOIN {trainer_module} AS tm ON tm.userid = u.id 
            WHERE ra.roleid = 16 AND u.deleted = 0 AND tm.center = $cid OR tm.share = 1");
        if(!empty($trainers)){
            foreach($trainers as $trainer){
                $user_array[$trainer->id] = $trainer->username;
            } 
        }
        $mform->addElement('select','trainer',"Trainer",$user_array);
        $mform->settype('trainer1', PARAM_RAW);

        $mform->addElement('submit', 'submit', get_string('submit', 'local_allreports'));

    }
}