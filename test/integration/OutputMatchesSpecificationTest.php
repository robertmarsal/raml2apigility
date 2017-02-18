<?php
declare(strict_types = 1);

namespace Raml2ApigilityTest\Integration;

use PHPUnit\Framework\TestCase;
use Raml2Apigility\Application;

final class OutputMatchesSpecificationTest extends TestCase
{
    /**
     * @dataProvider specsDataProvider
     */
    public function testApplicationOutputMatchesSpecification(
        string $spec,
        array $expected
    ) {
        $outputDirectory = sys_get_temp_dir() . '/' . uniqid(basename($spec));

        $this->mockApigilityProject($outputDirectory);

        // Run the application
        $application = new Application($spec, $outputDirectory);
        $application->run();

        // Test the API module was created
        $this->assertDirectoryExists($outputDirectory . '/module/' . $expected['moduleName']);

        // The the API version is correct
        $this->assertDirectoryExists(
            $outputDirectory . '/module/' . $expected['moduleName'] . '/src/' . $expected['version']
        );
    }

    public function specsDataProvider(): array
    {
        return [
            [
                __DIR__ . '/_fixtures/specs/spec-01.raml',
                [
                    'moduleName' => 'TestAPI',
                    'version'    => 'V1',
                ],
            ]
        ];
    }

    /**
     * @param string $directory
     *
     * @return bool
     */
    private function mockApigilityProject(string $directory): bool
    {
        // Create the main directory
        mkdir($directory);

        // Create the config directory
        mkdir($directory . '/config');

        // Copy fixture config files
        copy(
            __DIR__ . '/_fixtures/config/modules.config.php',
            $directory . '/config/modules.config.php'
        );
        copy(
            __DIR__ . '/_fixtures/config/application.config.php',
            $directory . '/config/application.config.php'
        );

        // Create the module directory
        mkdir($directory . '/module');

        return true;
    }
}
