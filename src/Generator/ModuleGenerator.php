<?php
namespace Raml2Apigility\Generator;

use Raml\ApiDefinition;

final class ModuleGenerator implements GeneratorInterface
{
    private $basePath;
    private $api;

    public function __construct($basePath, ApiDefinition $api)
    {
        $this->basePath = $basePath;
        $this->api      = $api;
    }

    public function generate(ApiDefinition $api): bool
    {
        
    }
}
