<?php

defined('MOODLE_INTERNAL') || die();

function local_registration_form_extend_navigation(global_navigation $nav) {
    $node = $nav->add(
        get_string('pluginname', 'local_registration_form'),
        new moodle_url('/local/registration_form/index.php'),
        navigation_node::TYPE_CUSTOM,
        'registration_form',
        'local_registration_form'
    );
}