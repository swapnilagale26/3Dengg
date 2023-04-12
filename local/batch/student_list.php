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
 * @package    local_batch
 * @copyright  Manjunath B K
 * @license    Manjunath B K
 */
require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/local/batch/csslinks.php');
require_once($CFG->dirroot.'/local/batch/jslinks.php');
require_once($CFG->dirroot . '/local/iomad/lib/company.php');
global $CFG,$PAGE,$OUTPUT,$USER;
require_login();
$stubatch_id = optional_param('stubatch_id','',PARAM_INT);
$create = optional_param('create','',PARAM_INT);
$delete = optional_param('flag','',PARAM_INT);
$update = optional_param('update','',PARAM_INT);
$context = context_system::instance();
$title = get_string('pluginname', 'local_batch');
$local = get_string('local','local_batch');
$url = $CFG->wwwroot;
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$previewnode = $PAGE->navbar->add($local,$url);
$thingnode = $previewnode->add($title);
$thingnode->make_active();
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

$PAGE->set_url($CFG->wwwroot .'/local/batch/student_list.php');
$title = "Batch Participant Details";
$PAGE->set_title($title);
echo $OUTPUT->header();
if(!empty($delete)){
    $id = $stubatch_id;
    $delete = delete_studentbatch_data($id);
    $sucssmsg = get_string('messagedisplay','local_batch');
    echo $OUTPUT->notification($sucssmsg, 'notifysuccess');
}

if(!empty($create)){
    $sucssmsg = get_string('createscss','local_batch');
    echo $OUTPUT->notification($sucssmsg,'notifysuccess');
}

if(!empty($update)){
    $sucssmsg = get_string('upadatescss','local_batch');
    echo $OUTPUT->notification($sucssmsg,'notifysuccess');
}

$companyid = iomad::get_my_companyid(context_system::instance(), false);

$records = $DB->get_records_sql("SELECT bsd.*,lb.status FROM {batch_student_details} AS bsd JOIN {local_batch} AS lb ON lb.id = bsd.batch_id WHERE lb.center_name = $companyid");

$table = new html_table();

$table->id =  'participants-details';

$table->head = (array) get_strings(array('sno','batch_code','student_name','email','pluginname','workingdays','slothours','createdon','updatedon'),'local_batch');

$scounter = 1;
$html ="";

if(!empty($records)){
    foreach ($records as $row) {
        if($row->status == 3){
            $actiontbtn = "-";
        }else{
            $actiontbtn = create_studentbatch_action_button($row->id);
        }
        $student_string = "";
        $student_email = "";
        
        $student_explode = explode(",",$row->user_id);
        $studentarray = array();
        $middlecounter = 1;
        foreach($student_explode as $stdkey => $stdid){
            $student_detail = $DB->get_record('user',array('id'=>$stdid));
            if(!empty($student_detail)){
                if($middlecounter == 1){
                    // $student_string .= $student_detail->id.'. '.fullname($student_detail).',<br/>';
                    $student_string .= fullname($student_detail).',<br/>';
                    $student_email .= $student_detail->email.',<br/>';
                }else{
                    // $student_string .= $student_detail->id.'. '.fullname($student_detail).', '.'<br/>';
                    $student_string .= fullname($student_detail).', '.'<br/>';
                    $student_email .= $student_detail->email.', '.'<br/>';
                }
            }
            $middlecounter++;
        }

        $labid = $DB->get_field('local_batch','lab',array('id'=>$row->batch_id));

        $batchobjet = $DB->get_record('local_batch',array('id'=>$row->batch_id));

        $slots = $batchobjet->timings;

        if(!empty($slots)){
            $timings = explode(",", $slots);
            $difference = $timings[2] - $timings[0];
        }

        $days = array('Select',
            'Monday',
            'Tuesday',
            'Wednessday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday');

        $labdays = $DB->get_field('cohort','days',array('id'=>$labid));

        $labname = $DB->get_field('cohort','name',array('id'=>$labid));

        $explodedays = explode(",",$labdays);

        $dayscount = count($explodedays);

        $weektimecount = $dayscount * $difference;

        $batchdays = "";

        if(!empty($explodedays)){
            $counter = 1;
            foreach ($explodedays as $explodeday) {
                if($counter == 1){
                    $batchdays.= $days[$explodeday].'<br/>';
                }else{
                    $batchdays.= $days[$explodeday].'<br/>';
                }
            }
        }

        $created_date = date('d-M-Y',$batchobjet->start_date);

        if(!empty($batchobjet->end_date)){
            $updated_date = date('d-M-Y',$batchobjet->end_date);
        }else{
            $updated_date="-";
        }
        $table->data[] = array($scounter++,$row->batch_code,$student_string,$student_email,$labname,$batchdays,$weektimecount." Hrs/ Week",$created_date,$updated_date);
    }

    $html.=html_writer::start_div('container table-responsive');
    $html.=html_writer::start_div('row table-responsive');
    $html.=html_writer::start_div('span12 table-bordered');
    $html.=html_writer::table($table);
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.="<script>$(document).ready(function() {
        $('#participants-details').DataTable( {
            dom: 'Bfrtip',
            buttons: [
            'excelHtml5'
            ]
            } );
        } );</script>";
    echo $html;

    }else{
        $html.=html_writer::start_div('container');
        $html.=html_writer::start_div('row');
        $html.=html_writer::start_div('col-md-12');
        $html.=$OUTPUT->notification("No Records Found",'notifysuccess');
        $html.=html_writer::end_div();
        $html.=html_writer::end_div();
        $html.=html_writer::end_div();
        echo $html;
    }

    echo $OUTPUT->footer();

