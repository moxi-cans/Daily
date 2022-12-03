<?php

declare(strict_types=1);

require_once "AbstractDesktopFile.php";

require_once "RealDesktopFile.php";

class DesktopFileProxy
{
    protected AbstractDesktopFile $desktopFile;

    protected string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function execute(): void
    {
        if (!isset($this->desktopFile)) {
            $this->desktopFile = new RealDesktopFile($this->fileName);
        }
        $this->desktopFile->execute();
    }
}