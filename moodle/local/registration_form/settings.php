<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_registration_form', get_string('pluginname', 'local_registration_form'));
    $ADMIN->add('localplugins', $settings);
}