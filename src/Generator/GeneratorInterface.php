<?php
namespace Raml2Apigility\Generator;

use Raml\ApiDefinition;

interface GeneratorInterface
{
    public function generate(ApiDefinition $api): bool;
}
