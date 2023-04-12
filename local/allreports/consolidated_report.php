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
require_once('form/consolidated_form.php');
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/consolidated_report.php');
$title = "Consolidated Report";
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$mform = new local_consolidated_report();
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jquery.dataTables.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/dataTables.buttons.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jszip.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/pdfmake.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/vfs_fonts.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/buttons.html5.min.js'), true);

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/jquery.dataTables.min.css'), true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/buttons.dataTables.min.css'), true);
echo $OUTPUT->header();

$html='';

if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {
    $startdate = $data->startdate;
    $enddate = $data->enddate;
    $center = $data->institution;
    $trainer = $data->trainer;
    $companyname = $DB->get_field('company','name',array('id'=>$data->institution));

    $reportname = "";
    $reportname .= "Consolidated Report From ".date('d-m-Y',$startdate).' To '.date('d-m-Y',$enddate).',/ Centername- '.$companyname;

    $trainername ="";
    if(!empty($trainer)){
        $user = $DB->get_record('user',array('id'=>$data->trainer));
        $trainername = fullname($user);
        $reportname .= " /Trainer name- ".$trainername;
    }

    $report = new html_table();
    $report->id = "console_report";
    $report->head = array('Sl.No',
        'Course Title',
        'No of Batches',
        'No of Registered Students',
        'No of Certified Students');

    $companycourses = $DB->get_records('company_course',array('companyid'=>$data->institution));
    if(!empty($companycourses)){
        $counter = 1;

        foreach ($companycourses as $course) {

            $course = $DB->get_record('course',array('id'=>$course->courseid));
            if($course->timecreated >= $startdate && $course->timecreated <= $enddate){

                $certificateid = $DB->get_record('simplecertificate',array('course'=>$course->id));

                $certcount = 0;

                if(!empty($certificateid)){

                    $issued = $DB->get_records('simplecertificate_issues',array('certificateid'=>$certificateid->id));

                    $certcount = count($issued);

                }

                //get all the batches.
                $batches = $DB->get_records('local_batch',array('course_name'=>$course->id));
                $totalbatchcount = count($batches);
                $batchinprogress = 0;
                $batchcompleted = 0;
                $usertotal = 0;
                if(!empty($batches)){
                    foreach ($batches as $batch) {
                        if($batch->status == 1 || $batch->status == 2){
                            $batchinprogress++;
                        }else{
                            $batchcompleted++;
                        }
                        //No of registered.
                        $batchusers = $DB->get_record('batch_student_details',array('batch_id'=>$batch->id));
                        if(!empty($batchusers)){
                            $batchusersarray = explode(",", $batchusers->user_id);
                            $usertotal = $usertotal + count($batchusersarray);
                        }
                    }
                }

                $report->data[]=array($counter,
                    $course->fullname,
                    'In-Progress - '.$batchinprogress.' <br/>Completed - '.$batchcompleted.' <br/>Total -'.$totalbatchcount,
                    'In-Progress - '.$usertotal.' <br/>Completed - 0 <br/>Total - '.$usertotal,
                    $certcount);
                $counter++;
            }
        }
    }

    $html='';
    $html.="<hr>";
    $html.=html_writer::start_div('container');
    $html.=html_writer::start_div('row');

    $html.=html_writer::start_div('span4');
    $html.='<h5>'.get_string('startdate','local_allreports').'<br/>'.date('d-m-Y',$startdate).'</h5>';
    $html.=html_writer::end_div();
    $html.=html_writer::start_div('span4');
    $html.='<h5>'.get_string('enddate','local_allreports').'<br/>'.date('d-m-Y',$enddate).'</h5>';
    $html.=html_writer::end_div();

    if(is_siteadmin()){
        $html.=html_writer::start_div('span4');
        $html.='<h5>'.get_string('centername','local_allreports').'<br/>'.$companyname.'</h5>';
        $html.=html_writer::end_div();
    }




    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.="<hr>";
    $html.=html_writer::start_div('container table-responsive');
    $html.=html_writer::start_div('row table-responsive');
    $html.=html_writer::start_div('span12 table-bordered');
    $html.=html_writer::table($report);
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();

}

$mform->display();
echo $html;
echo "<script>$(document).ready(function() {
    $('#console_report').DataTable( {
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