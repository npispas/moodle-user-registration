<?php

use core\output\notification;
use local_registration_form\form\registration;

require_once('../../config.php');
require_once($CFG->dirroot . '/local/registration_form/classes/form/registration.php');
require_once($CFG->libdir . '/moodlelib.php');

global $DB, $OUTPUT, $PAGE, $CFG;

// Set up page
$PAGE->set_url(new moodle_url('/local/registration_form/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_registration_form'));
$PAGE->set_heading(get_string('pluginname', 'local_registration_form'));

$mform = new registration();

// Process Form Submission
if ($mform->is_cancelled()) {
    redirect(new moodle_url('/'));
} else if ($data = $mform->get_data()) {
    // Generate a temporary password
    $temp_password = generate_random_password();

    // Create Moodle user
    $user = new stdClass();
    $user->auth = 'manual';
    $user->username = $data->email;
    $user->password = hash_internal_user_password($temp_password);
    $user->firstname = $data->firstname;
    $user->lastname = $data->lastname;
    $user->email = $data->email;
    $user->phone1 = $data->phone;
    $user->country = $data->country;
    $user->confirmed = 1;
    $user->timecreated = time();
    $user->timemodified = time();
    $user->mnethostid = $CFG->mnet_localhost_id;
    $user->policyagreed = 1;

    // Insert user into Moodle's mdl_user table
    $user_id = $DB->insert_record('user', $user);

    // Retrieve the fully stored user object (WITH the assigned ID)
    $user = $DB->get_record('user', ['id' => $user_id]);

    // Force user to change password on first login
    set_user_preference('auth_forcepasswordchange', 1, $user_id);

    // Send email with temp password
    send_verification_email($user, $temp_password);

    // Redirect to login
    redirect(new moodle_url('/login/index.php'), get_string('success_message', 'local_registration_form'), null, notification::NOTIFY_SUCCESS);
}

// Output Page
echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();

// Generate a random password
function generate_random_password($length = 10) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

// Send verification email
function send_verification_email($user, $temp_password) {
    global $CFG;

    $subject = "Your Moodle Account - Temporary Password";
    $message = "Hello {$user->firstname},\n\n";
    $message .= "Your Moodle account has been created. Please use these credentials to log in:\n";
    $message .= "Username: {$user->email}\n";
    $message .= "Temporary Password: $temp_password\n\n";
    $message .= "Login here: " . $CFG->wwwroot . "/login/index.php\n\n";

    email_to_user($user, (object)['email' => $CFG->supportemail], $subject, $message);
}