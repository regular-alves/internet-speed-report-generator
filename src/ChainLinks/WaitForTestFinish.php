<?php

namespace EmbassyChecker\ChainLinks;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class WaitForTestFinish extends Handler
{
    public function handle(RemoteWebDriver $driver, array $data)
    {
        while (!$this->getUploadSpeed($driver)) {
            sleep(3);
        }

        $data['download'] = $this->getDownloadSpeed($driver);
        $data['upload'] = $this->getUploadSpeed($driver);

        $this->callNext($driver, $data);
    }

    private function getElementText(RemoteWebDriver $driver, string $el): string
    {
        return $driver
            ->findElement(WebDriverBy::cssSelector($el))
            ->getText();
    }

    private function getUploadSpeed(RemoteWebDriver $driver): float
    {
        return (float) $this->getElementText($driver, '.fa.fa-cloud-upload ~ .textao');
    }

    private function getDownloadSpeed(RemoteWebDriver $driver): float
    {
        return (float) $this->getElementText($driver, '.fa.fa-cloud-download ~ .textao');
    }
}
