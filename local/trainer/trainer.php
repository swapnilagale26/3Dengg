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
// require_once('lib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_url($CFG->wwwroot . '/local/trainer/trainer.php');
$title = get_string('trainerreport','local_trainer');
$PAGE->navbar->add($title);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->requires->jquery();
//Instantiate trainer_form 
$mform = new trainer_form();
echo $OUTPUT->header();
//variables initialisation.
//Form processing and displaying is done here
if ($mform->is_cancelled()) {
//Handle form cancel operation, if cancel button is present on form
} else if ($data = $mform->get_data()) {
  // print_object($data);die;
  //initialising the type of report.
  
}else{
  $mform->display();
}

// if($managercap){

//   //report table containing all the course userdetails.
//   $html='';
//   $html.=html_writer::start_div('container-fluid table-responsive');
//   $html.=html_writer::start_div('col-md-12');
//   $html.=html_writer::start_div('row');
//   $html.=html_writer::table($coursereport);
//   $html.="<script>$(document).ready(function() {
//     $('#coursecompltbl').DataTable( {
//       dom: 'Bfrtip',
//       buttons: [
//       'excel'
//       ]
//       } );
//     } );</script>";
//     $html.=html_writer::end_div();
//     $html.=html_writer::end_div();
//     $html.=html_writer::end_div();
//     echo $html;
//     echo $htmlp;
//   }
// }
//else{
//   $html='';
//   // $html.= get_string('massage','local_hospitalreport');
//   echo $html;
// }
echo $OUTPUT->footer();