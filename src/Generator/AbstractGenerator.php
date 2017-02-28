<?php
declare(strict_types = 1);

namespace Raml2Apigility\Generator;

use League\CLImate\CLImate;
use Zend\I18n\Filter\Alpha as AlphaFilter;

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

    protected function filterModuleName(string $name): string
    {
        return (new AlphaFilter())->filter($name);
    }
}
