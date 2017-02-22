<?php
declare(strict_types=1);

namespace Raml2Apigility\Generator;

use League\CLImate\CLImate;

abstract class AbstractGenerator implements GeneratorInterface
{
    private $basePath;
    private $console;

    public function __construct(string $basePath, CLImate $console = null)
    {
        $this->basePath = $basePath;
        $this->console  = $console;
    }

    protected function getBasePath(): string
    {
        return $this->basePath;
    }

    protected function getConsole(): CLImate
    {
        return $this->console instanceof CLImate ? $this->console : new CLImate();
    }
}
