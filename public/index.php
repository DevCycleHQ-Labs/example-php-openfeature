<?php
require_once(__DIR__ . '/../vendor/autoload.php');
include 'devcycle.php';

// Import the DevCycleUser class from the DevCycle SDK. This class is used to create user objects for feature flag evaluations.
use DevCycle\Model\DevCycleUser;
// Import the EvaluationContext class from the OpenFeature SDK. This class is used to provide context for feature flag evaluations.
use OpenFeature\implementation\flags\EvaluationContext;

// Retrieve an instance of the DevCycle client. This client is used to interact with the DevCycle feature flagging service.
$devcycle_client = get_devcycle_client();

// Create a new DevCycleUser object with the specified user ID. This object represents a user for whom feature flags will be evaluated.
$devcycle_user_data = new DevCycleUser(array(
  "user_id" => "my-user" // The unique identifier for the user.
));

// Retrieve an instance of the OpenFeature client. This client is used to interact with the OpenFeature feature flagging abstraction layer.
$openfeature_client = get_openfeature_client();

// Instantiate a new EvaluationContext object with 'devcycle_user_data' as its parameter. However, this seems to be a misuse or a typo,
// as typically, the EvaluationContext should be instantiated with an array or similar structure representing the context, not a string.
// If 'devcycle_user_data' is intended to be used as context, it should be passed directly as an object or its data extracted into an array,
// not passed as a string literal.
$openfeature_context = new EvaluationContext('devcycle_user_data');


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="/images/favicon.svg">
  <link rel="stylesheet" href="/styles/main.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevCycle PHP Example</title>
</head>

<body>
  <div class="App">
    <div class="App-header">
      <p>Demo Application</p>
      <img height="46" src="/images/devcycle-togglebot-full-colour.svg" alt="DevCycle" />
    </div>

    <div class="App-wrapper">
      <?php include('togglebot.php'); ?>
      <?php include('description.php'); ?>
    </div>

    <p>Reload the page to view changes.</p>

    <a class="App-link" href="https://docs.devcycle.com/sdk/server-side-sdks/php/" target="_blank" rel="noopener noreferrer">
      DevCycle PHP SDK Docs
    </a>
  </div>
</body>

</html>