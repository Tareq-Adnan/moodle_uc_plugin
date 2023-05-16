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
 *
 * @package    local_upcommingcourse
 * @copyright  2023
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . "/local/upcommingcourse/lib.php");


class local_upcommingcourse_external extends external_api
{
    /**
     * Returns description of method parameters.
     * @return external_function_parameters
     */
    public static function delete_entry_by_id_parameters(): external_function_parameters
    {
        return new external_function_parameters(
            array(
                'id' => new external_value(PARAM_INT, 'id'),
            )
        );
    }

    /**
     * Delete by id function.
     *
     * @param int $id
     * @return array
     * @throws moodle_exception
     */
    public static function delete_entry_by_id(int $id): array
    {
        global $DB;

        $warnings = array();

        local_upcommingcourse_delete_entry_by_id($id);

        return array(
            'id' => $id,
            'warnings' => $warnings
        );

    }

    /**
     * Returns description of method result value.
     * @return external_description
     */
    public static function delete_entry_by_id_returns()
    {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'id'),
                'warnings' => new external_warnings()
            )
        );
    }


    // fetch_all_data


    /**
     * Returns description of method parameters.
     * @return external_function_parameters
     */
    public static function get_all_data_parameters(): external_function_parameters
    {
        return new external_function_parameters(
            array()
        );
    }

    /**
     * 
     *
     * @param int 
     * @return array
     * @throws moodle_exception
     */
    public static function get_all_data(): array
    {


        // $result = json_decode($data, true);
        $data = local_upcommingcourse_get_data();
        
        $upcomingcourses = [];

        foreach($data as $a){
            array_push($upcomingcourses, $a);  
        }

        // var_dump($result);
        $result = [];
        $result['courseInfo'] = $upcomingcourses;

        return $result;

    }

    /**
     * Returns description of method result value.
     * @return external_description
     */
    public static function get_all_data_returns()
    {
        return new external_single_structure(
            array(
                'courseInfo' => new external_multiple_structure(self::get_data_structure(), 'courseInfo', VALUE_OPTIONAL),
            )
            );
    }

    static function get_data_structure() {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_RAW, 'id', VALUE_OPTIONAL),
                'title' => new external_value(PARAM_RAW, 'title', VALUE_OPTIONAL),
                'description' => new external_value(PARAM_RAW, 'description', VALUE_OPTIONAL),
                'type' => new external_value(PARAM_RAW, 'type', VALUE_OPTIONAL),
                )
        );
    }
}