<?php
namespace Raml2Apigility\Generator;

use Exception;
use Raml\ApiDefinition;

final class ProjectGenerator implements GeneratorInterface
{
    private $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;

        $this->validate();
    }

    /**
     * Validate that the basePath contains an Apigility Project
     *
     * @throws Exception
     */
    private function validate()
    {
        if (!is_dir($this->basePath . '/module') ||
            !is_dir($this->basePath . '/config')
        ) {
            throw new Exception('The specified Apigility directory is not a valid Apigility Project!');
        }
    }

    /**
     * @param ApiDefinition $api
     *
     * @return bool
     */
    public function generate(ApiDefinition $api): bool
    {
        // Generate the module
        $moduleGenerator = new ModuleGenerator($this->basePath);
        $moduleGenerationOutcome = $moduleGenerator->generate($api);

        return $moduleGenerationOutcome;
    }
}
