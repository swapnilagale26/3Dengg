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
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class local_student_form extends moodleform
{
	public function definition()
	{
		global $CFG,$OUTPUT,$DB,$USER,$PAGE,$_SESSION;
		$context = context_system::instance();
		$id = optional_param('id','',PARAM_INT);
		$_SESSION['bid'] = $id;
		$mform = $this->_form;

		$mform->addElement('hidden', 'id', $id);
		$mform->setType('id', PARAM_INT);

		$batch_choices = array();	
		if(!empty($id)){
			$batch = $DB->get_record('local_batch',array('id'=>$id));
			$batch_choices[$batch->id] = $batch->batch_code;
		}else{
			$batch_choices[0] = get_string('select_batch','local_batch');
			$batches = $DB->get_records('local_batch');
			foreach($batches as $row){
				$batch_choices[$row->id] = $row->batch_code;
			}
		}


		$mform->addElement('select','batch',get_string('batch','local_batch'),$batch_choices);
		$mform->settype('batch', PARAM_RAW);

		$mform->addElement('html', '<div id="selectedcount"></div>');

		$student_choices = array();
		$student_choices[0] = get_string('select_student','local_batch');

		if(!empty($id)){
			//Current batch record.
			$batch = $DB->get_record('local_batch',array('id'=>$id));
			$batchusers = $DB->get_record('batch_student_details',array('batch_id'=>$id));
			$explodeusers = explode(",",$batchusers->user_id);

			//create batch startdate and enddate.
			$batchstartdate = $batch->start_date;
			$batchenddate = $batch->end_date;
			$batchtimings = explode(",", $batch->timings);
			
			//Get all trainers.
			$trainers = $DB->get_records("trainer_module", array(),'', 'userid');
			$trainerarray = array();
			if(!empty($trainers)){
			    foreach($trainers as $trainer){
			        $trainerarray[] = $trainer->userid; 
			    }
			}
			$trainerimplode = implode(",",$trainerarray);

			//Get all the users from the current center.
			$center = $batch->center_name;
			
			$user_sql = "SELECT u.* FROM {user} AS u 
			JOIN {company_users} AS cu ON cu.userid = u.id 
			WHERE cu.companyid = $center AND u.deleted = 0 AND cu.managertype = 0 AND u.id NOT IN($trainerimplode)";
			$users = $DB->get_records_sql($user_sql);

			if(!empty($users)){
				foreach($users as $row){
					if(in_array($row->id, $explodeusers)){
						$student_choices[$row->id] = fullname($row).' -('.$row->email.')';
					}else{
						$userid = ",".$row->id;
						$userid2 = $row->id.",";
					//checking wether user is part of any other batch.
						$check = $DB->get_records_sql("SELECT * FROM {batch_student_details} WHERE user_id LIKE '%$userid%' OR user_id LIKE '%$userid2%'");
					//If he is part of any other batch check the timings.
						if(!empty($check)){

							$temp = array();

							foreach ($check as $scheck) {
							//Get the details of other batch where the current user is participant to check the date.
								$matchbatch = $DB->get_record('local_batch',array('id'=>$scheck->batch_id));

								if(!empty($matchbatch)){
									if($matchbatch->start_date >= $batchstartdate && $matchbatch->start_date <= $batchenddate){
										$temp[$row->id] = $row->id;
									//Do nothing.
									}
									if ($matchbatch->end_date >= $batchstartdate && $matchbatch->end_date <= $batchenddate) {
										$temp[$row->id] = $row->id;
									//Do nothing.
									}
								}
							}

							if(!array_key_exists($row->id, $temp)){
								$student_choices[$row->id] = fullname($row).' -('.$row->email.')';
							}

						}else{
						//If he is not part of any other batch then add him to the array.
							$student_choices[$row->id] = fullname($row).' -('.$row->email.')';

						}
					}
				}
			}
		}

		$options = array('multiple' => true,'noselectionstring' => "",'onchange'=>"countFunction();");  
		$mform->addElement('autocomplete','student',get_string('student','local_batch'),$student_choices,$options);

		$mform->settype('student', PARAM_RAW);

		$mform->addElement('hidden','editid');
		$mform->settype('editid', PARAM_INT);

		$mform->addElement('hidden','created_on');
		$mform->settype('created_on', PARAM_INT);

		//action buttons start here//
		$buttonarray = array();
		$buttonarray[] = $mform->createElement('submit','submitbutton',get_string('savebutton','local_batch'));
		$buttonarray[] = $mform->createElement('cancel');

		$mform->addGroup($buttonarray,'buttonarray','','',false);
		//action buttons end here//
	}

	public function validation($data,$files)
	{	
		global $DB;
		$errors = [];
		if(!empty($data['batch'])){
			$batchcap = $DB->get_field('local_batch','batch_capacity',array('id'=>$data['batch']));
			if(count($data['student']) > $batchcap){
				$errors['student'] = "Exceeded the Batch Capacity";
			}
		}
		return $errors;
	}
}
