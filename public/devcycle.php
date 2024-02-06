<?php


use DevCycle\Api\DevCycleClient;
use DevCycle\Model\DevCycleOptions;
use OpenFeature\OpenFeatureAPI;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$options = new DevCycleOptions(true);

$devcycle_client = new DevCycleClient(
    sdkKey: $_ENV["DEVCYCLE_SERVER_SDK_KEY"],
    dvcOptions: $options
);

$api = OpenFeatureAPI::getInstance();

$api->setProvider($devcycle_client->getOpenFeatureProvider());

$openfeature_client = $api->getClient();


function get_devcycle_client()
{
    global $devcycle_client;
    return $devcycle_client;
}

function get_openfeature_client()
{
    global $openfeature_client;
    return $openfeature_client;
}
