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
//local_trainer_utilization

require_once('../../config.php');
require_once('form/trainer_utilization.php');
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/trainer_utilization.php');
$title = "Trainer Utilization";
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

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/jquery.dataTables.min.css'), true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/buttons.dataTables.min.css'), true);
$mform = new local_trainer_utilization();
echo $OUTPUT->header();

$html='';

if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {

    $trainers = $DB->get_records('trainer_module', array('center'=>$data->institution));
    $company = $DB->get_record('company', array('id'=>$data->institution), '*', MUST_EXIST);

    $reportname = "";
    $reportname .= "Trainer Utilization Report From ".date('d-m-Y',$data->startdate).' To '.date('d-m-Y',$data->enddate).',/ Centername- '.$company->name;

    $report = new html_table();
    $report->id = "console_report";
    $report->head = array('Sl.No',
        'Center Name',
        'Trainer',
        'Available Hours',
        'Training Hours',
        'Capacity Utilized',
        'Number of Batches',
        'Number of Participants',
        'Certified Participants');
    if(!empty($trainers)){
        $counter = 1;
        foreach ($trainers as $trainer) {
            $certifiedstudents = 0;
            $totalcount = 0;
            $totalusers = 0;
            $user = $DB->get_record('user',array('id'=>$trainer->userid));
            //available hours calculation.
            $trainerdetail = $DB->get_record('trainer_module',array('userid'=>$trainer->userid));


            $diff = $trainer->joiningdate - $trainer->inactivation;
            $days = ceil(abs($diff / 86400));

            $workingdays = count(explode(",",$trainerdetail->days));
            $workinghours = explode(",",$trainerdetail->workingtime);
            $convert1 = $workinghours[0] * 60 + $workinghours[1];
            $convert2 = $workinghours[2] * 60 + $workinghours[3];
            $diff = $convert2 - $convert1;
            $totalhours = $days * 24;
            //$totalhours = $days * 24 * $diff / 60;



            $batches1 = $DB->get_records('local_batch',array('trainer1'=>$user->id));
            if(!empty($batches1)){
                $batch1hours = 0;
                foreach ($batches1 as $batch) {
                    $b1users = $DB->get_record('batch_student_details',array('batch_id'=>$batch->id));
                    $b1usersexplode = explode(",", $b1users->user_id);
                    $totalusers = $totalusers + count($b1usersexplode);

                    $batch1diffr = $trainer->inactivation - $trainer->joiningdate;
                    $batch1days = ceil(abs($batch1diffr / 86400));

                    $batch1workinghours = explode(",",$batch->timings);
                    $batch1diff = $batch1workinghours[2] - $batch1workinghours[0];
                    $batch1hours = $batch1diff * $batch1days;
                }
            }
            $batches2 = $DB->get_records('local_batch',array('trainer2'=>$user->userid));
            if(!empty($batches2)){
                $batch2hours = 0;
                foreach ($batches2 as $batch) {
                    $b2users = $DB->get_record('batch_student_details',array('batch_id'=>$batch->id));
                    $b2usersexplode = explode(",", $b2users->user_id);
                    $totalusers = $totalusers + count($b2usersexplode);


                    $batch2diffr = $trainer->inactivation - $trainer->joiningdate;
                    $batch2days = ceil(abs($batch2diffr / 86400));

                    $batch2workinghours = explode(",",$batch->timings);
                    $batch2diff = $batch2workinghours[2] - $batch2workinghours[0];
                    $batch2hours = $batch2diff * $batch2days;
                }
            }
            $totalbatchhours = $batch2hours + $batch1hours;

            $totalcount = count($batches1) + count($batches2);

            $totalbatches = count($batches);

            $cap = 0;

            if(!empty($totalbatchhours)){
              $cap = 100 * $totalbatchhours/$totalhours;  
            }

            

            $report->data[]=array($counter,
                $company->name,
                fullname($user),
                $totalhours,
                $totalbatchhours,
                round($cap,2),
                $totalcount,
                $totalusers,
                $certifiedstudents
            );
            $counter++;
        }
    }
    $html='';
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
        buttons: [{
                extend: 'excelHtml5',
                title: '".$reportname."'
            },
        ]
        } );
    } );</script>";
    echo $OUTPUT->footer();