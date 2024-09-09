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
 * Cohorts header - lib file
 *
 * @package   tool_cohortheader
 * @copyright Catalyst IT 2021
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/admin/tool/cohortheader/locallib.php');

/**
 * Get additional HTML for head.
 * @return string $line
 */
function tool_cohortheader_get_additional_html_head() {
    $line = '';
    $cohortheaders = tool_cohortheader_get_headers();

    if (!empty($cohortheaders)) {
        foreach ($cohortheaders as $cohortheader) {
            $metaheaders[] = $cohortheader->additionalhtmlhead."\n";
        }
        $line = implode(' ', $metaheaders);
    }

    return $line;
}

/**
 * Get additional HTML for footer.
 * @return string $line
 */
function tool_cohortheader_get_additional_html_footer() {
    $line = '';
    $cohortheaders = tool_cohortheader_get_headers();

    if (!empty($cohortheaders)) {
        foreach ($cohortheaders as $cohortheader) {
            $beforefooter[] = "<span class='tool_cohortheader'>".$cohortheader->additionalhtmlfooter."</span>\n";
        }

        $line = implode(' ', $beforefooter);
    }

    return $line;
}

/**
 * Get additional HTML for top of body.
 * @return string $line
 */
function tool_cohortheader_get_additional_html_body() {
    $line = '';
    $cohortheaders = tool_cohortheader_get_headers();

    if (!empty($cohortheaders)) {
        foreach ($cohortheaders as $cohortheader) {
            $topofbody[] = "<span class='tool_cohortheader'>".$cohortheader->additionalhtmltopofbody."</span>\n";
        }

        $line = implode(' ', $topofbody);
    }

    return $line;
}

// Only define these functions if we're not using the new hook system
if (!class_exists('\core\hook\output\before_standard_head_html_generation')) {
    /**
     * Legacy callback for adding data to head.
     * @return string
     */
    function tool_cohortheader_before_standard_html_head() {
        global $CFG;
        unset($CFG->editingicon);

        return tool_cohortheader_get_additional_html_head();
    }

    /**
     * Legacy callback for adding data to footer.
     * @return string
     */
    function tool_cohortheader_before_footer() {
        global $CFG, $PAGE;
        unset($CFG->editingicon);

        return tool_cohortheader_get_additional_html_footer();
    }

    /**
     * Legacy callback for adding data to top of body.
     * @return string
     */
    function tool_cohortheader_before_standard_top_of_body_html() {
        global $CFG;
        unset($CFG->editingicon);

        return tool_cohortheader_get_additional_html_body();
    }
}