<?php
// This file keeps track of upgrades to
// the assignment module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installation to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class
//
// Please do not forget to use upgrade_set_timeout()
// before any action that may take longer time to finish.

defined('MOODLE_INTERNAL') || die();
function xmldb_local_batch_upgrade($oldversion) {
    global $CFG,$DB;
    $dbman = $DB->get_manager();
    if ($oldversion < 2022020301) {
        $table = new xmldb_table('batch_student_details');

        $table->add_field('id', XMLDB_TYPE_INTEGER, '11', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('batch_id', XMLDB_TYPE_INTEGER, '11', null, null, null, null);
        $table->add_field('user_id', XMLDB_TYPE_CHAR, '255', null, null, null, null);
        $table->add_field('batch_code', XMLDB_TYPE_CHAR, '', null, null, null, null);
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        upgrade_plugin_savepoint(true, 2022020301, 'local', 'batch');
    }

    if ($oldversion < 2022020302) {
        $table = new xmldb_table('batch_student_details');
        $field1 = new xmldb_field('created_on', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'batch_code');
        $field2 = new xmldb_field('updated_on', XMLDB_TYPE_CHAR, '255', null, null, null, null, 'created_on');
        
        if (!$dbman->field_exists($table, $field1)) {
            $dbman->add_field($table, $field1);
        }
         if (!$dbman->field_exists($table, $field2)) {
            $dbman->add_field($table, $field2);
        }
         
       
        upgrade_plugin_savepoint(true, 2022020302, 'local', 'batch_student_details');
    }

    
    return true;
}