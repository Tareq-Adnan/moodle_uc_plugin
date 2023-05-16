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
 * @package    upcommingcourse
 * @copyright  2023 Tarekul Islam
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

function local_upcommingcourse_before_footer()
{
    global $DB, $USER;
    $type = ['Programming', 'Design', 'Social', 'Science'];

    $sql = "SELECT uc.id, uc.title, uc.description, uc.type FROM {upcommingcourse} uc LEFT OUTER JOIN {upcomming_read} ucr ON uc.id=ucr.messageid WHERE ucr.userid != :sid OR ucr.userid IS NULL ORDER BY uc.id DESC LIMIT 1";
    $param = [
        'sid' => $USER->id,
    ];

    $messsage = $DB->get_records_sql($sql, $param);

    if ($USER->id != 0) {
        foreach ($messsage as $m) {

            \core\notification::add("<h1 class='text-center text-dark'>" . $m->title . "</h1>" . "<p class='text-center'>" . $m->description . "<br>" . "Category: " . $type[(int) $m->type] . "</p>", \core\output\notification::NOTIFY_INFO);

            $readdata = new stdClass();
            $readdata->messageid = $m->id;
            $readdata->userid = $USER->id;
            $readdata->timeread = time();
            $DB->insert_record('upcomming_read', $readdata);
        }
    }
}

/**
 * This function delete a single record.
 *
 * @param int|null $id
 * @return void
 * @throws moodle_exception
 */
function local_upcommingcourse_delete_entry_by_id($id)
{
    global $DB;
    try {
        $DB->delete_records('upcommingcourse', ['id' => $id]);
    } catch (Exception $exception) {
        throw new moodle_exception($exception);
    }
}

function local_upcommingcourse_get_data()
{
    global $DB;

    try {
        $info = $DB->get_records('upcommingcourse');
    //     $data=new stdClass();
    //    // foreach($info as $m){
    //         $data->id=$info->id;
    //         $data->title=$info->title;
    //         $data->description=$info->description;
    //         $data->type=$info->type;
        //}
       // $data = $DB->get_records('upcommingcourse');
        
        return $info;

    } catch (Exception $e) {
        throw new moodle_exception($e);
    }
}