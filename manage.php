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


$PAGE->set_url(new moodle_url("/local/upcommingcourse/manage.php"));
$PAGE->set_title("Upcomming Courses Announcement Manager");
$PAGE->set_context(\context_system::instance());

global $DB;
echo $OUTPUT->header();

$type = ['Programming', 'Design', 'Social', 'Science'];
$info = $DB->get_records('upcommingcourse');

$textContext = (object) [

  'messages' => array_values($info),
  'editpage' => new moodle_url("/local/upcommingcourse/inputEdit.php"),


];
echo $OUTPUT->render_from_template('local_upcommingcourse/manage', $textContext);
if (isset($_GET['did'])) {
  $DB->delete_records('upcommingcourse', ['id' => $_GET['did']]);
}

echo $OUTPUT->footer();