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
 * @copyright  mallamma<mallamma@elearn10.com>
 * @copyright  Dhruv Infoline Pvt Ltd <lmsofindia.com>
 * @license    http://www.lmsofindia.com 2019 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

class trainer_profiles_form extends moodleform{

    public function definition(){
        global $CFG,$OUTPUT,$DB,$USER,$PAGE;
        $mform = $this->_form;
        //select the user.
        $allusername = $DB->get_records('user',array('deleted'=>0));
        $users = array();
        $users[''] = get_string('selectuser','local_trainer');                                             
        foreach ($allusername as $username) { 
            $users[$username->id] = $username->username;
        }                                                         
        $options = array(                                         
            'multiple' => false, 'noselectionstring' => get_string('allareas', 'search'));         
        $mform->addElement('autocomplete', 'uname', get_string('username', 'local_trainer'), $users, $options);

        //coursename
        $allcoursename = $DB->get_records('course',array('visible'=>1));
        $courses = array();
        $courses[''] = get_string('selectcourse','local_trainer');                                                       
        foreach ($allcoursename as $coursename) { 
            $courses[$coursename->id] = $coursename->fullname;
        }                                                         
        $options = array('multiple' => false,'noselectionstring' => get_string('allareas', 'search'),                       
    );

        $mform->addElement('autocomplete', 'cname', get_string('coursename', 'local_trainer'), $courses, $options);
        $mform->addElement('submit', 'submit', get_string('submit', 'local_trainer'));
    }   

}