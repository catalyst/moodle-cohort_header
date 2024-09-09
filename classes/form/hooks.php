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
 * Cohorts header - Hooks
 *
 * @package   tool_cohortheader
 * @copyright Catalyst IT 2021
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_cohortheader;

defined('MOODLE_INTERNAL') || die();

/**
 * Hook handler class.
 */
class hooks {
    /**
     * Before standard head HTML generation hook handler.
     *
     * @param \core\hook\output\before_standard_head_html_generation $hook
     */
    public static function before_standard_head_html($hook) {
        global $CFG;
        require_once($CFG->dirroot . '/admin/tool/cohortheader/lib.php');

        $additionalhtml = tool_cohortheader_get_additional_html_head();
        if (method_exists($hook, 'add_html')) {
            $hook->add_html($additionalhtml);
        } else {
            echo $additionalhtml;
        }
    }

    /**
     * Before footer hook handler.
     *
     * @param \core\hook\output\before_footer $hook
     */
    public static function before_footer($hook) {
        global $CFG;
        require_once($CFG->dirroot . '/admin/tool/cohortheader/lib.php');

        $additionalhtml = tool_cohortheader_get_additional_html_footer();
        if (method_exists($hook, 'add_html')) {
            $hook->add_html($additionalhtml);
        } else {
            echo $additionalhtml;
        }
    }

    /**
     * Before standard top of body HTML hook handler.
     *
     * @param \core\hook\output\before_standard_top_of_body_html $hook
     */
    public static function before_standard_top_of_body_html($hook) {
        global $CFG;
        require_once($CFG->dirroot . '/admin/tool/cohortheader/lib.php');

        $additionalhtml = tool_cohortheader_get_additional_html_body();
        if (method_exists($hook, 'add_html')) {
            $hook->add_html($additionalhtml);
        } else {
            echo $additionalhtml;
        }
    }
}