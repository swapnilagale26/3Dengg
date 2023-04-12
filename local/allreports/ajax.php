<?php
require_once('../../config.php');
global $DB;
$center = optional_param('center','',PARAM_INT);
$tcenter = optional_param('tcenter','',PARAM_INT);

if(!empty($center)){
	// $cohort = $DB->get_record('company', array('id'=>$center), '*', MUST_EXIST);
	// $context =  context_coursecat::instance($cohort->category);
	$labs = $DB->get_records('local_batch',array('center_name'=>$center));
	$option ="";
	if(!empty($labs)){
		foreach ($labs as $lab) {
			$option.='<option value="'.$lab->id.'">'.$lab->batch_code.'</option>';
		}
	}
	echo $option;
}

if(!empty($tcenter)){
	$option ="";
	$trainers = $DB->get_records_sql("SELECT DISTINCT(tm.id) as tid, u.* from {user} AS u 
		JOIN {role_assignments} AS ra ON ra.userid = u.id 
		JOIN {trainer_module} AS tm ON tm.userid = u.id 
		WHERE ra.roleid = 16 AND u.deleted = 0 AND tm.center = $tcenter OR tm.share = 1");
	$option.='<option>Select Trainer</option>';
	if(!empty($trainers)){
		foreach($trainers as $trainer){
			$option.='<option value="'.$trainer->id.'">'.$trainer->username.'</option>';
		} 
	}

	$cohort = $DB->get_record('company', array('id'=>$tcenter), '*', MUST_EXIST);
	$context =  context_coursecat::instance($cohort->category);
	$labs = $DB->get_records("cohort",array('visible'=>1,'contextid'=>$context->id));
	$option1 ="";
	$option1.='<option>Select Lab</option>';
	if(!empty($labs)){
		foreach ($labs as $lab) {
			$option1.='<option value="'.$lab->id.'">'.$lab->name.'</option>';
		}
	}
	$data = array();

	$data['first'] = $option;

	$data['second'] = $option1;

	echo json_encode($data);
}