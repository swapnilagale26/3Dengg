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
 * @license    
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');

global $CFG,$OUTPUT,$DB;

class local_batch_form extends moodleform
{
	public function definition()
	{
		global $CFG,$OUTPUT,$DB,$USER,$PAGE;
		require_once($CFG->dirroot . '/local/iomad/lib/company.php');
		$cid = iomad::get_my_companyid(context_system::instance(), false);
		$context = context_system::instance();
		$mform = $this->_form;
		$id = optional_param('id','',PARAM_INT);
		$batchid = optional_param('batch_id','',PARAM_INT);
		$mform->addElement('hidden', 'id', $id);
		$mform->settype('id', PARAM_INT);

		if($batchid){
			$batchobject = $DB->get_record('local_batch',array('id'=>$batchid));
		}

		//1. Centers.[center_name]
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

		if($batchobject->status == 2 || $batchobject->status == 3){

			$companyid = $DB->get_field('local_batch','center_name',array('id'=>$batchid));
			$companies = $DB->get_record('company',array('suspended'=>0,'id'=>$companyid));

			$companyrray = array();
			$companyrray[$companyid] =  $companies->name;
			$mform->addElement('select', 'center_name', 'Center Name', $companyrray,array('onChange'=>'SelectCenter();'));
			$mform->addRule('center_name', 'Missing Center', 'required', null, 'server');
			
		}else{
			$mform->addElement('select', 'center_name', 'Center Name', $comparray,array('onChange'=>'SelectCenter();'));
			$mform->addRule('center_name', 'Missing Center', 'required', null, 'server');
		}

		//2. start date.
		$mform->addElement('date_selector','start_date',get_string('start_date','local_batch'));
		$mform->settype('start_date', PARAM_RAW);
		$mform->addRule('start_date',null,'required',null,'client');

		//3. end date.
		$mform->addElement('date_selector','end_date',get_string('end_date','local_batch'));
		$mform->settype('end_date', PARAM_RAW);
		$mform->addRule('end_date',null,'required',null,'client');

		//4. select lab.[lab]
		if(!is_siteadmin()){
			if($batchobject->status == 2 || $batchobject->status == 3){
				$labid = $DB->get_field('local_batch','lab',array('id'=>$batchid));
				$labs = $DB->get_records("cohort",array('visible'=>1,'id'=>$labid));
			}else{
				$companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
				$cohort = $DB->get_record('company', array('id'=>$companyid), '*', MUST_EXIST);
				$context =  context_coursecat::instance($cohort->category);
				$labs = $DB->get_records("cohort",array('visible'=>1,'contextid'=>$context->id));
			}
		}else{
			if($batchobject->status == 2 || $batchobject->status == 3){
				$labid = $DB->get_field('local_batch','lab',array('id'=>$batchid));
				$labs = $DB->get_records("cohort",array('visible'=>1,'id'=>$labid));
			}else{
				$labs = $DB->get_records("cohort",array('visible'=>1));
			}
		}

		$laboption = array();

		foreach ($labs as $slab) { 
			$laboption[$slab->id] = $slab->name;
		}
		$laboption[' '] = " Select Lab";
		asort($laboption);

		$mform->addElement('select', 'lab', 'Lab', $laboption,array('onChange'=>'SelectBatch();'));
		$mform->addRule('lab', 'Missing Lab', 'required', null, 'server');

		$mform->addElement('html', '<div class="text-right" style="cursor: pointer;"><p onclick="refreshPage();" ><b>Click Here to Refresh</b></p></div> ');

		//div for lab availibility.
		$mform->addElement('html', '<div id="labavailibility" class="text-center bg-light p-2" style="max-height: 300px;overflow-y: auto;"></div>');

		//Get all trainers.
		$user_array = [];
		$user_array2 = [];
		if($batchobject->status == 2 || $batchobject->status == 3){
			$trainer1id = $batchobject->trainer1;
			$trainer2id = $batchobject->trainer2;
			$trainers = $DB->get_records_sql("SELECT * FROM {trainer_module} WHERE userid = $trainer1id");
			if(!empty($trainer2id)){
				$trainers2 = $DB->get_records_sql("SELECT * FROM {trainer_module} WHERE userid = $trainer2id");
			}
			
		}else{
			$trainers = $DB->get_records_sql("SELECT * FROM {trainer_module} WHERE center = $cid OR share = 1");
			$trainers2 = $DB->get_records_sql("SELECT * FROM {trainer_module} WHERE center = $cid OR share = 1");
			$user_array[0] = "Select Trainer";
		}
		

		if(!empty($trainers)){
			foreach($trainers as $trainer){
				$obj = core_user::get_user($trainer->userid);
				$user_array[$obj->id] = $obj->username;
			} 
		}

		if(!empty($trainers2)){
			foreach($trainers2 as $trainerr){
				$obj = core_user::get_user($trainerr->userid);
				$user_array2[$obj->id] = $obj->username;
			} 
		}



		$mform->addElement('select','trainer1',get_string('select_trainer1','local_batch'),$user_array,array('onChange'=>'SelectTrainer1();'));
		$mform->settype('trainer1', PARAM_RAW);

		//div for lab availibility.
		$mform->addElement('html', '<div id="trainer1availibility" class="text-center bg-light p-2" style="max-height: 300px;overflow-y: auto;"></div>');
		
		if($batchobject->status == 2 || $batchobject->status == 3){
			$mform->addElement('select','trainer2',get_string('select_trainer2','local_batch'),$user_array2,array('onChange'=>'SelectTrainer2();'));
			$mform->settype('trainer2', PARAM_RAW);
		}else{
			$mform->addElement('select','trainer2',get_string('select_trainer2','local_batch'),$user_array,array('onChange'=>'SelectTrainer2();'));
			$mform->settype('trainer2', PARAM_RAW);
		}
		

		//div for lab availibility.
		$mform->addElement('html', '<div id="trainer2availibility" class="text-center bg-light p-2" style="max-height: 300px;overflow-y: auto;"></div>');
		
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
		$mform->addGroup($sesendtime, 'sestime', get_string('batchtimings', 'local_batch'), array(' '), true);

		//3. Batch Code [batch_code]
		$mform->addElement('text','batch_code',get_string('batch_code','local_batch'));
		$mform->settype('batch_code', PARAM_RAW);
		$mform->addRule('batch_code',null,'required',null,'client');

		$mform->addElement('editor', 'description', get_string('description', 'local_batch'));
		$mform->setType('description', PARAM_RAW);

		$status_array = array(get_string('select_status','local_batch'),
			get_string('yettostart','local_batch'),
			get_string('progress','local_batch'),
			get_string('completed','local_batch'));
		$mform->addElement('select','status','Status',$status_array);
		$mform->addRule('status', get_string('required'), 'required', null, 'client');
		$mform->settype('status', PARAM_RAW);

		//Select the Course.
		if(!is_siteadmin()){
			$companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
			$coursesql ="SELECT c.* FROM {course} AS c
			JOIN {company_course} AS cc ON cc.courseid = c.id WHERE c.visible = 1 AND c.id != 1 AND cc.companyid =$companyid ORDER BY c.fullname ASC";
		}else{
			$coursesql = 'SELECT * FROM {course} WHERE visible = 1 AND id !=1';
		}

		$allcoursename = $DB->get_records_sql($coursesql);
		$courses = array();
		$courses[' '] = get_string('selectcourse','local_trainer');                                                       
		foreach ($allcoursename as $coursename) { 
			$courses[$coursename->id] = $coursename->fullname;
		}                                                         
		$options = array('multiple' => false,'noselectionstring' => get_string('selectcourse', 'local_trainer'));         
		$mform->addElement('autocomplete', 'course_name', get_string('selectcourse', 'local_trainer'), $courses, $options);
		//$mform->addRule('course_name', get_string('required'), 'required', null, 'client');
		
		$mform->addElement('text','batch_capacity',get_string('batch_capacity','local_batch'));
		$mform->settype('batch_capacity', PARAM_RAW);
		$mform->addRule('batch_capacity',null,'required',null,'client');

		$choices = array(get_string('select_type','local_batch'),
			get_string('stp','local_batch'),
			get_string('sttp','local_batch'),
			get_string('fdp','local_batch'));	
		$mform->addElement('select','batch_type',get_string('batch_type','local_batch'),$choices);
		$mform->settype('batch_type', PARAM_RAW);


		$choices1 = array();	
		$choices1[0] = get_string('select_sem','local_batch');
		$choices1[get_string('one','local_batch')] = get_string('one','local_batch');
		$choices1[get_string('two','local_batch')] = get_string('two','local_batch');
		$choices1[get_string('three','local_batch')] = get_string('three','local_batch');
		$choices1[get_string('four','local_batch')] = get_string('four','local_batch');
		$choices1[get_string('five','local_batch')] = get_string('five','local_batch');
		$choices1[get_string('six','local_batch')] = get_string('six','local_batch');
		$choices1[get_string('seven','local_batch')] = get_string('seven','local_batch');
		$choices1[get_string('eight','local_batch')] = get_string('eight','local_batch');
		$mform->addElement('select','semester',get_string('semester','local_batch'),$choices1);
		$mform->settype('semester', PARAM_RAW);

		//Additional Details
		$mform->addElement('text','additional_details',get_string('additional_details','local_batch'));
		$mform->settype('additional_details', PARAM_RAW);

		//action buttons start here//
		$buttonarray = array();
		$buttonarray[] = $mform->createElement('submit','submitbutton',get_string('savebutton','local_batch'));
		$buttonarray[] = $mform->createElement('cancel');

		$mform->addGroup($buttonarray,'buttonarray','','',false);
		//action buttons end here//
	}

	function validation($data, $files) {
		global $DB;
		$errors = [];

		if(empty($data['id'])){

			if(!empty($data['trainer1'])){
				$trainer1 = $data['trainer1'];
				$center = $data['center_name'];
				$lab = $data['lab'];
				//get all the batches of trainer 1.
				$allbatches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE trainer1 = $trainer1 OR trainer2 = $trainer1");
				$temparray = array();
				if(!empty($allbatches)){
					foreach ($allbatches as $singlebatch) {
						$startdate = $data['start_date'];
						$enddate = $data['end_date'];
						$currenttime = $data['sestime'];
						if($startdate >= $singlebatch->start_date && $startdate <= $singlebatch->end_date){
							$errors['trainer1'] = "Trainer is not available";
							$timeslots = explode(",", $singlebatch->timings);
							if($currenttime['starthour'] >= $timeslots[0] && $currenttime['starthour'] <= $timeslots[2]){
								$errors['trainer1'] = "Trainer is not available";

							}
							if($currenttime['endhour'] >= $timeslots[0] && $currenttime['endhour'] <= $timeslots[2]){
								$errors['trainer1'] = "Trainer is not available";

							}

						}elseif ($enddate >= $singlebatch->start_date && $enddate <= $singlebatch->end_date) {
							$errors['trainer1'] = "Trainer is not available";
							$timeslots = explode(",", $singlebatch->timings);
							if($currenttime['starthour'] >= $timeslots[0] && $currenttime['starthour'] <= $timeslots[2]){
								$errors['trainer1'] = "Trainer is not available";

							}
							if($currenttime['endhour'] >= $timeslots[0] && $currenttime['endhour'] <= $timeslots[2]){
								$errors['trainer1'] = "Trainer is not available";
							}
						}
					}
				}
			}
			if(!empty($data['trainer2'])){
				$trainer1 = $data['trainer2'];
				$center = $data['center_name'];
				$lab = $data['lab'];
				//get all the batches of trainer 1.
				$allbatches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE trainer1 = $trainer1 OR trainer2 = $trainer1");
				$temparray = array();
				if(!empty($allbatches)){
					foreach ($allbatches as $singlebatch) {
						$startdate = $data['start_date'];
						$enddate = $data['end_date'];
						$currenttime = $data['sestime'];
						if($startdate > $singlebatch->start_date && $startdate < $singlebatch->end_date){
							$timeslots = explode(",", $singlebatch->timings);
							if($currenttime['starthour'] > $timeslots[0] && $currenttime['starthour'] < $timeslots[2]){
								$errors['trainer2'] = "Trainer is not available";

							}
							if($currenttime['endhour'] > $timeslots[0] && $currenttime['endhour'] < $timeslots[2]){
								$errors['trainer2'] = "Trainer is not available";

							}

						}elseif ($enddate > $singlebatch->start_date && $enddate < $singlebatch->end_date) {
							$timeslots = explode(",", $singlebatch->timings);
							if($currenttime['starthour'] > $timeslots[0] && $currenttime['starthour'] < $timeslots[2]){
								$errors['trainer2'] = "Trainer is not available";

							}
							if($currenttime['endhour'] > $timeslots[0] && $currenttime['endhour'] < $timeslots[2]){
								$errors['trainer2'] = "Trainer is not available";
							}
						}
					}
				}
			}
			if(empty($data['course_name'])){
				$errors['course_name'] = "Please Select Course";
			}
		}
		return $errors;
	}

	public function definition_after_data() {
		global $CFG, $DB;
		require_once($CFG->dirroot . '/local/iomad/lib/company.php');
		$mform = $this->_form;
		$cid = iomad::get_my_companyid(context_system::instance(), false);
		$batchid = optional_param('batch_id','',PARAM_INT);
		$batch = $DB->get_record('local_batch',array('id'=>$batchid));
		//batch status.
		//1. Yet to start, 2. In-Progress, 3. Completed.
		if($batch->status == 1){

		}elseif ($batch->status == 2) {
			//$mform->hardFreeze('center_name');
			// $mform->hardFreeze('lab');
			//$mform->hardFreeze('batch_code');
			// $mform->hardFreeze('description');
			// $mform->hardFreeze('course_name');
			// $mform->hardFreeze('batch_capacity');
			// $mform->hardFreeze('start_date');
			$mform->hardFreeze('batch_type');
			$mform->hardFreeze('semester');
			$mform->hardFreeze('additional_details');
			// $mform->hardFreeze('sestime');
			// $mform->hardFreeze('trainer1');
			// $mform->hardFreeze('trainer2');

		}elseif ($batch->status == 3) {
			//$mform->hardFreeze('center_name');
			// $mform->hardFreeze('lab');
			//$mform->hardFreeze('batch_code');
			// $mform->hardFreeze('description');
			// $mform->hardFreeze('course_name');
			// $mform->hardFreeze('batch_capacity');
			// $mform->hardFreeze('start_date');
			// $mform->hardFreeze('end_date');
			$mform->hardFreeze('batch_type');
			$mform->hardFreeze('semester');
			$mform->hardFreeze('additional_details');
			// $mform->hardFreeze('sestime');
			// $mform->hardFreeze('trainer1');
			// $mform->hardFreeze('trainer2');
		}
		profile_definition_after_data($mform, $userid); 
	}
}

