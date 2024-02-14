<?php
require_once(__DIR__ . '/../vendor/autoload.php');
include 'devcycle.php';

// Import the DevCycleUser class from the DevCycle SDK. This class is used to create user objects for feature flag evaluations.
use DevCycle\Model\DevCycleUser;

// Import the EvaluationContext class from the OpenFeature SDK. This class is used to provide context for feature flag evaluations.
use OpenFeature\implementation\flags\EvaluationContext;
use OpenFeature\implementation\flags\Attributes;

// Retrieve an instance of the DevCycle client. This client is used to interact with the DevCycle feature flagging service.
$devcycle_client = get_devcycle_client();

// Retrieve an instance of the OpenFeature client. This client is used to interact with the OpenFeature feature flagging abstraction layer.
$openfeature_client = get_openfeature_client();

// Create a new user attribute object that cand be used by OpenFeature as part of the flag evaluation process.
$user_attributes = new Attributes(array("user_id" => "my-user"));

// Create a new evaluation context for the feature flag evaluations. This context is used to provide user or environment details for flag evaluations in OpenFeature.
$openfeature_context = new EvaluationContext(attributes: $user_attributes);

// Create a user object that can be used by the DevCycle client for feature flag evaluations.
$devcycle_user_data = DevCycleUser::FromEvaluationContext($openfeature_context);

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