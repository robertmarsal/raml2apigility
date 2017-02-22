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

        $this->getConsole()->blue('Generating Modules...');
        $moduleGenerator = new ModuleGenerator($this->getBasePath());
        $moduleGenerationOutcome = $moduleGenerator->generate($api);

        $this->getConsole()->yellow('Done.');

        return $moduleGenerationOutcome;
    }
}
