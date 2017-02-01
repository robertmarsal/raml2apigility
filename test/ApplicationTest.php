<?php
declare(strict_types = 1);

namespace Raml2ApigilityTest;

use PHPUnit\Framework\TestCase;
use Raml2Apigility\Application;

class ApplicationTest extends TestCase
{
    public function testConstructStoresTheDependencies()
    {
        $ramlSpecificationPathMock = '/test/path.raml';
        $apigilityProjectPathMock  = '/another/path';

        $application = new Application(
            $ramlSpecificationPathMock,
            $apigilityProjectPathMock
        );

        // Assertions
        $this->assertAttributeEquals(
            $ramlSpecificationPathMock,
            'ramlSpecificationPath',
            $application
        );

        $this->assertAttributeEquals(
            $apigilityProjectPathMock,
            'apigilityProjectPath',
            $application
        );
    }
}
