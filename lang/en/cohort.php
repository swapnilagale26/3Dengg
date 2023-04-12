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
 * Strings for component 'cohort', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package    core_cohort
 * @subpackage cohort
 * @copyright  2010 Petr Skoda (info@skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['addcohort'] = 'Add new lab';
$string['allcohorts'] = 'All labs';
$string['anycohort'] = 'Any';
$string['assign'] = 'Assign';
$string['assignto'] = 'Lab \'{$a}\' members';
$string['backtocohorts'] = 'Back to labs';
$string['bulkadd'] = 'Add to lab';
$string['bulknocohort'] = 'No available labs found';
$string['categorynotfound'] = 'Category <b>{$a}</b> not found or you don\'t have permission to create a lab there. The default context will be used.';
$string['cohort'] = 'Lab';
$string['cohorts'] = 'Labs';
$string['cohortsin'] = '{$a}: available labs';
$string['assigncohorts'] = 'Assign lab members';
$string['component'] = 'Source';
$string['contextnotfound'] = 'Context <b>{$a}</b> not found or you don\'t have permission to create a lab there. The default context will be used.';
$string['csvcontainserrors'] = 'Errors were found in CSV data. See details below.';
$string['csvcontainswarnings'] = 'Warnings were found in CSV data. See details below.';
$string['csvextracolumns'] = 'Column(s) <b>{$a}</b> will be ignored.';
$string['currentusers'] = 'Current users';
$string['currentusersmatching'] = 'Current users matching';
$string['defaultcontext'] = 'Default context';
$string['delcohort'] = 'Delete lab';
$string['delconfirm'] = 'Do you really want to delete lab \'{$a}\'?';
$string['description'] = 'Description';
$string['displayedrows'] = '{$a->displayed} rows displayed out of {$a->total}.';
$string['duplicateidnumber'] = 'Lab with the same ID number already exists';
$string['editcohort'] = 'Edit lab';
$string['editcohortidnumber'] = 'Edit lab ID';
$string['editcohortname'] = 'Edit lab name';
$string['eventcohortcreated'] = 'Lab created';
$string['eventcohortdeleted'] = 'Lab deleted';
$string['eventcohortmemberadded'] = 'User added to a lab';
$string['eventcohortmemberremoved'] = 'User removed from a lab';
$string['eventcohortupdated'] = 'Lab updated';
$string['external'] = 'External lab';
$string['invalidtheme'] = 'Lab theme does not exist';
$string['idnumber'] = 'Lab ID';
$string['memberscount'] = 'Lab size';
$string['name'] = 'Lab Name';
$string['namecolumnmissing'] = 'There is something wrong with the format of the CSV file. Please check that it includes the correct column names. To add users to a lab, go to \'Upload users\' in the Site administration.';
$string['namefieldempty'] = 'Field name can not be empty';
$string['newnamefor'] = 'New name for lab {$a}';
$string['newidnumberfor'] = 'New ID number for lab {$a}';
$string['nocomponent'] = 'Created manually';
$string['potusers'] = 'Potential users';
$string['potusersmatching'] = 'Potential matching users';
$string['preview'] = 'Preview';
$string['privacy:metadata:cohort_members'] = 'Information about the user\'s lab.';
$string['privacy:metadata:cohort_members:cohortid'] = 'The ID of the lab';
$string['privacy:metadata:cohort_members:timeadded'] = 'The timestamp indicating when the user was added to the lab';
$string['privacy:metadata:cohort_members:userid'] = 'The ID of the user which is associated to the lab';
$string['removeuserwarning'] = 'Removing users from a lab may result in unenrolling of users from multiple courses which includes deleting of user settings, grades, group membership and other user information from affected courses.';
$string['selectfromcohort'] = 'Select members from lab';
$string['systemcohorts'] = 'System labs';
$string['unknowncohort'] = 'Unknown lab ({$a})!';
$string['uploadcohorts'] = 'Upload labs';
$string['uploadedcohorts'] = 'Uploaded {$a} labs';
$string['useradded'] = 'User added to lab "{$a}"';
$string['search'] = 'Search';
$string['searchcohort'] = 'Search lab';
$string['uploadcohorts_help'] = 'Labs may be uploaded via text file. The format of the file should be as follows:

* Each line of the file contains one record
* Each record is a series of data separated by commas (or other delimiters)
* The first record contains a list of fieldnames defining the format of the rest of the file
* Required fieldname is name
* Optional fieldnames are idnumber, description, descriptionformat, visible, context, category, category_id, category_idnumber, category_path
';
$string['visible'] = 'Visible';
$string['visible_help'] = "Any lab can be viewed by users who have 'moodle/cohort:view' capability in the lab context.<br/>
Visible labs can also be viewed by users in the underlying courses.";

$string['institute'] = 'Institute';
