<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


require __DIR__ . '/calender/vendor/autoload.php';

/*if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}*/

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
  $client = new Google_Client();
  $client->setApplicationName('Google Calendar API PHP Quickstart');
  $client->setScopes(Google_Service_Calendar::CALENDAR);
  $client->setAuthConfig('credentials.json');
  $client->setAccessType('offline');
  $client->setPrompt('select_account consent');

  // Load previously authorized token from a file, if it exists.
  // The file token.json stores the user's access and refresh tokens, and is
  // created automatically when the authorization flow completes for the first
  // time.
  $tokenPath = 'token.json';
  if (file_exists($tokenPath)) {
    $accessToken = json_decode(file_get_contents($tokenPath), true);
    $client->setAccessToken($accessToken);
  }

  // If there is no previous token or it's expired.
  if ($client->isAccessTokenExpired()) {
    // Refresh the token if possible, else fetch a new one.
    if ($client->getRefreshToken()) {
      $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    } else {
      // Request authorization from the user.
      $authUrl = $client->createAuthUrl();
      printf("Open the following link in your browser:\n%s\n", $authUrl);
      print 'Enter verification code: ';
      $authCode = trim(fgets(STDIN));

      // Exchange authorization code for an access token.
      $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
      $client->setAccessToken($accessToken);

      // Check to see if there was an error.
      if (array_key_exists('error', $accessToken)) {
        throw new Exception(join(', ', $accessToken));
      }
    }
    // Save the token to a file.
    if (!file_exists(dirname($tokenPath))) {
      mkdir(dirname($tokenPath), 0700, true);
    }
    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
  }
  return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$reminder_num = $_POST['reminder'];
$email_reminder = $_POST['email_reminder'];
$hour_multiply = 24 * (int)$email_reminder;

/*$reminder_num2=$_POST['reminder2'];
$reminder_num3=$_POST['reminder3'];
$reminder_num4=$_POST['reminder4'];

$email_reminder2=$_POST['email_reminder2'];
$email_reminder3=$_POST['email_reminder3'];
$email_reminder4=$_POST['email_reminder4'];

$radio1=$_POST['yes1'];
$radio2=$_POST['yes2'];
$radio3=$_POST['yes3']; 
$radio4=$_POST['yes4'];
$radio5=$_POST['yes5'];
$radio6=$_POST['yes6'];
$radio7=$_POST['yes7'];
$radio8=$_POST['yes8'];
*/
$optParams = array(
  'maxResults' => 10,
  'orderBy' => 'startTime',
  'singleEvents' => true,
  'timeMin' =>   date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();


$event = new Google_Service_Calendar_Event(array(
  'summary' => $_POST['event_title'],
  'location' => $_POST['location'],
  'description' => $_POST['description'],

  'start' => array(
    'dateTime' => $_POST['start_date'] . ':00',
    'timeZone' => 'Asia/Kolkata',
  ),
  'end' => array(
    'dateTime' => $_POST['end_date'] . ':00',
    'timeZone' => 'Asia/Kolkata',
  ),
  'recurrence' => array(
    'RRULE:FREQ=DAILY;COUNT=2'
  ),
  /*'attendees' => array(
    array('email' => 'lpage@example.com'),
    array('email' => 'sbrin@example.com'),
  ),*/
  'reminders' => array(
    'useDefault' => FALSE,
    'overrides' => array(
      array('method' => 'email', 'minutes' => $hour_multiply * 60),
      array('method' => 'popup', 'minutes' => $reminder_num, 'method' => 'popup', 'minutes' => 120),
    ),

  ),
));

$calendarId = 'primary';
$event = $service->events->insert($calendarId, $event);
printf('Event created: %s\n', $event->htmlLink);



if ($event) {

  //header('location:createEvent.php?created=1');


}
