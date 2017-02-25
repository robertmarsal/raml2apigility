<?php
declare(strict_types = 1);

namespace Raml2Apigility;

use League\CLImate\CLImate;
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
     *
     * @param CLIMate|null $console
     */
    public function run($console = null)
    {
        $ramlParser = new RamlParser();
        $api = $ramlParser->parse($this->ramlSpecificationPath);

        $apigilityProject = new ApigilityProjectGenerator(
            $this->apigilityProjectPath,
            $console
        );
        $apigilityProject->validate();
        $apigilityProject->generate($api);
    }
}
