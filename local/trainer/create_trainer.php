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
 * @copyright  Mallamma<mallamma@elearn10.com>
 * @copyright  Dhruv Infoline Pvt Ltd <lmsofindia.com>
 * @license    http://www.lmsofindia.com 2017 or later
 */
require_once('../../config.php');
require_once('form/trainer_form.php');
require_once($CFG->libdir . '/formslib.php');
require_once('lib.php');
require_once($CFG->dirroot.'/user/editadvanced_form.php');
require_once($CFG->dirroot.'/user/editlib.php');
require_once($CFG->dirroot.'/user/profile/lib.php');
require_once($CFG->dirroot.'/user/lib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
$did = optional_param('did','',PARAM_INT);
$id = optional_param('id','',PARAM_INT);
if(!empty($did)){
	$del = $DB->delete_records("trainer_module", array('id'=>$did));
	if($del){
		redirect($CFG->wwwroot.'/local/trainer/index.php',"Deleted Successfully");
	}
}
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_url($CFG->wwwroot . '/local/trainer/create_trainer.php');
$title = get_string('create_trainer','local_trainer');
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();

if(!empty($id)){
    $mform = new trainer_form($CFG->wwwroot.'/local/trainer/create_trainer.php',array('id'=>$id));
}else{
    $mform = new trainer_form();
}

echo $OUTPUT->header();
if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {

    if(!empty($data->id)){
        $rec = $DB->get_record('trainer_module',array('id'=>$data->id));
        $user = $DB->get_record('user',array('id'=>$rec->userid));

        $update = new stdclass();
        $update->id = $user->id;
        $update->username = $data->temail;
        $update->email = $data->temail;
        if(!empty($data->tpassword)){
         $update->password = hash_internal_user_password($data->tpassword); 
     }
     $update->firstname = $data->tfirstname;
     $update->lastname = $data->tlastname;
     $update->address = $data->address;
     $update->phone1 = $data->tmobile;
     user_update_user($update, false, false);

     $check = $DB->get_field('trainer_module','id',array('userid'=>$user->id));
     if(!empty($check)){
         $update2 = new stdclass();
         $update2->id = $check;
         $update2->userid = $user->id;
         $update2->course = '';
         $update2->center = $data->institution;
         $update2->status = $data->status;
         $update2->address = $data->address;
         $update2->inactivation = $data->inactivation;
         $update2->joiningdate = $data->joiningdate;
         $update2->days = implode(",",$data->days);
         $update2->workingtime = implode(",",$data->sestime);
         $update2->share = $data->share;
         $DB->update_record('trainer_module', $update2);

     }
     redirect($CFG->wwwroot.'/local/trainer/index.php','Trainer Updated Successfully');

 }else{
    $newuser = new stdclass();
    $newuser->username = $data->temail;
    $newuser->password = hash_internal_user_password($data->tpassword);
    $newuser->firstname = $data->tfirstname;
    $newuser->lastname = $data->tlastname;
    $newuser->email = $data->temail;
    $newuser->address = $data->address;
    $newuser->phone1 = $data->tmobile;
    $newuser->confirmed   = 1;
    $newuser->lang        = current_language();
    $newuser->firstaccess = 0;
    $newuser->timecreated = time();
    $newuser->mnethostid  = $CFG->mnet_localhost_id;
    $newuser->secret      = random_string(15);
    $newuser->auth        = "manual";
    $newid = user_create_user($newuser, false, false);
    if(!empty($newid)){
     $rolein = new stdclass();
     $rolein->roleid = 16;
     $rolein->contextid = 1;
     $rolein->userid = $newid;
     $rolein->timemodified = time();
     $rolein->modifierid = $USER->id;
     $rolein->component = ' ';
     $rolein->itemid = 0;
     $rolein->sortorder = 0;
     $DB->insert_record('role_assignments', $rolein);

     $insert = new stdclass();
     $insert->userid = $newid;
     $insert->course = '';
     $insert->center = $data->institution;
     $insert->status = $data->status;
     $insert->inactivation = $data->inactivation;
     $insert->joiningdate = $data->joiningdate;
     $insert->days = implode(",",$data->days);
     $insert->workingtime = implode(",",$data->sestime);
     $insert->share = $data->share;
     $DB->insert_record('trainer_module', $insert);
     $userup = new stdclass();
     $userup->id = $newid;
     if($data->status == 1){
        $userup->suspended = 1;
    }else{
        $userup->suspended = 0;
    }
    $DB->update_record('user', $userup);
    redirect($CFG->wwwroot.'/local/trainer/index.php','Trainer Created Successfully');
}

}
}else{
    if(!empty($id)){
        $rec = $DB->get_record('trainer_module',array('id'=>$id));
        $user = $DB->get_record('user',array('id'=>$rec->userid));
        $sett = new stdclass();
        $sett->tfirstname = $user->firstname;
        $sett->tlastname = $user->lastname;
        $sett->temail = $user->email;
        $sett->tmobile = $user->phone1;
        $sett->address = $user->address;
        
        $sett->institution = $rec->center;
        $sett->status = $rec->status;
        $sett->inactivation = $rec->inactivation;
        $sett->joiningdate = $rec->joiningdate;
        $sett->days = explode(",",$rec->days);
        $sett->share = $rec->share;
        $timings = explode(",",$rec->workingtime);
        $sett->sestime = array('starthour'=>$timings['0'],
         'startminute'=>$timings['1'],
         'endhour'=>$timings['2'],
         'endminute'=>$timings['3']);
        $mform->set_data($sett);
    }
    $mform->display();
}
echo $OUTPUT->footer();