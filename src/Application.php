<?php
declare(strict_types = 1);

namespace Raml2Apigility;

use Raml\Parser as RamlParser;
use Raml2Apigility\Generator\ProjectGenerator as ApigilityProjectGenerator;

final class Application
{
    private $ramlSpecificationPath;
    private $apigilityProjectPath;

    /**
     * Application constructor.
     *
     * @param string $ramlSpecificationPath
     * @param string $apigilityProjectPath
     */
    public function __construct(
        string $ramlSpecificationPath,
        string $apigilityProjectPath
    ) {
        $this->ramlSpecificationPath = $ramlSpecificationPath;
        $this->apigilityProjectPath  = $apigilityProjectPath;
    }

    /**
     * Parse the RAML specification and generate the Apigility scaffolding based
     * on it.
     */
    public function run()
    {
        $ramlParser = new RamlParser();
        $api = $ramlParser->parse($this->ramlSpecificationPath);

        $apigilityProject = new ApigilityProjectGenerator($this->apigilityProjectPath);
        $apigilityProject->generate($api);
    }
}
