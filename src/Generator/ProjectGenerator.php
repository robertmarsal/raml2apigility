<?php
declare(strict_types = 1);

namespace Raml2Apigility\Generator;

use Exception;
use Raml\ApiDefinition;

final class ProjectGenerator extends AbstractGenerator
{
    /**
     * Validate that the basePath contains an Apigility Project
     *
     * @throws Exception
     */
    public function validate()
    {
        if (!is_dir($this->getBasePath() . '/module') ||
            !is_dir($this->getBasePath() . '/config')
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
        $this->getConsole()->yellow('Generating Apigility Project...');

        $moduleGenerationOutcome  = $this->generateModule($api);
        $serviceGenerationOutcome = $this->generateServices($api);

        $this->getConsole()->yellow('Done.');

        return $moduleGenerationOutcome && $serviceGenerationOutcome;
    }

    /**
     * @param ApiDefinition $api
     *
     * @return bool
     */
    protected function generateModule(ApiDefinition $api): bool
    {
        $this->getConsole()->blue('Generating Module...');

        return (new ModuleGenerator($this->getBasePath()))->generate($api);
    }

    /**
     * @param ApiDefinition $api
     *
     * @return bool
     */
    protected function generateServices(ApiDefinition $api): bool
    {
        $this->getConsole()->blue('Generating Services...');

        return (new ServiceGenerator($this->getBasePath()))->generate($api);
    }
}
