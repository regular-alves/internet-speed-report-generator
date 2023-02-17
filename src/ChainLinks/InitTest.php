<?php

namespace EmbassyChecker\ChainLinks;

use EmbassyChecker\Exceptions\TimeSpotSoonerNotAvailable;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;

class InitTest extends Handler
{
    public function handle(RemoteWebDriver $driver, array $data)
    {
        $initTest = WebDriverBy::id('btnIniciar');

        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
        $this->waitForBeClickable($driver, $initTest);
        $driver->findElement($initTest)->click();

        $this->callNext($driver, $data);
    }
}
