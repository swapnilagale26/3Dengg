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
require_once('form/lab_utilization.php');
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/lab_utilization.php');
$title = "Lab Utilization";
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();
$mform = new local_lab_utilization();
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jquery.dataTables.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/dataTables.buttons.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jszip.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/pdfmake.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/vfs_fonts.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/buttons.html5.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/custom.js'), true);

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/jquery.dataTables.min.css'), true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/buttons.dataTables.min.css'), true);
echo $OUTPUT->header();

$html='';
if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {

    $cohort = $DB->get_record('company', array('id'=>$data->institution), '*', MUST_EXIST);

    $context =  context_coursecat::instance($cohort->category);

    $labs = $DB->get_records("cohort",array('visible'=>1,'contextid'=>$context->id));

    $reportname = "";
    $reportname .= "Lab Utilization Report From ".date('d-m-Y',$data->startdate).' To '.date('d-m-Y',$data->enddate).',/ Centername- '.$cohort->name;

    $report = new html_table();
    $report->id = "console_report";
    $report->head = array('Sl.No',
        'Center Name',
        'Lab Name',
        'Available Hours',
        'Training Hours',
        'Capacity Utilization against Training (%)');

    if(!empty($labs)){
        $counter = 1;
        foreach ($labs as $lab) {
            //Available hours is the sum of all batches under this lab.
            $labworkingdays = count(explode(",", $lab->days));
            $labworkingtime = explode(",", $lab->sestime);
            $labworkingtimediff = $labworkingtime[2] - $labworkingtime[0];
            $labbreaktime = explode(",", $lab->breaktime);
            $labbreaktimediff = $labbreaktime[2] - $labbreaktime[0];

            $finaltime = $labworkingtimediff - $labbreaktimediff;

            $diffdays = $data->enddate - $data->startdate;
            $dayss = ceil(abs($diffdays / 86400));

            $availablebatchtime = $dayss * $finaltime;

            $allbatches = $DB->get_records('local_batch',array('lab'=>$lab->id));

            if(!empty($allbatches)){
                $availabletime = 0;
                foreach ($allbatches as $batch) {

                    $slots = $batch->timings;
                    if(!empty($slots)){
                        $timings = explode(",", $slots);
                        $difference = $timings[2] - $timings[0];
                    }

                    $diff = $batch->end_date - $batch->start_date;
                    $days = ceil(abs($diff / 86400));
                    $availabletime = $availabletime + $difference * $days;
                }
            }
            $capacitytext = 0;
            if(!empty($availabletime) && !empty($availablebatchtime)){
                $capacity = 100 * $availabletime /$availablebatchtime;
                $capacitytext = round($capacity,2);
            }

            if(empty($availablebatchtime)){
                $availabletime = 0;
            }

            if(!empty($data->trainer)){
                $check = $DB->get_record('cohort_members',array('userid'=>$data->trainer,'cohortid'=>$lab->id));
                if(!empty($check)){
                 $report->data[]=array($counter,
                    $cohort->name,
                    $lab->name,
                    $availablebatchtime,
                    $availabletime,
                    $capacitytext); 
                 $counter++;
             }
         }else{
            $report->data[]=array($counter,
                $cohort->name,
                $lab->name,
                $availablebatchtime,
                $availabletime,
                $capacitytext);
            $counter++;
        }
        
    }
    $html.=html_writer::start_div('container table-responsive');
    $html.=html_writer::start_div('row table-responsive');
    $html.=html_writer::start_div('span12 table-bordered table-warning');
    $html.=html_writer::table($report);
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
}
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