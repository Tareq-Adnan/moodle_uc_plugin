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
 * Version information
 *
 * @package    local_upcommingcourse
 * @copyright  2023 Tarekul Islam
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');
require_once('./lib.php');
require_once($CFG->dirroot . '/local/upcommingcourse/classes/form/inputForm.php');

$id = optional_param('id', 0, PARAM_INT);
$PAGE->set_url(new moodle_url('/local/upcommingcourse/inputEdit.php', ['id' => $id]));
$PAGE->set_title("Entry Data");
$PAGE->set_context(\context_system::instance());


$form = new inputForm();

global $DB;
if ($form->is_cancelled()) {

    //back to manage page
    redirect($CFG->wwwroot . '/local/upcommingcourse/manage.php', "");
} else if ($fromform = $form->get_data()) {
    $data = new stdClass();
    $data->title = $fromform->title;
    $data->description = $fromform->description;
    $data->type = $fromform->type;

    if ($fromform->id !="") {

        $data->id = $fromform->id;
        $DB->update_record('upcommingcourse', $data);
        redirect($CFG->wwwroot . '/local/upcommingcourse/manage.php', "Data Updated.");

    } else {
        $DB->insert_record('upcommingcourse', $data);
        redirect($CFG->wwwroot . '/local/upcommingcourse/manage.php', "New Announcement of Add Has been added.");

    }


}


echo $OUTPUT->header();
echo "<table class='table table-bordered'>";
echo "<h1 class='bg-info p-2 text-center text-light'>Input Course Details</h1>" . "<hr>";
$form->display();
echo "</table>";
echo $OUTPUT->footer();