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
 * @package    local_all_reports
 * @copyright  Ganesh<ganesh@skygraphtech.com>
 */
require_once('../../config.php');
global $DB,$PAGE,$CFG;
require_login();
require_once($CFG->libdir.'/formslib.php');
require_once('form/availability_form.php');
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/availability.php');
$title = "Availibility Report";
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/custom.js'), true);

$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jquery.dataTables.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/dataTables.buttons.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/jszip.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/pdfmake.min.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/vfs_fonts.js'), true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/allreports/js/buttons.html5.min.js'), true);

$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/jquery.dataTables.min.css'), true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/allreports/css/buttons.dataTables.min.css'), true);
$mform = new local_user_report();
echo $OUTPUT->header();

$html='';

if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {
    $startdate = $data->startdate;
    $enddate = $data->enddate;
    $lab = $data->lab;
    $trainer = $data->trainer;
    $report = new html_table();
    $report->id = "availibility_report";
    $headarray = array();
    $headarray[]="Date";

    $report1 = new html_table();
    $report1->id = "availibility_report2";
    $headarray1 = array();
    $headarray1[]="Date";

//if the lab is not empty.

    if(!empty($lab)){
        $labobject = $DB->get_record('cohort',array('id'=>$lab));
        $workingtime = explode(",", $labobject->sestime);
        $pmtime = array('13'=>'1 PM','14'=>'2 PM','15'=>'3 PM','16'=>'4 PM','17'=>'5 PM','18'=>'6 PM','19'=>'7 PM','20'=>'8 PM','21'=>'9 PM','12'=>'10 PM',);

        while($workingtime[0] <= $workingtime[2]){
            if($workingtime[0] <= 12){
                $headarray[] = $workingtime[0]." AM";
            }else{
                $headarray[] = $pmtime[$workingtime[0]];
            }
            $workingtime[0]++;
        }

        $batches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE end_date BETWEEN $startdate AND $enddate AND lab = $lab");
        if(!empty($batches)){

            while($startdate < $enddate){
                $tabldata = array();
                if(date('D', $startdate) == "Sat" || date('D', $startdate) == "Sun"){

                    $startdate = $startdate + 86400;

                }else{

                    $normalstartdate = date('d-m-Y',$startdate);
                //get the batches which runs in this date.
                    $innerbatches = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE start_date <= $startdate AND end_date >= $startdate AND lab = $lab");
                    $tabldata[] = $normalstartdate;
                    if(!empty($innerbatches)){
                      foreach ($innerbatches as $innerbatch) {
                        $mtimings = explode(",", $innerbatch->timings);
                        $temparray = array();
                        while($mtimings[0] <= $mtimings[2]){
                          $temparray[$mtimings[0]] = $mtimings[0]; 
                          $mtimings[0]++;
                      }
                  }
                  $workingtime = explode(",", $labobject->sestime);
                  while($workingtime[0] <= $workingtime[2]){
                    if(array_key_exists($workingtime[0],$temparray)){
                      $tabldata[] = "<div style='padding:13px; background-color: #ffdf7e;'></div>";
                  }else{
                    $tabldata[] = "<div style='padding:13px; background-color: #90EE90;'></div>";
                }
                $workingtime[0]++;
            }
        }else{

          $workingtime = explode(",", $labobject->sestime);
          while($workingtime[0] <= $workingtime[2]){
            $tabldata[] = "<div style='padding:13px; background-color: #90EE90;'></div>";
            $workingtime[0]++;
        }
    }        
    $startdate = $startdate + 86400;
    $report->data[]=$tabldata;
}
}
}
}

$startdate = $data->startdate;
$enddate = $data->enddate;
//if the Trainer is not empty
if(!empty($trainer)){
    $trainerobject = $DB->get_record('trainer_module',array('userid'=>$trainer));
    $workingtime = explode(",", $trainerobject->workingtime);
    $temparray = array();
    $pmtime = array('13'=>'1 PM','14'=>'2 PM','15'=>'3 PM','16'=>'4 PM','17'=>'5 PM','18'=>'6 PM','19'=>'7 PM','20'=>'8 PM','21'=>'9 PM','12'=>'10 PM');
    while($workingtime[0] <= $workingtime[2]){
        $temparray[$workingtime[0]] = $workingtime[0];
        if($workingtime[0] <= 12){
            $headarray1[] = $workingtime[0]." AM";
        }else{
            $headarray1[] = $pmtime[$workingtime[0]];
        }
        $workingtime[0]++;
    }
    while($startdate <= $enddate){
        $tabledata2 = array();
        if(date('D', $startdate) == "Sat" || date('D', $startdate) == "Sun"){
            $startdate = $startdate + 86400;
        }else{
            $normalstartdate = date('d-m-Y',$startdate);

            $tabledata2[] = $normalstartdate;

            if(!empty($trainer)){
                $innerbatches = $DB->get_records_sql("SELECT timings FROM {local_batch} WHERE start_date <= $startdate AND end_date >= $startdate AND trainer1 = $trainer");
            }
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
                        $tabledata2[] ="<div  style='padding:13px; background-color: #ffdf7e;'></div>";
                    }else{
                        $tabledata2[] ="<div style='padding:13px; background-color: #90EE90;'></div>";
                    }
                }
            }else{
                $workingtime = explode(",", $trainerobject->workingtime);
                while($workingtime[0] <= $workingtime[2]){
                    $tabledata2[] ="<div style='padding:13px; background-color: #90EE90;'></div>";
                    $workingtime[0]++;
                }
            }

            $startdate = $startdate + 86400;
        }
        $report1->data[]=$tabledata2;
    }
}

$report->head = $headarray;
$report1->head = $headarray1;
$html='';
$html.=html_writer::start_div('container table-responsive');
$html.="<h2>Lab Report</h2>";
$html.=html_writer::start_div('row table-responsive');
$html.=html_writer::start_div('span12 table-bordered');
$html.=html_writer::table($report);
$html.=html_writer::end_div();
$html.=html_writer::end_div();
$html.=html_writer::end_div();
if(!empty($trainer)){
$html.=html_writer::start_div('container pt-5');
$html.="<h2>Trainer Report</h2>";
$html.=html_writer::start_div('row table-responsive');
$html.=html_writer::start_div('span12 table-bordered');
$html.=html_writer::table($report1);
$html.=html_writer::end_div();
$html.=html_writer::end_div();
$html.=html_writer::end_div();
}
}

$mform->display();
echo $html;
echo "<script>$(document).ready(function() {

    $('#availibility_report').DataTable( {
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            },
            ]
            } );
        } );</script>";
echo $OUTPUT->footer();