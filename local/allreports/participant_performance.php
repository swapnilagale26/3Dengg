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
require_once('form/participant_performance.php');
require_once("{$CFG->libdir}/completionlib.php");
require_once("$CFG->libdir/gradelib.php");
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/participant_performance.php');
$title = "Participant Performance";
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
$mform = new local_participant_performance();
echo $OUTPUT->header();
$html='';

if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {
	$startdate = date($data->startdate);
	$enddate = date($data->enddate);



	$report = new html_table();
	$report->id = "batch_report";
	$report->head = array('Sl.No',
		'Year',
		'Month',
		'Center Name',
		'Batch Code',
		'Course Title',
		'Student Name',
		'Enrollment No',
		'Final Score',
		'Grade',
		'Course Status');
	$companyid = $data->institution;

	$companyname = $DB->get_field('company','name',array('id'=>$data->institution));
	$batchdata = $DB->get_record('batch_student_details',array('batch_id'=>$data->batch));
	$users = explode(",", $batchdata->user_id);

	$batch = $DB->get_record('local_batch',array('id'=>$data->batch));
	$batchcode = $batch->batch_code;

	$coursename = $DB->get_field('course','fullname',array('id'=>$batch->course_name));
	$courseid = $batch->course_name;
	$courseobject = $DB->get_record('course',array('id'=>$courseid));

	$reportname = "";
    $reportname .= "Participant Performance Report From ".date('d-m-Y',$data->startdate).' To '.date('d-m-Y',$data->enddate).',/ Centername- '.$companyname.' /Batch- '.$batchcode;


	if(!empty($users )){
		$counter = 1;
		foreach ($users as $user => $id) {

			$coursegrade = 0;
			$coursefinalgrade = 0;
			$coursecomplte = "In-Progress";

			$info = new completion_info($courseobject);
			if ($info->is_course_complete($id)) {
				$coursecomplte = "Completed";
			}

			$sql="SELECT 
			u.username, 
			c.shortname AS 'Course',
			ROUND(gg.finalgrade,2) AS 'Grade',
			ROUND(gg.rawgrademax,2) AS 'finalgrade',
			DATE_FORMAT(FROM_UNIXTIME(gg.timemodified), '%Y-%m-%d') AS 'Date'
			FROM {course} AS c
			JOIN {context} AS ctx ON c.id = ctx.instanceid
			JOIN {role_assignments} AS ra ON ra.contextid = ctx.id
			JOIN {user} AS u ON u.id = ra.userid
			JOIN {grade_grades} AS gg ON gg.userid = u.id
			JOIN {grade_items} AS gi ON gi.id = gg.itemid
			WHERE gi.courseid = $courseid 
			AND gi.itemtype = 'course'
			AND ra.roleid = 5 AND u.id = $id
			ORDER BY u.username, c.shortname";

			$result = $DB->get_record_sql($sql);

			if(!empty($result)){
				$coursegrade = $result->grade;
				$coursefinalgrade = $result->finalgrade;
			}

			$user = $DB->get_record('user',array('id'=>$id));
			if($user->timecreated >= $data->startdate && $user->timecreated <= $data->enddate){
				$report->data[]=array($counter,
					date('Y',$batch->start_date),
					date('M',$batch->start_date),
					$companyname,
					$batch->batch_code,
					$coursename,
					fullname($user),
					$user->id,
					$coursegrade,
					$coursefinalgrade,
					$coursecomplte);
				$counter++;

			}
		}
	}
	$html='';
	$html.="<hr>";
	$html.=html_writer::start_div('container');
	$html.=html_writer::start_div('row');

	$html.=html_writer::start_div('span3');
	$html.='<h5>'.get_string('startdate','local_allreports').'<br/>'.date('d-m-Y',$startdate).'</h5>';
	$html.=html_writer::end_div();
	$html.=html_writer::start_div('span3');
	$html.='<h5>'.get_string('enddate','local_allreports').'<br/>'.date('d-m-Y',$enddate).'</h5>';
	$html.=html_writer::end_div();
	$html.=html_writer::start_div('span3');
	$html.='<h5>'.get_string('batchcode','local_allreports').'<br/>'.$batchcode.'</h5>';
	$html.=html_writer::end_div();

	if(is_siteadmin()){
		$html.=html_writer::start_div('span3');
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
	$('#batch_report').DataTable( {
		dom: 'Bfrtip',
		buttons: [{
                extend: 'excelHtml5',
                title: '".$reportname."'
            },
		]
		} );
	} );</script>";
	echo $OUTPUT->footer();