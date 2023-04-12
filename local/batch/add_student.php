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
require_once('form/student_form.php');
global $DB,$_SESSION;
require_login();
$batchid = optional_param('id','',PARAM_INT);
if(!empty($batchid)){
    $_SESSION['bid'] = $batchid;
    $id = $_SESSION['bid'];
}else{
    $id = $_SESSION['bid'];
}
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_url($CFG->wwwroot . '/local/batch/add_student.php?id='.$id);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/batch/js/custom.js'), true);
$title = get_string('pluginname', 'local_batch');
$local = get_string('local','local_batch');
$url = $CFG->wwwroot;
if(!empty($id)){
    $PAGE->set_title($title);
    $PAGE->set_heading($title);
    $previewnode = $PAGE->navbar->add($local,$url);
    $thingnode = $previewnode->add($title);
    $thingnode->make_active();
    $headingtext1 = get_string('edit_student','local_batch');
    $heading = get_batch_heading($headingtext1,'','','');
    $mform  =  new local_student_form($CFG->wwwroot.'/local/batch/add_student.php',array('id'=>$id));

    $returnurl = new moodle_url('/local/batch/student_list.php?id='.$id);
    if($mform->is_cancelled()){
      redirect($returnurl);
  }elseif($data = $mform->get_data()){

    $check_data = $DB->get_record('batch_student_details',array('batch_id'=>$data->batch));
    if(!empty($check_data)){
      $update->id = $check_data->id;
      $update->batch_id = $data->id;
      $update->batch_code = $check_data->batch_code;
      $update->user_id = implode(",", $data->student);
      $update->created_on = $data->created_on;
      $update->updated_on = time();
      $update_datas = $DB->update_record('batch_student_details',$update);

      $batchdetail = $DB->get_record('local_batch',array('id'=>$data->batch));

      foreach ($data->student as $userkey => $uservalue) {
        enrollment_enrol_user_batch($uservalue, $batchdetail->course_name, 5, time(), null);
      }

      // $explodestudents = explode(",", string)
      $list_url = new moodle_url ('/local/batch/student_list.php',array('update'=>1,'id'=>$data->batch));
      $redirect = redirect($list_url);
  }else{
    $batch = insert_student_batch($data);
    $batchdetail = $DB->get_record('local_batch',array('id'=>$data->batch));
    foreach ($data->student as $userkey => $uservalue) {
        enrollment_enrol_user_batch($uservalue, $batchdetail->course_name, 5, time(), null);
      }
    $list_url = new moodle_url ('/local/batch/student_list.php',array('create'=>1,'id'=>$data->batch));
    $redirect = redirect($list_url);
}

}else{
    $check_data = $DB->get_record('batch_student_details',array('batch_id'=>$id));
    if(!empty($check_data)){
        $data = new stdClass();
        $explode_userids = explode(",",$check_data->user_id);
        $data->editid = $batchid;
        $data->created_on = $check_data->created_on;
        $data->batch = $check_data->batch_id;
        $data->student = $explode_userids;

        $mform->set_data($data); 
    }
}
}

echo $OUTPUT->header();
echo $heading;
echo ' <label for="birthday">Start Date:</label>
  <input type="date" id="startdate" name="birthday" onchange="StartDate();">
   <label for="birthday">End date:</label>
  <input type="date" id="enddate" name="birthday" onchange="EndDate();">';
echo '<hr>';
$mform->display();
echo $OUTPUT->footer();