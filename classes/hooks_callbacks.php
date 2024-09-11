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

namespace tool_cohortheader;

use core\hook\output\before_standard_head_html_generation;
use core\hook\output\before_standard_top_of_body_html_generation;
use core\hook\output\before_footer_html_generation;

/**
 * Hook callbacks for Cohort Header tool
 *
 * @package   tool_cohortheader
 * @copyright Catalyst IT 2021
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class hooks_callbacks {
    /**
     * Hook callback to add custom HTML to the head.
     *
     * @param before_standard_head_html_generation $hook
     */
    public static function before_standard_head_html(before_standard_head_html_generation $hook): void {
        if (during_initial_install()) {
            return;
        }

        $additionalhtml = self::get_additional_html('additionalhtmlhead');
        if (!empty($additionalhtml)) {
            $hook->add_html($additionalhtml);
        }
    }

    /**
     * Hook callback to add custom HTML to the top of the body.
     *
     * @param before_standard_top_of_body_html_generation $hook
     */
    public static function before_standard_top_of_body_html(before_standard_top_of_body_html_generation $hook): void {
        if (during_initial_install()) {
            return;
        }

        $additionalhtml = self::get_additional_html('additionalhtmltopofbody');
        if (!empty($additionalhtml)) {
            $hook->add_html($additionalhtml);
        }
    }

    /**
     * Hook callback to add custom HTML to the footer.
     *
     * @param before_footer_html_generation $hook
     */
    public static function before_footer_html(before_footer_html_generation $hook): void {
        if (during_initial_install()) {
            return;
        }

        $additionalhtml = self::get_additional_html('additionalhtmlfooter');
        if (!empty($additionalhtml)) {
            $hook->add_html($additionalhtml);
        }
    }

    /**
     * Get additional HTML for the specified section.
     *
     * @param string $section The section to get HTML for (e.g., 'additionalhtmlhead')
     * @return string The additional HTML
     */
    private static function get_additional_html(string $section): string {
        global $DB, $USER;

        $cohortheaders = $DB->get_records_sql(
            "SELECT DISTINCT ch.*
               FROM {tool_cohortheader} ch
               JOIN {tool_cohortheader_cohort} chc ON chc.cohortheaderid = ch.id
               JOIN {cohort_members} cm ON cm.cohortid = chc.cohortid
              WHERE cm.userid = ?",
            [$USER->id]
        );

        $html = '';
        foreach ($cohortheaders as $cohortheader) {
            if (!empty($cohortheader->$section)) {
                $html .= $cohortheader->$section . "\n";
            }
        }

        return $html;
    }
}