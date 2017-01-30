<?php
declare(strict_types=1);

namespace Raml2Apigility\Generator;

use Raml\ApiDefinition;

interface GeneratorInterface
{
    public function generate(ApiDefinition $api): bool;
}
