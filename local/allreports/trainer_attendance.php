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
require_once('form/trainer_attendance.php');
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/trainer_attendance.php');
$title = "Trainer Attendance";
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
$mform = new local_attendance_trainer();
echo $OUTPUT->header();
$html='';
if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {
    $startdate = $data->startdate;
    $enddate = $data->enddate;
    $trainer = $data->trainer;
    $center = $data->institution;
    $companyname = $DB->get_field('company','name',array('id'=>$data->institution));

    $reportname = "";
    $reportname .= "Trainer Attendance Report From ".date('d-m-Y',$data->startdate).' To '.date('d-m-Y',$data->enddate).',/ Centername- '.$companyname;

    //table starts
    $report = new html_table();
    $report->id = "console_report";
    $headarray = array('Sl.No',
        'Center Name',
        'Batch Code',
        'Batch Type',
        'Course Title',
        'Name',
        'Percentage Attendance');
    //If the center only selected then get all the batches from the selected center.
    $sql = "";
    $sql.= "SELECT lar.*,lb.id as batchid, lb.start_date,lb.batch_code,lb.batch_type FROM {local_batch} AS lb INNER JOIN {local_attendance_record} AS lar ON lar.batch = lb.id WHERE lb.start_date BETWEEN $startdate AND $enddate AND lb.center_name = $center AND lb.trainer1 = $trainer OR lb.trainer2 = $trainer OR lar.trainer = $trainer";
    $batches = $DB->get_records_sql($sql);
    $batchidarray = array();

    if(!empty($batches)){
        $tabledata1 = array();
        if($data->enddate == time()){
            $datediff = time() - $data->startdate;
        }else{
            $datediff = $data->enddate - $data->startdate;
        }
        $difference =  round($datediff / (60 * 60 * 24));
        $startdate = $data->startdate;
        for ($i=0; $i <= $difference; $i++) {
            if($i == 0){
                if(date('D', $startdate) == "Sat" || date('D', $startdate) == "Sun"){
                    $startdate = $startdate + 86400;
                }else{
                    $dateheadaarray[date('d-m-Y',$startdate)] = date('d-m-Y',$data->startdate);
                    $tabledata1[date('d-m-Y',$startdate)] = "A";
                }
            }else{
                if(date('D', $startdate) == "Sat" || date('D', $startdate) == "Sun"){
                    $startdate = $startdate + 86400;
                }else{
                    $startdate = $startdate + 86400;
                    $dateheadaarray[date('d-m-Y',$startdate)] = date('d-M-y',$startdate);
                    $tabledata1[date('d-m-Y',$startdate)] = "A";
                }
            }
        }
        $batchindividual = array();
        $counter = 1;
        foreach ($batches as $batch) {
            if(!array_key_exists($batch->batchid,$batchindividual)){
                $batchindividual[$batch->batchid]= $tabledata1;
            }

            if(!array_key_exists($batch->batchid,$batchidarray)){

                if(array_key_exists($batch->extra2, $batchindividual[$batch->batchid])){
                    $batchindividual[$batch->batchid][$batch->extra2] = "P";
                }

                if(time() > $batch->start_date){
                    $datediff = time() - $batch->start_date;
                    $difference =  round($datediff / (60 * 60 * 24));
                    $startdate = $batch->start_date;
                    $presentcount = 0;
                    for ($i = 1; $i <= $difference; $i++) {
                        if($i > 1){
                            $startdate = $startdate + 86400;
                        }
                        if(!array_key_exists(date("d-m-Y",$startdate), $dateheadaarray)){

                            if(!array_key_exists(date("d-m-Y",$startdate),$tabledataarray)){
                                $tabledataarray[date("d-m-Y",$startdate)] = "P";
                                $presentcount++;
                            }else{
                                $tabledataarray[date("d-m-Y",$startdate)] = "A";
                            }
                        }
                    }
                    $coursename = $DB->get_field('course','fullname',array('id'=>$batch->course));

                    $user = $DB->get_record('user',array('id'=>$trainer));

                    $reportname .= " /Trainer - ".fullname($user);

                    $choices = array('-','STP','STTP','FDP');

                    $percentage = round(100 * $presentcount / $difference,2).' %';
                    $dataarray1 = array($counter,
                        $companyname,
                        $batch->batch_code,
                        $choices[$batch->batch_type],
                        $coursename,
                        fullname($user)
                    );
                }

            }else{
                if(array_key_exists($batch->extra2, $batchindividual[$batch->batchid])){
                    $batchindividual[$batch->batchid][$batch->extra2] = "P";
                }

                $batchtrainer1 = $batch->trainer1;
                $batchtrainer2 = $batch->trainer2;
                $batchid = $batch->batchid;
                $tabledataarray = array();
                if(time() > $batch->start_date){
                    $datediff = time() - $batch->start_date;
                    $difference =  round($datediff / (60 * 60 * 24));
                    $startdate = $batch->start_date;
                    $presentcount = 0;
                    for ($i = 1; $i <= $difference; $i++) {
                        if($i > 1){
                            $startdate = $startdate + 86400;
                        }
                        if(!array_key_exists(date("d-m-Y",$startdate), $dateheadaarray)){

                            if(!array_key_exists(date("d-m-Y",$startdate),$tabledataarray)){
                                $tabledataarray[date("d-m-Y",$startdate)] = "P";
                                $presentcount++;
                            }else{
                                $tabledataarray[date("d-m-Y",$startdate)] = "A";
                            }
                        }
                    }
                    $coursename = $DB->get_field('course','fullname',array('id'=>$batch->course));

                    $user = $DB->get_record('user',array('id'=>$trainer));

                    $reportname .= " /Trainer - ".fullname($user);

                    $choices = array('-','STP','STTP','FDP');

                    $percentage = round(100 * $presentcount / $difference,2).' %';
                    $dataarray1 = array($counter,
                        $companyname,
                        $batch->batch_code,
                        $choices[$batch->batch_type],
                        $coursename,
                        fullname($user)
                    );
                }
            }

            $report->head = array_merge($headarray,$dateheadaarray);
            $temp = array_count_values($batchindividual[$batch->batchid]);
            $percent = 0;
            if(!empty($temp['A']) &&  !empty($temp['P'])){
                $percent = $temp['P'] * 100/count($dateheadaarray);
            }
            $dataarray1[]= round($percent,2);
            $report->data[]= array_merge($dataarray1,$batchindividual[$batch->batchid]);
            $counter++;
        }
    }

    $html.="<hr>";
    $html.=html_writer::start_div('container');
    $html.=html_writer::start_div('row');

    $html.=html_writer::start_div('span3');
    $html.='<h5>'.get_string('startdate','local_allreports').'<br/>'.date('d-m-Y',$data->startdate).'</h5>';
    $html.=html_writer::end_div();
    $html.=html_writer::start_div('span3');
    $html.='<h5>'.get_string('enddate','local_allreports').'<br/>'.date('d-m-Y',$data->enddate).'</h5>';
    $html.=html_writer::end_div();
    $html.=html_writer::start_div('span3');
    $html.='<h5>'.get_string('trainername','local_allreports').'<br/>'.fullname($user).'</h5>';
    $html.=html_writer::end_div();

    if(is_siteadmin()){
        $html.=html_writer::start_div('span3');
        $html.='<h5>'.get_string('centername','local_allreports').'<br/>'.$companyname.'</h5>';
        $html.=html_writer::end_div();
    }

    $html.=html_writer::end_div();
    $html.=html_writer::end_div();

    $html.=html_writer::start_div('container-fluid');
    $html.=html_writer::start_div('row');
    $html.=html_writer::start_div('span-6 table table-bordered',array('style'=>'overflow-x: auto'));
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
