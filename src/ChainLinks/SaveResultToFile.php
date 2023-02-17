<?php

namespace EmbassyChecker\ChainLinks;

use Exception;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class SaveResultToFile extends Handler
{
    public function handle(RemoteWebDriver $driver, array $data)
    {
        if (empty($data['file_location'])) {
            throw new Exception('File not specified');
        }

        $file = fopen($data['file_location'], 'w+');

        if (!$file) {
            throw new Exception('Error to open file');
        }

        date_default_timezone_set('America/Sao_Paulo');
        fputcsv(
            $file,
            [
                $data['download'],
                $data['upload'],
                date('d/m/Y H:i:s')
            ]
        );

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
