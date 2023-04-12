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

function enrollment_enrol_user($userid, $courseid, $role, $timestart, $timeend) {
	global $DB, $CFG;
	$instance = $DB->get_record('enrol', array('enrol' => 'manual', 'courseid' => $courseid));
	$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

	if (!$enrol_manual = enrol_get_plugin('manual')) {
		throw new coding_exception('Can not instantiate enrol_manual');
	}

	if (!empty($timestart) && !empty($timeend) && $timeend < $timestart) {
		print_error('La date de fin doit etre supérieure à la date de début', null, $CFG->wwwroot . '/blocks/enrollment/enrollment.php');
	}
	if (empty($timestart)) {
		$timestart = $course->startdate;
	}
	if (empty($timeend)) {
		$timeend = 0;
	}
	$enrol_manual->enrol_user($instance, $userid, $role, $timestart, $timeend);
}