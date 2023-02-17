<?php

use Dotenv\Dotenv;
use EmbassyChecker\ChainLinks\{
    InitTest,
    OpenSite,
    SaveResultToFile,
    WaitForTestFinish,
};
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Exception\{
  NoSuchElementException,
  TimeoutException,
};
use Facebook\WebDriver\Remote\{
  DesiredCapabilities,
  RemoteWebDriver,
};

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$ops = new ChromeOptions();
$capabilities = DesiredCapabilities::chrome();

$ops->addArguments(
    [
        '--user-agent=' .
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) ' .
        'AppleWebKit/537.36 (KHTML, like Gecko) ' .
        'Chrome/87.0.4324.104 Safari/537.36'
    ]
);

$ops->setExperimentalOption('excludeSwitches', [ 'enable-automation' ]);
$capabilities->setCapability(ChromeOptions::CAPABILITY, $ops);

$driver = RemoteWebDriver::create($_ENV['WEBDRIVER_LOCATION'], $capabilities);

// Setup-ing chain
$openSite = new OpenSite();
$initTest = new InitTest();
$waitForTestFinish = new WaitForTestFinish();
$saveResultToFile = new SaveResultToFile();

$openSite->setNext($initTest);
$initTest->setNext($waitForTestFinish);
$waitForTestFinish->setNext($saveResultToFile);

try {
    $openSite->handle(
        $driver,
        ['file_location' => $_ENV['FILE_LOCATION'] ?? './results.csv']
    );
} catch (Throwable $throw) {
    echo $throw->getMessage();
} finally {
    $driver->quit();
}
