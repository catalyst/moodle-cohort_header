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
 * Cohorts header - Hooks definition
 *
 * @package   tool_cohortheader
 * @copyright Catalyst IT 2021
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$hooks = [
    [
        'hook' => \core\hook\output\before_standard_head_html_generation::class,
        'callback' => [\tool_cohortheader\hooks::class, 'before_standard_head_html'],
    ],
    [
        'hook' => \core\hook\output\before_footer::class,
        'callback' => [\tool_cohortheader\hooks::class, 'before_footer'],
    ],
    [
        'hook' => \core\hook\output\before_standard_top_of_body_html_generation::class,
        'callback' => [\tool_cohortheader\hooks::class, 'before_standard_top_of_body_html'],
    ],
];