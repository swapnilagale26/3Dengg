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
 * @package    local_trainer
 * @copyright  mallamma<mallamma@elearn10.com>
 * @copyright  Dhruv Infoline Pvt Ltd <lmsofindia.com>
 * @license    http://www.lmsofindia.com 2019 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->libdir.'/formslib.php');
class trainer_form extends moodleform
{
    public function definition(){
        global $CFG,$OUTPUT,$DB,$USER,$PAGE;
        $id = optional_param('id','',PARAM_INT);
        $mform = $this->_form;

        //hidden id field.
        $mform->addElement('hidden', 'id', $id);
        $mform->setType('id', PARAM_INT);
        
        //traier firstname.
        $mform->addElement('text', 'tfirstname', get_string('tfirstname', 'local_trainer'));
        $mform->setType('tfirstname', PARAM_TEXT);
        $mform->addRule('tfirstname', 'Missing Firstname', 'required', null, 'server');
        
        //Trainer lastname.
        $mform->addElement('text', 'tlastname', get_string('tlastname', 'local_trainer'));
        $mform->setType('tlastname', PARAM_TEXT);
        $mform->addRule('tlastname', 'Missing Lastname', 'required', null, 'server');        
        //Trainer lastname.
        $mform->addElement('text', 'temail', get_string('temail', 'local_trainer'));
        $mform->setType('temail', PARAM_TEXT);
        $mform->addRule('temail', 'Missing Email', 'required', null, 'server');

        //Trainer Domain
        $mform->addElement('text', 'address', 'Domain or Expertise');
        $mform->setType('address', PARAM_RAW);
        
        //Trainer Mobile.
        $mform->addElement('text', 'tmobile', get_string('tmobile', 'local_trainer'));
        $mform->setType('tmobile', PARAM_TEXT);
        $mform->addRule('tmobile', 'Missing Mobile Number', 'required', null, 'server');
        
        //password
        $mform->addElement('passwordunmask', 'tpassword', get_string('tpassword', 'local_trainer'));
        if(empty($id)){
         $mform->addRule('tpassword', 'Missing Password', 'required', null, 'server'); 
     }

        //Select the center.
     if(!is_siteadmin()){
        $companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
        $companies = $DB->get_records('company',array('suspended'=>0,'id'=>$companyid));
    }else{
        $companies = $DB->get_records('company',array('suspended'=>0));
    }

    $comparray = array();
    $comparray[''] = get_string('selectcentre', 'local_trainer');
    foreach($companies as $company){
        $comparray[$company->id] = $company->name;
    }

    $mform->addElement('select', 'institution', 'Center Name', $comparray);
    $mform->addRule('institution', 'Missing Center', 'required', null, 'server');

        //select the status.
    $status = array('Select Status','In-Active','Active');
    $mform->addElement('select', 'status', 'Status', $status);
    $mform->addRule('status', 'Missing Status', 'required', null, 'server');

    //Joining Date.
    $mform->addElement('date_selector', 'joiningdate', 'Joining date');

    //InActivation date.
    $mform->addElement('date_selector', 'inactivation', 'InActivation date');

    //Working Days.
    $days = array('1'=>"Monday",'2'=>"Tuesday",'3'=>"Wednessday",'4'=>"Thursday",'5'=>"Friday",'6'=>"Saturday",'7'=>"Sunday");
    $select = $mform->addElement('select', 'days', 'Select Working Days', $days);
    $select->setMultiple(true);

        //Select Working Time.
                //Manju: Starts

    for ($i = 0; $i <= 23; $i++) {
        $hours[$i] = sprintf("%02d", $i);
    }
    for ($i = 0; $i < 60; $i += 5) {
        $minutes[$i] = sprintf("%02d", $i);
    }
    
    $sesendtime = array();
    if (!right_to_left()) {
        $sesendtime[] =& $mform->createElement('static', 'from', '', get_string('from', 'attendance'));
        $sesendtime[] =& $mform->createElement('select', 'starthour', get_string('hour', 'form'), $hours, false, true);
        $sesendtime[] =& $mform->createElement('select', 'startminute', get_string('minute', 'form'), $minutes, false, true);
        $sesendtime[] =& $mform->createElement('static', 'to', '', get_string('to', 'attendance'));
        $sesendtime[] =& $mform->createElement('select', 'endhour', get_string('hour', 'form'), $hours, false, true);
        $sesendtime[] =& $mform->createElement('select', 'endminute', get_string('minute', 'form'), $minutes, false, true);
    } else {
        $sesendtime[] =& $mform->createElement('static', 'from', '', get_string('from', 'attendance'));
        $sesendtime[] =& $mform->createElement('select', 'startminute', get_string('minute', 'form'), $minutes, false, true);
        $sesendtime[] =& $mform->createElement('select', 'starthour', get_string('hour', 'form'), $hours, false, true);
        $sesendtime[] =& $mform->createElement('static', 'to', '', get_string('to', 'attendance'));
        $sesendtime[] =& $mform->createElement('select', 'endminute', get_string('minute', 'form'), $minutes, false, true);
        $sesendtime[] =& $mform->createElement('select', 'endhour', get_string('hour', 'form'), $hours, false, true);
    }
    $mform->addGroup($sesendtime, 'sestime', 'Working Time', array(' '), true);

        //Shared Across All Centers.
    $mform->addElement('checkbox', 'share', 'Shared Across All Centers');

    $mform->addElement('submit', 'submit', get_string('submit', 'local_trainer'));
} 

function validation($data, $files) {
    global $DB;
    $errors = [];
    if(!empty($data['temail']) && empty($data['id'])){
        $email = $data['temail'];

        $check = $DB->get_records('user',array('email'=>$email));

        if(!empty($check)){
            $errors['temail'] = "Email is already Exists!";
        }
    }
    return $errors;
}  

}