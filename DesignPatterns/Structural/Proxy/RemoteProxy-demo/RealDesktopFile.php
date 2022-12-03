<?php

declare(strict_types=1);

require_once "AbstractDesktopFile.php";

class RealDesktopFile extends AbstractDesktopFile
{
    protected string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function execute(): void
    {
        echo "Executing {$this->fileName} file" . PHP_EOL;
    }
}