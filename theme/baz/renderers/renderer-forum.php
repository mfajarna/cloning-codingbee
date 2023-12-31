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

defined('MOODLE_INTERNAL') || die();

//FORUM
include_once($CFG->dirroot . "/mod/forum/renderer.php");
class theme_baz_mod_forum_renderer extends plugin_renderer_base {
    /**
     * Returns the navigation to the previous and next discussion.
     *
     * @param mixed $prev Previous discussion record, or false.
     * @param mixed $next Next discussion record, or false.
     * @return string The output.
     */
    public function neighbouring_discussion_navigation($prev, $next) {
        $html = '';
        if ($prev || $next) {
            $html .= html_writer::start_tag('div', array('class' => 'discussion-nav clearfix'));
            $html .= html_writer::start_tag('ul');
            if ($prev) {
                $url = new moodle_url('/mod/forum/discuss.php', array('d' => $prev->id));
                $html .= html_writer::start_tag('li', array('class' => 'prev-discussion'));
                $html .= html_writer::link($url, ' ' . format_string($prev->name),
                    array('aria-label' => get_string('prevdiscussiona', 'mod_forum', format_string($prev->name)),
                    'class' => 'btn btn-secondary text-truncate rui-forum-nav-btns'));
                $html .= html_writer::end_tag('li');
            }
            if ($next) {
                $url = new moodle_url('/mod/forum/discuss.php', array('d' => $next->id));
                $html .= html_writer::start_tag('li', array('class' => 'next-discussion'));
                $html .= html_writer::link($url, format_string($next->name),
                    array('aria-label' => get_string('nextdiscussiona', 'mod_forum', format_string($next->name)),
                    'class' => 'btn btn-secondary text-truncate rui-forum-nav-btns'));
                $html .= html_writer::end_tag('li');
            }
            $html .= html_writer::end_tag('ul');
            $html .= html_writer::end_tag('div');
        }
        return $html;
    }

    /**
     * TODO: Try to improve this UI -> Manage forum subscribers
     * This method is used to generate HTML for a subscriber selection form that
     * uses two user_selector controls
     *
     * @param user_selector_base $existinguc
     * @param user_selector_base $potentialuc
     * @return string
     */
    public function subscriber_selection_form(user_selector_base $existinguc, user_selector_base $potentialuc) {
        $output = '';
        $formattributes = array();
        $formattributes['id'] = 'subscriberform';
        $formattributes['action'] = '';
        $formattributes['method'] = 'post';
        $output .= html_writer::start_tag('form', $formattributes);
        $output .= html_writer::empty_tag('input', array('type'=>'hidden', 'name'=>'sesskey', 'value'=>sesskey()));

        $existingcell = new html_table_cell();
        $existingcell->text = $existinguc->display(true);
        $existingcell->attributes['class'] = 'existing';
        $actioncell = new html_table_cell();
        $actioncell->text  = html_writer::start_tag('div', array());
        $actioncell->text .= html_writer::empty_tag('input', array('type'=>'submit', 'name'=>'subscribe', 'value'=>get_string('add'), 'class'=>'actionbutton btn btn-success'));
        $actioncell->text .= html_writer::empty_tag('input', array('type'=>'submit', 'name'=>'unsubscribe', 'value'=>get_string('remove'), 'class'=>'actionbutton btn btn-danger'));
        $actioncell->text .= html_writer::end_tag('div', array());
        $actioncell->attributes['class'] = 'actions px-3';
        $potentialcell = new html_table_cell();
        $potentialcell->text = $potentialuc->display(true);
        $potentialcell->attributes['class'] = 'potential';


        $output .= html_writer::start_tag('fieldset', array('class'=>'w-100'));
        $table = new html_table();
        $table->attributes['class'] = 'subscribertable boxaligncenter mb-2 border-bottom';
        $table->data = array(new html_table_row(array($existingcell, $actioncell, $potentialcell)));
        $output .= html_writer::table($table);
        $output .= html_writer::end_tag('fieldset');

        $output .= html_writer::end_tag('form');
        return $output;
    }

    /**
     * This function generates HTML to display a subscriber overview, primarily used on
     * the subscribers page if editing was turned off
     *
     * @param array $users
     * @param object $forum
     * @param object $course
     * @return string
     */
    public function subscriber_overview($users, $forum , $course) {
        $output = '';
        $modinfo = get_fast_modinfo($course);
        if (!$users || !is_array($users) || count($users)===0) {
            $output .= $this->output->heading(get_string("nosubscribers", "forum"));
        } else if (!isset($modinfo->instances['forum'][$forum->id])) {
            $output .= $this->output->heading(get_string("invalidmodule", "error"));
        } else {
            $cm = $modinfo->instances['forum'][$forum->id];
            $canviewemail = in_array('email', get_extra_user_fields(context_module::instance($cm->id)));
            $strparams = new stdclass();
            $strparams->name = format_string($forum->name);
            $strparams->count = count($users);
            $output .= $this->output->heading(get_string("subscriberstowithcount", "forum", $strparams), 3);
            $table = new html_table();
            $table->cellpadding = 5;
            $table->cellspacing = 5;
            $table->tablealign = 'center';
            $table->data = array();
            foreach ($users as $user) {
                $info = array($this->output->user_picture($user, array('courseid'=>$course->id)), fullname($user));
                if ($canviewemail) {
                    array_push($info, $user->email);
                }
                $table->data[] = $info;
            }
            $output .= html_writer::table($table);
        }
        return $output;
    }

    /**
     * This is used to display a control containing all of the subscribed users so that
     * it can be searched
     *
     * @param user_selector_base $existingusers
     * @return string
     */
    public function subscribed_users(user_selector_base $existingusers) {
        $output  = $this->output->box_start('subscriberdiv boxaligncenter');
        $output .= html_writer::tag('p', get_string('forcesubscribed', 'forum'));
        $output .= $existingusers->display(true);
        $output .= $this->output->box_end();
        return $output;
    }

    /**
     * Create the inplace_editable used to select forum digest options.
     *
     * @param   stdClass    $forum  The forum to create the editable for.
     * @param   int         $value  The current value for this user
     * @return  inplace_editable
     */
    public function render_digest_options($forum, $value) {
        $options = forum_get_user_digest_options();
        $editable = new \core\output\inplace_editable(
            'mod_forum',
            'digestoptions',
            $forum->id,
            true,
            $options[$value],
            $value
        );

        $editable->set_type_select($options);

        return $editable;
    }
}