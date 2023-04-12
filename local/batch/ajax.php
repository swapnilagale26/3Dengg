<?php
require_once('../../config.php');
require_once('lib.php');
global $DB;
$center = optional_param('center','',PARAM_INT);
$start = optional_param('start','',PARAM_RAW);
$end = optional_param('end','',PARAM_RAW);
$batch = optional_param('batch','',PARAM_RAW);
$lab = optional_param('lab','',PARAM_RAW);
$bcenter = optional_param('bcenter','',PARAM_RAW);
$trainer1 = optional_param('trainer1','',PARAM_RAW);
$trainer2 = optional_param('trainer2','',PARAM_RAW);
$selectedtrainer = optional_param('selectedtrainer','',PARAM_RAW);

if(!empty($selectedtrainer)){
	$tcenter = $DB->get_field('trainer_module','center',array('userid'=>$selectedtrainer));
	$trainers = $DB->get_records_sql("SELECT * FROM {trainer_module} WHERE userid != $selectedtrainer AND center = $tcenter ");
	$option="";
	$option.='<option value=" ">Select Trainer</option>';
	if(!empty($trainers)){
		foreach($trainers as $trainer){
			$obj = core_user::get_user($trainer->userid);
			$option.='<option value="'.$obj->id.'">'.$obj->username.'</option>';
		} 
	}
	echo $option;
}



if(!empty($center)){
	$cohort = $DB->get_record('company', array('id'=>$center), '*', MUST_EXIST);
	$context =  context_coursecat::instance($cohort->category);
	$contextid = $context->id;
	$labs = $DB->get_records_sql("SELECT * FROM {cohort} WHERE visible = 1 AND contextid = $contextid ORDER BY name ASC");
	$option ="";
	$option.='<option value=" ">Select Lab</option>';
	if(!empty($labs)){
		foreach ($labs as $lab) {
			$option.='<option value="'.$lab->id.'">'.$lab->name.'</option>';
		}
	}
	echo $option;
}

if(!empty($start) && !empty($end) && !empty($batch)){
	$timestamp1 = strtotime($start);
	$timestamp2 = strtotime($end);
	$option="";
	$batch = $DB->get_record('local_batch',array('id'=>$batch));
	$batchusers = $DB->get_record('batch_student_details',array('batch_id'=>$id));
	$explodeusers = explode(",",$batchusers->user_id);

	$batchid = $batch->id;
	$center = $batch->center_name;
	$user_sql = "SELECT u.* FROM {user} AS u 
	JOIN {company_users} AS cu ON cu.userid = u.id 
	JOIN {role_assignments} AS ra ON ra.userid = u.id 
	WHERE cu.companyid = $center AND u.timecreated BETWEEN $timestamp1 AND $timestamp2 AND ra.roleid NOT IN (1,2,3,4,6,7,8,9,10,11,12,13,14,15,16) AND u.deleted =0";

	$users = $DB->get_records_sql($user_sql);
	$temp = [];

	foreach($users as $row){
		if(in_array($row->id, $explodeusers)){
			$option.='<option value="'.$row->id.'">'.fullname($row).' -('.$row->email.')</option>';
		}else{
				//check for other batches for participants.
			$userid = ",".$row->id;
			$userid2 = $row->id.",";
			$check = $DB->get_records_sql("SELECT * FROM {batch_student_details} WHERE user_id LIKE '%$userid%' OR user_id LIKE '%$userid2%' AND batch_id != $batchid");

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
					$option.='<option value="'.$row->id.'">'.fullname($row).' -('.$row->email.')</option>';
				}
			}else{
			//If he is not part of any other batch then add him to the array.
				$option.='<option value="'.$row->id.'">'.fullname($row).' -('.$row->email.')</option>';
			}

		}
	}
	echo $option;

}

if(!empty($bcenter)){
	//get all the courses for the respective center.
	$sql="";
	$sql.="SELECT c.* FROM {course} AS c JOIN {company_course} AS cc ON cc.courseid = c.id WHERE companyid = $bcenter";
	$courses = $DB->get_records_sql($sql);
	$option="";
	if(!empty($courses)){
		foreach ($courses as $course) {
			$option.='<option value="'.$course->id.'">'.$course->fullname.'</option>';
		}
	}
	//get the available slots of selected lab.
	$labobject = lab_availibility_timings($lab,$start,$end);

	$data = array();

	$data['first'] = $option;

	$data['second'] = $labobject;

	echo json_encode($data);
}

if(!empty($trainer1) || !empty($trainer2)){

	$html="";

	if(!empty($trainer1)){
		$trainerobject = $DB->get_record('trainer_module',array('userid'=>$trainer1));
		$html.="<h4>Trainer1 Available Timings : </h4>";
	}
	if(!empty($trainer2)){
		$trainerobject = $DB->get_record('trainer_module',array('userid'=>$trainer2));
		$html.="<h4>Trainer2 Available Timings : </h4>";
	}

	$workingtime = explode(",", $trainerobject->workingtime);

	
	
	$html.="<table class='table text-center'><tr class='text-center'>";
	$html.="<th>Date</th>";

	$temparray = array();

	$pmtime = array('13'=>'1 PM','14'=>'2 PM','15'=>'3 PM','16'=>'4 PM','17'=>'5 PM','18'=>'6 PM','19'=>'7 PM','20'=>'8 PM','21'=>'9 PM','12'=>'10 PM');

	while($workingtime[0] <= $workingtime[2]){
		if($workingtime[0] <= 12){
			$html.="<th class='bg-info text-white'>".$workingtime[0]." AM</th>";
		}else{
			$html.="<th class='bg-info text-white'>".$pmtime[$workingtime[0]]." </th>";
		}
		// $html.="<th class='bg-info text-white'>".$workingtime[0]."</th>";
		$temparray[$workingtime[0]] = $workingtime[0];
		$workingtime[0]++;
	}

	$html.="</tr>";
	//$temparray having the working hours of the selected trainer.
	while($start <= $end){
		if(date('D', $start) == "Sat" || date('D', $start) == "Sun"){
			$start = $start + 86400;
		}else{
			$normalstartdate = date('d-m-Y',$start);
			$html.="<tr>";
			$html.="<td>".$normalstartdate."</td>";
			//Get all the batches timings where this user is trainer.

			if(!empty($trainer1)){
				$innerbatches = $DB->get_records_sql("SELECT timings FROM {local_batch} WHERE start_date <= $start AND end_date >= $start AND trainer1 = $trainer1");
			}
			if(!empty($trainer2)){
				$innerbatches = $DB->get_records_sql("SELECT timings FROM {local_batch} WHERE start_date <= $start AND end_date >= $start AND trainer1 = $trainer2");
			}

			//OR trainer2 = $trainer1
			if(!empty($innerbatches)){
				$availabletiming = array();
				foreach ($innerbatches as $inbatch => $intime) {
					$intimeexplode = explode(",", $intime->timings);
					while($intimeexplode[0] <= $intimeexplode[2]){
						if(array_key_exists($intimeexplode[0],$temparray)){
							$availabletiming[$intimeexplode[0]] = $intimeexplode[0];
						}
						$intimeexplode[0]++;
					}
				}
				foreach ($temparray as $tkey => $tvalue) {
					if(array_key_exists($tkey,$availabletiming)){
						$html.="<td><div style='padding:13px; background-color: #ffdf7e;'></div></td>";
					}else{
						$html.="<td><div style='padding:13px; background-color: #90EE90;'></div></td>";
					}
				}
			}else{
				$workingtime = explode(",", $trainerobject->workingtime);
				while($workingtime[0] <= $workingtime[2]){
					$html.="<td><div style='padding:13px; background-color: #90EE90;'></div></td>";
					$workingtime[0]++;
				}
			}
			$html.="</tr>";
			$start = $start + 86400;
		}
	}
	$html.="</table>";
	echo $html;
}
