<?php

// Import the necessary classes from the DevCycle and OpenFeature SDKs.
// DevCycleClient and DevCycleOptions are part of the DevCycle SDK for interacting with its feature flagging system.
// OpenFeatureAPI is a class from the OpenFeature SDK, providing an abstraction layer for feature flagging.
use DevCycle\Api\DevCycleClient;
use DevCycle\Model\DevCycleOptions;
use OpenFeature\OpenFeatureAPI;

// Use the Dotenv library to load environment variables from a .env file located in the parent directory.
// This approach is used to securely manage sensitive information such as API keys.
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Create a new DevCycleOptions object, enabling debug mode or additional logging if true is passed.
$options = new DevCycleOptions(true);

// Initialize the DevCycle client with the server SDK key obtained from environment variables and the previously defined options.
// This client will interact with the DevCycle API for feature flag evaluations.
$devcycle_client = new DevCycleClient(
    sdkKey: $_ENV["DEVCYCLE_SERVER_SDK_KEY"], // The SDK key for authenticating with the DevCycle service.
    dvcOptions: $options // The options configured for the DevCycle client.
);

// Obtain an instance of the OpenFeature API. This is a singleton instance used across the application.
$api = OpenFeatureAPI::getInstance();

// Set the feature flag provider for OpenFeature to be the provider obtained from the DevCycle client.
// This integrates DevCycle with OpenFeature, allowing OpenFeature to use DevCycle for flag evaluations.
$api->setProvider($devcycle_client->getOpenFeatureProvider());

// Retrieve the OpenFeature client from the API instance. This client can be used to evaluate feature flags using the OpenFeature API.
$openfeature_client = $api->getClient();

// Define a function to get the global DevCycle client instance.
// This allows other parts of the application to easily retrieve the configured DevCycle client.
function get_devcycle_client()
{
    global $devcycle_client;
    return $devcycle_client;
}

// Define a function to get the global OpenFeature client instance.
// Similar to the DevCycle client, this provides a convenient way to access the OpenFeature client throughout the application.
function get_openfeature_client()
{
    global $openfeature_client;
    return $openfeature_client;
}
