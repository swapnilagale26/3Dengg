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
require_once('form/batch_progress.php');
require_once($CFG->libdir . '/formslib.php');
global $DB,$PAGE,$CFG,$OUTPUT;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');
$PAGE->set_url($CFG->wwwroot . '/local/allreports/batch_progress.php');
$title = get_string('batchprogrssreport','local_allreports');
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

$mform = new local_batch_progress();
echo $OUTPUT->header();

$reportname = "";
$reportname .= "Batch Progress Report ";
$html='';
if ($mform->is_cancelled()) {

} else if ($data = $mform->get_data()) {
	$reportname .= " From- ".date('d-m-Y',$data->startdate);
	$reportname .= " To- ".date('d-m-Y',$data->enddate);
	//Get all the batches.
	$companyname = $DB->get_field('company','name',array('id'=>$data->institution));

	$reportname .= ", Companyname- ".$companyname;

	if(!empty($data->trainer)){
		$user = $DB->get_record('user',array('id'=>$data->trainer));
		$reportname .= ", Trainer Name- ".fullname($user);
	}

	$batches = $DB->get_records('local_batch',array('center_name'=>$data->institution));
	$report = new html_table();
	$report->id = "batch_report";
	$report->head = array('Sl.No',
		'Center',
		'Batch Code',
		'Course Title',
		'Course Duration',
		'Slot Duration',
		'Trainer',
		'Start Date',
		'End Date',
		'Punctuality',
		'Batch Capacity',
		'Student Registered',
		'Batch Utilization',
		'Certified Students',
		'Batch Status');
	$batchstats = array('1'=>'Yet to Start','2'=>'In-Progress','3'=>'Completed');
	if(!empty($batches)){
		$counter = 1;

		foreach ($batches as $batch) {

			$trainer = $DB->get_record('user',array('id'=>$batch->trainer1));
			$course = $DB->get_record('course',array('id'=>$batch->course_name));
			$batchdetails = $DB->get_record('batch_student_details',array('batch_id'=>$batch->id));
			$batchusers = explode(",", $batchdetails->user_id);
			$batchper = (100 * count($batchusers))/$batch->batch_capacity;

			$certificateid = $DB->get_record('simplecertificate',array('course'=>$course->id));
			$certcount = 0;
			if(!empty($certificateid)){
				$issued = $DB->get_records('simplecertificate_issues',array('certificateid'=>$certificateid->id));
				$certcount = count($issued);
			}

			if($batch->timecreated >= $data->startdate && $batch->timecreated <= $data->enddate){
				$courseduration = $DB->get_field('customfield_data','value',array('fieldid'=>1,'instanceid'=>$course->id));
				if(empty($courseduration)){
					$courseduration = "-";
				}

										//timings
				$slottimings = 0;
				$slots = $batch->timings;
				if(!empty($slots)){
					$timings = explode(",", $slots);
					$difference = $timings[2] - $timings[0];
					$slottimings = $difference * 60;
				}

				if(!empty($data->trainer)){
					if($data->trainer == $batch->trainer1 || $data->trainer == $batch->trainer2){
						$report->data[]=array($counter,
							$companyname,
							$batch->batch_code,
							$course->fullname,
							$courseduration,
							$slottimings.' Mins',
							fullname($trainer),
							date("d-m-Y",$batch->start_date),
							date("d-m-Y",$batch->end_date),
							'-',
							$batch->batch_capacity,
							count($batchusers),
							round($batchper)." %",
							$certcount,
							$batchstats[$batch->status]);
						$counter++;
					}

				}else{
					$report->data[]=array($counter,
						$companyname,
						$batch->batch_code,
						$course->fullname,
						$courseduration,
						$slottimings.' Mins',
						fullname($trainer),
						date("d-m-Y",$batch->start_date),
						date("d-m-Y",$batch->end_date),
						'-',
						$batch->batch_capacity,
						count($batchusers),
						round($batchper)." %",
						$certcount,
						$batchstats[$batch->status]);
					$counter++;

				}
			}
		}
	}
	
	$html.=html_writer::start_div('container table-responsive');
	$html.=html_writer::start_div('row table-responsive text-center');
	$html.=html_writer::start_div('span-6 table table-bordered ',array('style'=>'overflow-x: auto'));
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
		echo "<style>
		#batch_report td {
		text-align: center !important;
		}
		</style>";
echo $OUTPUT->footer();