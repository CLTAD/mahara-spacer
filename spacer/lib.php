<?php
/**
 * Mahara: Electronic portfolio, weblog, resume builder and social networking
 * Copyright (C) 2006-2009 Catalyst IT Ltd and others; see:
 *                         http://wiki.mahara.org/Contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    mahara
 * @subpackage blocktype-spacer
 * @author     Mike Kelly UAL m.f.kelly@arts.ac.uk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 *
 */

defined('INTERNAL') || die();

class PluginBlocktypeSpacer extends SystemBlocktype {

    public static function get_title() {
        return get_string('title', 'blocktype.spacer');
    }

    public static function get_description() {
        return get_string('description', 'blocktype.spacer');
    }

    public static function get_categories() {
        return array('general');
    }

    public static function render_instance(BlockInstance $instance, $editing=false) {
        $configdata = $instance->get('configdata');
        $h = (isset($configdata['height'])) ? $configdata['height'] : '50';
        $height = 'height: ' . $h . 'px; ';
        $w = (isset($configdata['width'])) ? $configdata['width'] : '';
        if (strlen($w)>0){
            $width = 'width: ' . $w . 'px;';
        } else {
            $width = '';
        } 
        $text = '<div style="' . $height . $width . '"></div>';
        return clean_html($text);
    }

    public static function has_instance_config() {
        return true;
    }

    public static function instance_config_form($instance) {
        $configdata = $instance->get('configdata');
        return array(
            'howto' => array(
            'type' => 'html',
            'value' => '<p class="description">Leave the Block Title field empty to insert a completely empty space.</p>',
            ),
            'height' => array(
                'type' => 'text',
                'title' => get_string('height', 'blocktype.spacer'),
                'size' => 3,
                'rules' => array(
                    'required' => true,
                    'integer'  => true,
                    'minvalue' => 1,
                    'maxvalue' => 999,
                ),
                'defaultvalue' => (!empty($configdata['height'])) ? $configdata['height'] : '50',
                'description' => get_string('heightdescription', 'blocktype.spacer'),
            ),
            'width' => array(
                'type' => 'text',
                'title' => get_string('width', 'blocktype.spacer'),
                'size' => 3,
                'rules' => array('regex' => '/^(\d{1,4})?$/'),
                'defaultvalue' => (!empty($configdata['width'])) ? $configdata['width'] : '',
                'description' => get_string('widthdescription', 'blocktype.spacer'),
            ),
        );
    }

    public static function default_copy_type() {
        return 'full';
    }
}
?>
