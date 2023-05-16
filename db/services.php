<?php
/**
 * Delete Record.
 *
 * @package    local_upcommingcourse
 * @copyright  2023 Tarekul Islam
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(
    'local_upcommingcourse_delete_entry_by_id' => array(
        'classname' => 'local_upcommingcourse_external',
        'methodname' => 'delete_entry_by_id',
        'classpath' => 'local/upcommingcourse/external.php',
        'description' => 'Delete a single score by id',
        'type' => 'write',
        'ajax' => true,
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    ),
    'local_upcommingcourse_get_data' => array(
        'classname' => 'local_upcommingcourse_external',
        'methodname' => 'get_all_data',
        'classpath' => 'local/upcommingcourse/external.php',
        'description' => 'Fetch all data from database',
        'type' => 'read',
        'ajax' => true,
        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE),
    )

);