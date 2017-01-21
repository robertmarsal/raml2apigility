<?php
namespace Raml2Apigility;

use Raml\Parser as RamlParser;
use Raml2Apigility\Generator\ProjectGenerator as ApigilityProjectGenerator;

final class Application
{
    private $ramlSpecification;
    private $apigilityProjectPath;

    public function __construct($ramlSpecification, $apigilityProjectPath)
    {
        $this->ramlSpecification    = $ramlSpecification;
        $this->apigilityProjectPath = $apigilityProjectPath;
    }

    public function run()
    {
        $ramlParser = new RamlParser();
        $api = $ramlParser->parse($this->ramlSpecification);

        $apigilityProject = new ApigilityProjectGenerator($this->apigilityProjectPath);
        $apigilityProject->generate($api);
    }
}
