<?php
// This file is part of the Local welcome plugin
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
global $CFG,$USER;

function insert_batch($data){
  global $CFG,$USER,$DB;
  $context = context_system::instance();
  $course_details = $DB->get_record('course',array('id'=>$data->course_name));
  $user_detail = $DB->get_record('user',array('id'=>$data->select_trainer));
  $insert = new stdClass();
  $insert->center_name = $data->center_name;
  $insert->batch_code = $data->batch_code;
  $insert->description = $data->description['text'];
  $insert->status = $data->status;
  $insert->course_name    = $data->course_name;
  $insert->batch_capacity = $data->batch_capacity;
  $insert->start_date = $data->start_date;
  $insert->end_date = $data->end_date;
  $insert->batch_type = $data->batch_type;
  $insert->semester = $data->semester;
  $insert->trainer1 = $data->trainer1;
  $insert->trainer2 = $data->trainer2;
  $insert->lab = $data->lab;
  $insert_datas = $DB->insert_record('local_batch',$insert);
  return $insert_datas;
}

function get_batch_heading($headingtext,$subheadingtext,$buttonlink,$buttontext){
  global $CFG;
  $headingdetails = html_writer::start_tag('div',  array('class' => 'row'));
  $headingdetails .= html_writer::start_tag('div',  array('class' => 'col-md-6'));
  $headingdetails .= html_writer::start_tag('h4');
  $headingdetails .= $headingtext;
  $headingdetails .= html_writer::end_tag('h4');
  $headingdetails .= html_writer::start_tag('p');
  $headingdetails .= $subheadingtext;
  $headingdetails .= html_writer::end_tag('p');
  $headingdetails .= html_writer::end_tag('div');
  $headingdetails .= html_writer::end_tag('div');
  return $headingdetails;
}

function list_batch_datas(){
  global $DB;
  $sql = 'SELECT * from {local_batch}';
  $getdetailes = $DB->get_records_sql($sql);
  return $getdetailes;
}

function list_studentbatch_datas(){
  global $DB;
  $sql = 'SELECT * from {batch_student_details}';
  $getdetailes = $DB->get_records_sql($sql);
  return $getdetailes;
}

function create_batch_table($data){
  global $DB;
  $tabledisplay = '';
  $tabledisplay .= html_writer::start_tag('div',  array('class' => 'table table-bordered'));
  $table = new html_table();
  $table->head = (array) get_strings(array('sno','batch_code','cname','uname','center_name','batch_type','actionbtn'),'local_batch');
  $table->id =  'batch-list';
  $i = 1;
  foreach ($data as $row) {
   $actiontbtn = create_batch_action_button($row->id);
   $coursename = $DB->get_field('course','fullname',array('id'=>$row->course_name));
   $trainername = $DB->get_record('user',array('id'=>$row->trainer1));
   $centername = $DB->get_field('company','name',array('id'=>$row->center_name));

   if($row->batch_type == 1){
    $batch_type = get_string('stp','local_batch');
  }elseif($row->batch_type == 2){
    $batch_type = get_string('sttp','local_batch');
  }else{
    $batch_type = get_string('fdp','local_batch');
  }
  $table->data[] = array($i++,
    $row->batch_code,
    $coursename,
    fullname($trainername),
    $centername,
    $batch_type,
    $actiontbtn);
}
$tabledisplay .= html_writer::table($table);
$tabledisplay .= html_writer::end_tag('div');

return $tabledisplay;
}

function create_batch_action_button($data)
{
  global $CFG,$DB;
  $batch = $DB->get_record('local_batch',array('id'=>$data));

  $action ="";
  $action .=html_writer::start_div('',array('style'=>'display:flex;'));

  $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/batch/create_batch.php?batch_id='.$data,'title'=>'Edit'));
  $action .='<i class="fas fa-edit"></i>';
  $action .=html_writer::end_tag('a');

  if($batch->status == 1){
    $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/batch/delete_batch.php?batch_id='.$data.'&flag=1','class'=>'pl-2','title'=>'Delete'));
    $action .='<i class="fas fa-trash-alt"></i>';
    $action .=html_writer::end_tag('a');

    $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/batch/add_student.php?id='.$data,'class'=>'pl-2','title'=>'Assign'));
    $action .='<i class="fas fa-users"></i>';
    $action .=html_writer::end_tag('a');

    

  }elseif ($batch->status == 2) {
    $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/batch/add_student.php?id='.$data,'class'=>'pl-2','title'=>'Assign'));
    $action .='<i class="fas fa-users"></i>';
    $action .=html_writer::end_tag('a');

  }
  $action .=html_writer::end_div();
  return $action;
}

function create_studentbatch_action_button($data)
{
  global $CFG;
  $action ="";
  $action .=html_writer::start_div('',array('style'=>'display:flex;'));
  $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/batch/delete_studentbatch.php?stubatch_id='.$data.'&flag=1','class'=>'pl-2','title'=>'Delete'));
  $action .='<i class="fas fa-trash-alt"></i>';
  $action .=html_writer::end_tag('a');

  $action .=html_writer::end_div();
  return $action;
}

function delete_batch_data($data)
{
  global $DB;
  $sql = 'delete from {local_batch} where id='.$data.' ';
  $delete = $DB->execute($sql);
  return $delete;
}

function delete_studentbatch_data($data)
{
  global $DB;
  $sql = 'delete from {batch_student_details} where id='.$data.' ';
  $delete = $DB->execute($sql);
  return $delete;
}


function insert_student_batch($data){
  global $CFG,$USER,$DB;
  $insert = new stdClass();
  $context = context_system::instance();
  $sql = "select * from {local_batch} where id='".$data->batch."' ";
  $get_batch_code = $DB->get_record_sql($sql);
  $insert->batch_id = $data->batch;
  $insert->batch_code = $get_batch_code->batch_code;
  $insert->user_id = implode(",", $data->student);
  $insert->created_on = time();
  $insert->updated_on = "";
  $insert_datas = $DB->insert_record('batch_student_details',$insert);
  return $insert_datas;
}

function update_student_batch($data){
  global $CFG,$USER,$DB;
  $student_string = "";
  foreach($data->student as $val){
    $student_string.= $val.',';
  }
  $final_student_string = rtrim($student_string,",");

  $update_studentbatch_object = new stdClass();
  $context = context_system::instance();
  $sql = "select * from {local_batch} where id='".$data->batch."' ";
  $get_batch_code = $DB->get_record_sql($sql);
  $update_studentbatch_object->id = $data->editid;
  $update_studentbatch_object->batch_id = $data->batch;
  $update_studentbatch_object->batch_code = $get_batch_code->batch_code;
  $update_studentbatch_object->user_id = $final_student_string;
  $update_studentbatch_object->created_on = $data->created_on;
  $update_studentbatch_object->updated_on = time();
  $update_datas = $DB->update_record('batch_student_details',$update_studentbatch_object);
  return $update_datas;
}

function update_batch($data){
  global $CFG,$USER,$DB;
  $update_batch_object = new stdClass();
  $context = context_system::instance();

  $update_batch_object->id = $data->editid;
  $update_batch_object->center_name = $data->center_name;
  $update_batch_object->batch_code = $data->batch_code;
  $update_batch_object->description = $data->description;
  $update_batch_object->status = $data->status;
  $update_batch_object->course_name    = $data->course_name;
  $update_batch_object->batch_capacity = $data->batch_capacity;
  $update_batch_object->start_date = $data->start_date;
  $update_batch_object->end_date = $data->end_date;
  $update_batch_object->batch_type = $data->batch_type;
  $update_batch_object->semester = $data->semester;
  $update_batch_object->trainer_name = $data->select_trainer;
  $update_datas = $DB->update_record('local_batch',$update_batch_object);
  return $update_datas;
}
function create_student_batch_table($data){
  global $DB;
  $tabledisplay = '';
  $tabledisplay .= html_writer::start_tag('div',  array('class' => 'table table-bordered'));
  $table = new html_table();
  $table->head = (array) get_strings(array('sno','batch_code','student_name','createdon','updatedon','actionbtn'),'local_batch');
  $table->id =  'example';
  $i = 1;
  $student_string = "";
  foreach ($data as $row) {
   $actiontbtn = create_studentbatch_action_button($row->id);
   $student_explode = explode(",",$row->user_id);
   foreach($student_explode as $std_name){
    $student_detail = $DB->get_record('user',array('id'=>$std_name));
    $student_string.= fullname($student_detail).',<br/>';
  }
  $created_date = date('d-M-Y',$row->created_on);

  if(!empty($row->updated_on)){
    $updated_date = date('d-M-Y',$row->updated_on);
  }else{
    $updated_date="-";
  }

  $student_names = rtrim($student_string,',');
  $table->data[] = array($i++,$row->batch_code,$student_names,$created_date,$updated_date,$actiontbtn);
  unset($student_string);
}
$tabledisplay .= html_writer::table($table);
$tabledisplay .= html_writer::end_tag('div');

return $tabledisplay;
}


function enrollment_enrol_user_batch($userid, $courseid, $role, $timestart, $timeend) {
  global $DB, $CFG;
  $instance = $DB->get_record('enrol', array('enrol' => 'manual', 'courseid' => $courseid));
  $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

  if (!$enrol_manual = enrol_get_plugin('manual')) {
    throw new coding_exception('Can not instantiate enrol_manual');
  }

  if (!empty($timestart) && !empty($timeend) && $timeend < $timestart) {
    print_error('La date de fin doit etre supérieure à la date de début', null, $CFG->wwwroot . '/blocks/enrollment/enrollment.php');
  }
  if (empty($timestart)) {
    $timestart = $course->startdate;
  }
  if (empty($timeend)) {
    $timeend = 0;
  }
  $enrol_manual->enrol_user($instance, $userid, $role, $timestart, $timeend);
}


function lab_availibility_timings_old($labid,$startdate,$enddate){
  global $DB, $CFG;
  $html="";
  $labobject = $DB->get_record('cohort',array('id'=>$labid));
  $workingtime = explode(",", $labobject->sestime);
  $breaktime = explode(",", $labobject->breaktime);
  $days = explode(",", $labobject->days);
  //Get all the batches comes under this lab.
  $batches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE end_date BETWEEN $startdate AND $enddate AND lab = $labid");
  $batchtimings = array();
  if(!empty($batches)){
    $html.="<h4>Lab Accupied Timing : </h4>";
    $counter = 1;
    $html.="<div class='row'>";
    foreach ($batches as $batch) {
      $trainerid1 = \core_user::get_user($batch->trainer1);
      $trainerid1fullname = fullname($trainerid1);
      $trainerid2fullname="";
      if(!empty($batch->trainer2)){
        $trainerid2 = \core_user::get_user($batch->trainer2);
        $trainerid2fullname = fullname($trainerid2);
      }

      $exptime = explode(",",$batch->timings);
      $timestring = $exptime[0].':'.$exptime[1].' To '.$exptime[2].':'.$exptime[3];
      $html.="<div class='span3 card p-2'>";
      $html.="<b>Batch Code :</b> ".$batch->batch_code;
      $html.="<br/>";
      $html.="<b>Batch Timing :</b> ".$timestring;
      $html.="<br/>";
      $html.="<b>Trainers :</b> ".$trainerid1fullname.", ".$trainerid2fullname;
      $html.="<br/>";
      $html.="</div>";
      // $html.=$counter.'). '.$timestring.'  [ '.$batch->batch_code.' ] ';
      // $html.="<br/>";
      // $counter++;
    }
    $html.="<div>";
  }
  return $html;
}

function lab_availibility_timings($labid,$startdate,$enddate){
  global $DB, $CFG;
  $html="";
  $labobject = $DB->get_record('cohort',array('id'=>$labid));
  $workingtime = explode(",", $labobject->sestime);
  //Get all the batches comes under this lab.
  $batches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE end_date BETWEEN $startdate AND $enddate AND lab = $labid");

  // if(!empty($batches)){
    $html.="<h4>Lab Available Timings : </h4>";
    $html.="<table class='table text-center'><tr class='text-center'>";
    $html.="<th>Date</th>";

    while($workingtime[0] <= $workingtime[2]){

      $pmtime = array('13'=>'1 PM','14'=>'2 PM','15'=>'3 PM','16'=>'4 PM','17'=>'5 PM','18'=>'6 PM','19'=>'7 PM','20'=>'8 PM','21'=>'9 PM','12'=>'10 PM',);
      if($workingtime[0] <= 12){
        $html.="<th class='bg-info text-white'>".$workingtime[0]." AM</th>";
      }else{
        $html.="<th class='bg-info text-white'>".$pmtime[$workingtime[0]]." </th>";
      }
      $workingtime[0]++;
    }

    $html.="</tr>";
    $normalstartdate = date('d-m-Y',$startdate);

    while($startdate < $enddate){
      if(date('D', $startdate) == "Sat" || date('D', $startdate) == "Sun"){

        $startdate = $startdate + 86400;

      }else{

        $normalstartdate = date('d-m-Y',$startdate);
        //get the batches which runs in this date.
        $innerbatches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE start_date <= $startdate AND end_date >= $startdate AND lab = $labid");
        $html.="<tr>";
        $html.="<td>".$normalstartdate."</td>";
        if(!empty($innerbatches)){
          foreach ($innerbatches as $innerbatch) {
            $mtimings = explode(",", $innerbatch->timings);
            $temparray = array();
            while($mtimings[0] <= $mtimings[2]){
              $temparray[$mtimings[0]] = $mtimings[0]; 
              //$html.="<th class='bg-danger'></th>";
              $mtimings[0]++;
            }
          }
          $workingtime = explode(",", $labobject->sestime);
          while($workingtime[0] <= $workingtime[2]){
            if(array_key_exists($workingtime[0],$temparray)){
              $html.="<td><div style='padding:13px; background-color: #ffdf7e;'></div></td>";
            }else{
              $html.="<td><div style='padding:13px; background-color: #90EE90;'></div></td>";
            }
            $workingtime[0]++;
          }
        }else{

          $workingtime = explode(",", $labobject->sestime);
          while($workingtime[0] <= $workingtime[2]){
            $html.="<td><div style='padding:13px; background-color: #90EE90;'></div></td>";
            $workingtime[0]++;
          }
        }        
        $html.="<tr>";
        $startdate = $startdate + 86400;
      }
    }
    
  // }
  return $html;
}