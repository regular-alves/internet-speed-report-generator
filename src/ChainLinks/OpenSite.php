<?php

namespace EmbassyChecker\ChainLinks;

use EmbassyChecker\Exceptions\TimeSpotSoonerNotAvailable;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class OpenSite extends Handler
{
    public function handle(RemoteWebDriver $driver, array $data)
    {
        $driver->get('https://www.brasilbandalarga.com.br/');

        $this->callNext($driver, $data);
    }
}
