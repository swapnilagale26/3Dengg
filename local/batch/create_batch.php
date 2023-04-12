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
require_once('../../config.php');
require_once('lib.php');
require_once($CFG->libdir . '/formslib.php');
require_once('form/batch_form.php');
require_once($CFG->dirroot.'/enrol/locallib.php');
require_once($CFG->dirroot.'/group/lib.php');
require_once($CFG->dirroot.'/enrol/manual/locallib.php');
require_once($CFG->dirroot.'/cohort/lib.php');
require_once($CFG->dirroot . '/enrol/manual/classes/enrol_users_form.php');
global $DB,$PAGE;
require_login();
$batchid = optional_param('batch_id','',PARAM_INT);
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
if(!empty($batchid)){
  $PAGE->set_url($CFG->wwwroot . '/local/batch/create_batch.php?batch_id='.$batchid);  
}else{
    $PAGE->set_url($CFG->wwwroot . '/local/batch/create_batch.php');  
}

$title = get_string('pluginname', 'local_batch');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/custom.js'), true);
if(!empty($batchid)){
    $mform = new local_batch_form($CFG->wwwroot.'/local/batch/create_batch.php',array('id'=>$batchid));
}else{
    $mform  =  new local_batch_form();
}
$returnurl = new moodle_url('/local/batch/index.php');

if($mform->is_cancelled()){
  redirect($returnurl);
}elseif($data = $mform->get_data()){
    
    if(!empty($data)){
        if(empty($data->id)){
          $insert = new stdClass();
          $insert->center_name = $data->center_name;
          $insert->batch_code = $data->batch_code;
          $insert->description = $data->description['text'];
          $insert->status = $data->status;
          $insert->status_reason = $data->additional_details;
          $insert->course_name    = $data->course_name;
          $insert->batch_capacity = $data->batch_capacity;
          $insert->start_date = $data->start_date;
          $insert->end_date = $data->end_date;
          $insert->batch_type = $data->batch_type;
          $insert->semester = $data->semester;
          $insert->trainer1 = $data->trainer1;
          $insert->trainer2 = $data->trainer2;
          $insert->lab = $data->lab;
          $insert->timecreated = time();
          $insert->timings = implode(",",$data->sestime);

          if(!empty($data->trainer1)){
            cohort_add_member($data->lab, $data->trainer1);
        }
        if(!empty($data->trainer2)){
            cohort_add_member($data->lab, $data->trainer1);
        }

        $insert_datas = $DB->insert_record('local_batch',$insert);

        $course = $DB->get_record('course',array('id'=>$data->course_name));
        $manager = new course_enrolment_manager($PAGE, $course);
        $instance = $DB->get_record('enrol', array('enrol' => 'manual', 'courseid' => $data->course_name));
        $plugins = $manager->get_enrolment_plugins(true);
        $plugin = $plugins['manual'];

        if($data->start_date == $data->end_date){

            $starttime = $data->sestime['starthour'] * 60 * 60;
            $starttime = $starttime + $data->sestime['startminute'] * 60;
            $data->start_date = $data->start_date + $starttime;

            $endtime = $data->sestime['endhour'] * 60 * 60;
            $endtime = $endtime + $data->sestime['endminute'] * 60;
            $data->end_date = $data->end_date + $endtime;
        }

        $plugin->enrol_cohort($instance, $data->lab, 5, $data->start_date, $data->end_date, null,null);

        $plugin->enrol_user($instance, $data->trainer1, 3, $data->start_date, $data->end_date, null,null);

        if(!empty($data->trainer2)){
            $plugin->enrol_user($instance, $data->trainer2, 3, $data->start_date, $data->end_date, null,null);
        }

        redirect($CFG->wwwroot.'/local/batch/index.php?batch_id='.$batchid,"Batch Created Successfully");
    }else{
      $update = new stdClass();
      $update->id = $data->id;
      $update->center_name = $data->center_name;
      $update->batch_code = $data->batch_code;
      $update->description = $data->description['text'];
      $update->status = $data->status;
      $update->status_reason = $data->additional_details;
      $update->course_name    = $data->course_name;
      $update->batch_capacity = $data->batch_capacity;
      $update->start_date = $data->start_date;
      $update->end_date = $data->end_date;
      $update->batch_type = $data->batch_type;
      $update->semester = $data->semester;
      $update->trainer1 = $data->trainer1;
      $update->trainer2 = $data->trainer2;
      $update->lab = $data->lab;
      $update->timings = implode(",",$data->sestime);
       //print_object($update);die;
      if(!empty($data->trainer1)){
        cohort_add_member($data->lab, $data->trainer1);
    }
    if(!empty($data->trainer2)){
        cohort_add_member($data->lab, $data->trainer2);
    }

    $course = $DB->get_record('course',array('id'=>$data->course_name));
    $manager = new course_enrolment_manager($PAGE, $course);
    $instance = $DB->get_record('enrol', array('enrol' => 'manual', 'courseid' => $data->course_name));
    $plugins = $manager->get_enrolment_plugins(true);
    $plugin = $plugins['manual'];
    if($data->start_date == $data->end_date){

        $starttime = $data->sestime['starthour'] * 60 * 60;
        $starttime = $starttime + $data->sestime['startminute'] * 60;
        $data->start_date = $data->start_date + $starttime;

        $endtime = $data->sestime['endhour'] * 60 * 60;
        $endtime = $endtime + $data->sestime['endminute'] * 60;
        $data->end_date = $data->end_date + $endtime;
    }

    // $plugin->enrol_cohort($instance, $data->lab, 5, $data->start_date, $data->end_date, null,null);

    $plugin->enrol_user($instance, $data->trainer1, 3, $data->start_date, $data->end_date, null,null);

    if(!empty($data->trainer2)){
        $plugin->enrol_user($instance, $data->trainer2, 3, $data->start_date, $data->end_date, null,null);
    }

    $update_datas = $DB->update_record('local_batch',$update);
    redirect($CFG->wwwroot.'/local/batch/index.php?id='.$batchid,"Batch Updated Successfully");
}
}
}else{
    if(!empty($batchid)){

        $set = new stdClass();
        $rec = $DB->get_record('local_batch',array('id'=>$batchid));
        $timings = explode(",",$rec->timings);

        $set->id = $batchid;
        $set->center_name = $rec->center_name;
        $set->batch_code = $rec->batch_code;
        $set->description['text'] = $rec->description;
        $set->status = $rec->status;
        $set->additional_details = $rec->status_reason;
        $set->course_name    = $rec->course_name;
        $set->batch_capacity = $rec->batch_capacity;
        $set->start_date = $rec->start_date;
        $set->end_date = $rec->end_date;
        $set->batch_type = $rec->batch_type;
        $set->semester = $rec->semester;
        $set->trainer1 = $rec->trainer1;
        $set->trainer2 = $rec->trainer2;
        $set->lab = $rec->lab;
        $set->sestime = array('starthour'=>$timings['0'],
         'startminute'=>$timings['1'],
         'endhour'=>$timings['2'],
         'endminute'=>$timings['3']);
        $mform->set_data($set);
    }
}
echo $OUTPUT->header();
echo '<hr>';
$mform->display();
echo $OUTPUT->footer();