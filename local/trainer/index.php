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
global $DB,$CFG,$USER;
require_login();
require_once($CFG->dirroot . '/local/iomad/lib/company.php');
$companyid = iomad::get_my_companyid(context_system::instance(), false);
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/trainer/index.php');
$PAGE->requires->jquery();
$title = get_string('pluginname', 'local_trainer');
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/jquery.dataTables.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/dataTables.buttons.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/jszip.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/pdfmake.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/vfs_fonts.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/buttons.html5.min.js'),true);
$PAGE->requires->js(new moodle_url($CFG->wwwroot.'/local/trainer/js/buttons.print.min.js'),true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/trainer/css/buttons.dataTables.min.css'),true);
$PAGE->requires->css(new moodle_url($CFG->wwwroot.'/local/trainer/css/jquery.dataTables.min.css'),true);
echo $OUTPUT->header();
$html='';
$html.=html_writer::start_div('container');
$html.=html_writer::start_div('row');
$html.=html_writer::start_div('col-md-12 text-right');
$html.='<a href="'.$CFG->wwwroot.'/local/trainer/create_trainer.php'.'" target="_blank" class="btn btn-info">Create New Trainer</a>';
$html.=html_writer::end_div();
$html.=html_writer::end_div();
$html.=html_writer::end_div();
 $records = $DB->get_records('trainer_module');
if(!empty($records)){
    $report = new html_table();
    $report->id = "console_report";
    $report->head = array(get_string('serial','local_trainer'),
        get_string('centername','local_trainer'),
        get_string('trainername','local_trainer'),
        get_string('phoneno','local_trainer'),
        get_string('email','local_trainer'),
        get_string('status','local_trainer'),
        'Action');
    
    $counter = 1;
    $status = array('1'=>'In-Active','2'=>'Active');
    foreach ($records as $record) {
        $action ="";
        $action .=html_writer::start_div('',array('style'=>'display:flex;'));

        $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/trainer/create_trainer.php?id='.$record->id,'title'=>'Edit'));
        $action .='<i class="far fa-edit"></i>';
        $action .=html_writer::end_tag('a');

        $action .=html_writer::start_tag('a',array('href'=>$CFG->wwwroot.'/local/trainer/delete.php?id='.$record->id,'class'=>'pl-2','title'=>'Delete'));
        $action .='<i class="far fa-trash-alt"></i>';
        $action .=html_writer::end_tag('a');

        $action .=html_writer::end_div();

        $user = $DB->get_record('user',array('id'=>$record->userid));
        $center = $DB->get_field('company','name',array('id'=>$record->center));
        if(!is_siteadmin()){
            $companyid = $DB->get_field('company_users','companyid',array('userid'=>$USER->id));
            if($companyid == $record->center || $record->share == 1){
                $report->data[]=array(
                    $counter++,
                    $center,
                    fullname($user),
                    $user->phone1,
                    $user->email,
                    $status[$record->status],
                    $action);
            }
            
        }else{
            $report->data[]=array(
                $counter++,
                $center,
                fullname($user),
                $user->phone1,
                $user->email,
                $status[$record->status],
                $action);
        }
    }
    //report table containing all the course userdetails.
    $html.=html_writer::start_div('container-fluid table-responsive');
    $html.=html_writer::start_div('col-md-12');
    $html.=html_writer::start_div('row');
    $html.=html_writer::table($report);
    $html.="<script>$(document).ready(function() {
        $('#console_report').DataTable( {
          dom: 'Bfrtip',
          buttons: [
          'excel'
          ]
          } );
      } );</script>";
      $html.=html_writer::end_div();
      $html.=html_writer::end_div();
      $html.=html_writer::end_div();
  }else{
    $html.=html_writer::start_div('container-fluid table-responsive');
    $html.=html_writer::start_div('span6');
    $html.=html_writer::start_div('row');
    $html.=$OUTPUT->notification("No Records Found", 'notifysuccess');
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();
    $html.=html_writer::end_div();

}

echo $html;
echo $OUTPUT->footer();