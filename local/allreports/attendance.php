<?php
// This file is part of Moodle - http://moodle.org/
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
 * @package    local_allreports
 * @copyright  Manjunath B K
 * @license    Manjunath B K
 */

require_once('../../config.php');
require_once('form/student_attendance.php');
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/attendance.php');
$title = "Students Attendance";
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jquery.dataTables.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/dataTables.buttons.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jszip.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/pdfmake.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/vfs_fonts.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/buttons.html5.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/custom.js'), true);

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/jquery.dataTables.min.css'), true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/buttons.dataTables.min.css'), true);
$mform = new local_attendance_students();
echo $OUTPUT->header();
$html='';
if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {
    $startdate = $data->startdate;
    $enddate = $data->enddate;
    $center = $data->institution;
    $batch = $data->batch;

    $companyname = $DB->get_field('company','name',array('id'=>$data->institution));

    $reportname = "";
    $reportname .= "Students Attendance Report From ".date('d-m-Y',$data->startdate).' To '.date('d-m-Y',$data->enddate).',/ Centername- '.$companyname;

    //table starts
    $report = new html_table();
    $report->id = "student_attendance";
    $headarray = array('Name');

    $batchobject = $DB->get_record('local_batch',array('id'=>$batch));

    $batchusers = $DB->get_record('batch_student_details',array('batch_id'=>$batch));

    if(!empty($batchobject->course_name)){
       $course = get_course($batchobject->course_name); 
    }

    $sql = "SELECT * FROM {local_attendance_record} WHERE batch = $batch AND createddate BETWEEN $startdate AND $enddate";

    $attendancerecs = $DB->get_records_sql($sql);

    $dateheadaarray = array();

    if(!empty($attendancerecs)){
        $counter = 1;
        $collat = array();
        foreach ($attendancerecs as $record) {
            $users = explode(",", $record->userid);
            $attendance = explode(",", $record->attendance);
            for ($i=0; $i < count($attendance); $i++) { 
                $collat[$record->createddate][$users[$i]] = $attendance[$i];
            }
            $dateheadaarray[] = date("d-m-Y",$record->createddate);
        }

        if(!empty($batchusers)){
            $busers = explode(",", $batchusers->user_id);
            $counter = 1;
            foreach ($busers as $bbkey => $bbvalue) {
                $uobject = core_user::get_user($bbvalue);
                if(!empty($collat)){
                    $temp = array();
                    foreach ($collat as $ckey => $cvalue) {
                        if(empty($cvalue[$bbvalue])){
                            $temp[]= "A";
                        }else{
                            $temp[]= "P";
                        }
                    }
                }
                $dataarray = array(fullname($uobject));
                $report->data[]= array_merge($dataarray,$temp);

                $counter++;
            }
        }

        $report->head = array_merge($headarray,$dateheadaarray);

        $html =html_writer::start_div('container-fluid');
        $html.=html_writer::start_div('row');
        $html.=html_writer::start_div('span-6 table table-bordered',array('style'=>'overflow-x: auto'));
        $html.=html_writer::table($report);
        $html.=html_writer::end_div();
        $html.=html_writer::end_div();
        $html.=html_writer::end_div();
    }else{
        $html =html_writer::start_div('container-fluid');
        $html.=html_writer::start_div('row');
        $html.=html_writer::start_div('span-6 text-center');
        $html.=$OUTPUT->notification("No Records Found", 'notifysuccess');
        $html.=html_writer::end_div();
        $html.=html_writer::end_div();
        $html.=html_writer::end_div();
    }
}
$mform->display();
echo $html;
echo "<script>$(document).ready(function() {
    $('#student_attendance').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'excelHtml5',
            title: '".$reportname."'
            },
            ]
            } );
        } );</script>";
        echo $OUTPUT->footer();