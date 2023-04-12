
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
require_once($CFG->dirroot.'/local/batch/csslinks.php');
require_once($CFG->dirroot.'/local/batch/jslinks.php');
require_once($CFG->dirroot . '/local/iomad/lib/company.php');
global $CFG,$PAGE,$OUTPUT,$USER;
require_login();

$instid = iomad::get_my_companyid(context_system::instance(), false);
$create = optional_param('create','',PARAM_INT);
$delete = optional_param('batch_id','',PARAM_INT);
if(!empty($delete)){
    $res = $DB->delete_records('local_batch',array('id'=>$delete));
    if(!empty($res)){
        redirect($CFG->wwwroot.'/local/batch/index.php',"Deleted Successfully");
    }
}
$context = context_system::instance();
$title = get_string('pluginname', 'local_batch');
$local = get_string('local','local_batch');
$url = $CFG->wwwroot;
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
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
$PAGE->set_url($CFG->wwwroot .'/local/batch/index.php');
$title = get_string('participantdetails','local_batch');
$PAGE->set_title($title);
echo $OUTPUT->header();
//Get all the details from all created batches.
if(!empty($create))
{
    $sucssmsg = get_string('createscss','local_batch');
    echo $OUTPUT->notification($sucssmsg,'notifysuccess');
}

$link =  new moodle_url('/local/batch/create_batch.php');
$html = "";
$html.=html_writer::start_div('container');
$html.=html_writer::start_div('row');
$html.=html_writer::start_div('span12');
$html .= html_writer::start_tag('a',array('role'=>'button','href'=>$link,'style'=>'float:right;margin-left:5px;','class'=>'btn btn-primary'));
$html .=get_string('create_batch','local_batch');
$html .= html_writer::end_tag('a');
$html.=html_writer::end_div();
$html.=html_writer::end_div();
$html.=html_writer::end_div();

//$records = $DB->get_records('local_batch',array('center_name'=>$instid));

$records = $DB->get_records_sql("SELECT * FROM {local_batch} WHERE center_name = $instid ORDER BY id DESC");

if(!empty($records)){
    $table = new html_table();
    $table->id = 'batch-list';
    $table->head = (array) get_strings(array('sno','batch_code','cname','uname','center_name','batch_type','status','createdon','updatedon','lab','actionbtn'),'local_batch');

    $counter = 1;
    foreach ($records as $row) {
     $actiontbtn = create_batch_action_button($row->id);
     $coursename = $DB->get_field('course','fullname',array('id'=>$row->course_name));
     $trainername = $DB->get_record('user',array('id'=>$row->trainer1));
     $centername = $DB->get_field('company','name',array('id'=>$row->center_name));

     if($row->batch_type == 1){
        $batch_type = get_string('stp','local_batch');
    }elseif($row->batch_type == 2){
        $batch_type = get_string('sttp','local_batch');
    }else{
        $batch_type = get_string('fdp','local_batch');
    }

    $status_array = array(get_string('select_status','local_batch'),
            get_string('yettostart','local_batch'),
            get_string('progress','local_batch'),
            get_string('completed','local_batch'));


    $labname = $DB->get_field('cohort','name',array('id'=>$row->lab));
    $table->data[] = array($counter++,
        $row->batch_code,
        $coursename,
        fullname($trainername),
        $centername,
        $batch_type,
        $status_array[$row->status],
        date('d-m-Y',$row->start_date),
        date('d-m-Y',$row->end_date),
        $labname,
        $actiontbtn);
}
$html.=html_writer::start_div('container table-responsive ');
$html.=html_writer::start_div('row table-responsive');
$html.=html_writer::start_div('span12 table-responsive');
$html.=html_writer::table($table);
$html.=html_writer::end_div();
$html.=html_writer::end_div();
$html.=html_writer::end_div();
$html.="<script>$(document).ready(function() {
    $('#batch-list').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        'excelHtml5',
        ]
        } );
    } );</script>";
}else{
    $html.=html_writer::start_div('container');
    $html.=html_writer::start_div('row');
    $html.=html_writer::start_div('span3');
    $html.=$OUTPUT->notification("No Records Found", 'notifysuccess');
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
}
echo $html;
echo $OUTPUT->footer();

