<?php
namespace local_registration_form\form;

defined('MOODLE_INTERNAL') || die();
require_once("$CFG->libdir/formslib.php");

class registration extends \moodleform {
    public function definition() {
        $mform = $this->_form;

        // Email (Username)
        $mform->addElement('text', 'email', get_string('email', 'local_registration_form'));
        $mform->setType('email', PARAM_EMAIL);
        $mform->addRule('email', null, 'required', null, 'client');

        // First Name
        $mform->addElement('text', 'firstname', get_string('firstname', 'local_registration_form'));
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->addRule('firstname', null, 'required', null, 'client');

        // Surname
        $mform->addElement('text', 'lastname', get_string('lastname', 'local_registration_form'));
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->addRule('lastname', null, 'required', null, 'client');

        // Country
        $countries = get_string_manager()->get_list_of_countries();
        $mform->addElement('select', 'country', get_string('country', 'local_registration_form'), $countries);
        $mform->addRule('country', null, 'required', null, 'client');

        // Mobile Number
        $mform->addElement('text', 'phone', get_string('phone', 'local_registration_form'));
        $mform->setType('phone', PARAM_TEXT);
        $mform->addRule('phone', null, 'required', null, 'client');

        // Submit Button
        $mform->addElement('submit', 'submitbutton', get_string('submit', 'local_registration_form'));
    }
}