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
 * Cohort related management functions, this file needs to be included manually.
 *
 * @package    core_cohort
 * @copyright  2010 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/lib/formslib.php');

class cohort_edit_form extends moodleform {

    /**
     * Define the cohort edit form
     */
    public function definition() {
        global $CFG;

        $mform = $this->_form;
        $editoroptions = $this->_customdata['editoroptions'];
        $cohort = $this->_customdata['data'];

        $mform->addElement('text', 'name', get_string('name', 'cohort'), 'maxlength="254" size="50"');
        $mform->addRule('name', get_string('required'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        $options = $this->get_category_options($cohort->contextid);
        $mform->addElement('autocomplete', 'contextid', get_string('institute', 'cohort'), $options);
        $mform->addRule('contextid', null, 'required', null, 'client');

        $mform->addElement('text', 'idnumber', get_string('idnumber', 'cohort'), 'maxlength="254" size="50"');
        $mform->setType('idnumber', PARAM_RAW); // Idnumbers are plain text, must not be changed.

        $mform->addElement('advcheckbox', 'visible', get_string('visible', 'cohort'));
        $mform->setDefault('visible', 1);
        $mform->addHelpButton('visible', 'visible', 'cohort');

        $mform->addElement('editor', 'description_editor', get_string('description', 'cohort'), null, $editoroptions);
        $mform->setType('description_editor', PARAM_RAW);
        
        //Manju: Starts

        for ($i = 0; $i <= 23; $i++) {
            $hours[$i] = sprintf("%02d", $i);
        }
        for ($i = 0; $i < 60; $i += 5) {
            $minutes[$i] = sprintf("%02d", $i);
        }
    
        $sesendtime = array();
        if (!right_to_left()) {
            $sesendtime[] =& $mform->createElement('static', 'from', '', get_string('from', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'starthour', get_string('hour', 'form'), $hours, false, true);
            $sesendtime[] =& $mform->createElement('select', 'startminute', get_string('minute', 'form'), $minutes, false, true);
            $sesendtime[] =& $mform->createElement('static', 'to', '', get_string('to', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'endhour', get_string('hour', 'form'), $hours, false, true);
            $sesendtime[] =& $mform->createElement('select', 'endminute', get_string('minute', 'form'), $minutes, false, true);
        } else {
            $sesendtime[] =& $mform->createElement('static', 'from', '', get_string('from', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'startminute', get_string('minute', 'form'), $minutes, false, true);
            $sesendtime[] =& $mform->createElement('select', 'starthour', get_string('hour', 'form'), $hours, false, true);
            $sesendtime[] =& $mform->createElement('static', 'to', '', get_string('to', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'endminute', get_string('minute', 'form'), $minutes, false, true);
            $sesendtime[] =& $mform->createElement('select', 'endhour', get_string('hour', 'form'), $hours, false, true);
        }
        $mform->addGroup($sesendtime, 'sestime', get_string('time', 'attendance'), array(' '), true);
        $mform->addRule('sestime', get_string('required'), 'required', null, 'client');

        
        $sesendtime = array();
        if (!right_to_left()) {
            $sesendtime[] =& $mform->createElement('static', 'from', '', get_string('from', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'starthour', get_string('hour', 'form'), $hours, false, true);
            $sesendtime[] =& $mform->createElement('select', 'startminute', get_string('minute', 'form'), $minutes, false, true);
            $sesendtime[] =& $mform->createElement('static', 'to', '', get_string('to', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'endhour', get_string('hour', 'form'), $hours, false, true);
            $sesendtime[] =& $mform->createElement('select', 'endminute', get_string('minute', 'form'), $minutes, false, true);
        } else {
            $sesendtime[] =& $mform->createElement('static', 'from', '', get_string('from', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'startminute', get_string('minute', 'form'), $minutes, false, true);
            $sesendtime[] =& $mform->createElement('select', 'starthour', get_string('hour', 'form'), $hours, false, true);
            $sesendtime[] =& $mform->createElement('static', 'to', '', get_string('to', 'attendance'));
            $sesendtime[] =& $mform->createElement('select', 'endminute', get_string('minute', 'form'), $minutes, false, true);
            $sesendtime[] =& $mform->createElement('select', 'endhour', get_string('hour', 'form'), $hours, false, true);
        }
        $mform->addGroup($sesendtime, 'breaktime', get_string('break', 'attendance'), array(' '), true);
        //available days
        $days = array('1'=>"Monday",'2'=>"Tuesday",'3'=>"Wednessday",'4'=>"Thursday",'5'=>"Friday",'6'=>"Saturday",'7'=>"Sunday");
        $select = $mform->addElement('select', 'days', get_string('days'), $days);
        $mform->addRule('days', get_string('required'), 'required', null, 'client');
        $select->setMultiple(true);
        
        //cohort size
        $mform->addElement('text', 'size', 'Size');
        $mform->addRule('size', get_string('required'), 'required', null, 'client');
        $mform->setType('size', PARAM_INT);
        
        //Manju: Ends
        
        

        if (!empty($CFG->allowcohortthemes)) {
            $themes = array_merge(array('' => get_string('forceno')), cohort_get_list_of_themes());
            $mform->addElement('select', 'theme', get_string('forcetheme'), $themes);
        }

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        if (isset($this->_customdata['returnurl'])) {
            $mform->addElement('hidden', 'returnurl', $this->_customdata['returnurl']->out_as_local_url());
            $mform->setType('returnurl', PARAM_LOCALURL);
        }

        $this->add_action_buttons();

        $this->set_data($cohort);
    }

    public function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        $idnumber = trim($data['idnumber']);
        if ($idnumber === '') {
            // Fine, empty is ok.

        } else if ($data['id']) {
            $current = $DB->get_record('cohort', array('id'=>$data['id']), '*', MUST_EXIST);
            if ($current->idnumber !== $idnumber) {
                if ($DB->record_exists('cohort', array('idnumber'=>$idnumber))) {
                    $errors['idnumber'] = get_string('duplicateidnumber', 'cohort');
                }
            }

        } else {
            if ($DB->record_exists('cohort', array('idnumber'=>$idnumber))) {
                $errors['idnumber'] = get_string('duplicateidnumber', 'cohort');
            }
        }

        return $errors;
    }

    protected function get_category_options($currentcontextid) {
        $displaylist = core_course_category::make_categories_list('moodle/cohort:manage');
        $options = array();
        $syscontext = context_system::instance();
        if (has_capability('moodle/cohort:manage', $syscontext)) {
            $options[$syscontext->id] = $syscontext->get_context_name();
        }
        foreach ($displaylist as $cid=>$name) {
            $context = context_coursecat::instance($cid);
            $options[$context->id] = $name;
        }
        // Always add current - this is not likely, but if the logic gets changed it might be a problem.
        if (!isset($options[$currentcontextid])) {
            $context = context::instance_by_id($currentcontextid, MUST_EXIST);
            $options[$context->id] = $syscontext->get_context_name();
        }
        return $options;
    }
}

