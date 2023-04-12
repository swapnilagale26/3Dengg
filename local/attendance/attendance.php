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
 * @copyright  Manjunath B K
 */

require_once('../../config.php');
global $DB,$PAGE,$USER,$CFG,$OUTPUT;
require_once($CFG->libdir . '/formslib.php');
require_once('form/attendance_form.php');
$context = context_system::instance();
$courseid = optional_param('course','',PARAM_INT);
$batch = optional_param('batch','',PARAM_INT);
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_url($CFG->wwwroot . '/local/attendance/attendance.php?course='.$courseid);
$title = get_string('attendance', 'local_attendance');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();

$mform  =  new local_attendance($CFG->wwwroot.'/local/attendance/attendance.php',array('course'=>$courseid,'batch'=>$batch));

$batchobject = $DB->get_record('local_batch',array('id'=>$batch));

if($mform->is_cancelled()){

}elseif($data = $mform->get_data()){
    //check for data exits.
    $todaydate = date("d-m-Y",time());
    $batch = $data->batch;

    $check = $DB->get_record_sql("SELECT *
        FROM {local_attendance_record}
        WHERE extra2 LIKE '%$todaydate%' AND batch LIKE '%$batch%'");
    if(!empty($check)){
        redirect($CFG->wwwroot.'/course/view.php?id='.$data->course,"Attendance already taken");
    }else{
        $checkarray = (array)$data;
        $result = $DB->get_record('batch_student_details',array('batch_id'=>$data->batch));
        $attendancearray = array();
        $counter = 1;
        foreach ($data as $key => $value) {
            if(array_key_exists("yesno".$counter, $checkarray)){
                $checkkey = "yesno".$counter;
                $attendancearray[] = $checkarray[$checkkey];
                $counter++;
            }
        }
        $fstring = implode(",",$attendancearray);

        $insert = new stdClass();
        $insert->trainer = $data->user;
        $insert->createddate = time();
        $insert->userid = $result->user_id;
        $insert->attendance = $fstring;
        $insert->timemodified = time();
        $insert->course = $data->course;
        $insert->extra2 = date("d-m-Y",time());
        $insert->batch = $data->batch;

        $batchobject = $DB->get_record('local_batch',array('id'=>$data->batch));
        if(!empty($data->trainer1)){
            $insert->trainer1 = $batchobject->trainer1;
        }
        if(!empty($data->trainer2)){
            $insert->trainer2 = $batchobject->trainer2;
        }

        $res = $DB->insert_record("local_attendance_record", $insert);
        if($res){
            redirect($CFG->wwwroot.'/course/view.php?id='.$data->course,"Attendance Recorded Successfully");
        }
    }

}
// else{
//     $check = $DB->get_record('local_attendance_record',array('batch'=>$batch,'course'=>$courseid,'extra2'=>$todaydate));
//     if(!empty($check)){
//         $allattendance = explode(",", $check->userid);
//         print_object($allattendance);die;
//         $setdata = new stdClass();
//         foreach ($allattendance as $attendance) {
            
//         }
//         $insert->trainer = $data->user;
//     }
// }

echo $OUTPUT->header();
//check if the attendance is already taken.
$todaydate = date("d-m-Y",time());
$check = $DB->get_record('local_attendance_record',array('batch'=>$batch,'course'=>$courseid,'extra2'=>$todaydate));
if(!empty($check)){
    echo $OUTPUT->notification("<b>Today Attendance already taken for this batch</b>",'notifysuccess');
    $allattendance = explode(",", $check->attendance);
    $counter = 1;
    $setdata = new stdClass();
    foreach ($allattendance as $attendance) {
        
        $setdata->yesno.$counter = $attendance;
        $counter++;
        }
         $mform->set_data($setdata);
}
if($batchobject->status != 1){

   $mform->display(); 

}else{

    echo $OUTPUT->notification("You are not allowed to take attendance",'notifysuccess');
}
echo $OUTPUT->footer();