<?php
declare(strict_types = 1);

namespace Raml2ApigilityTest\Unit\Generator;

use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit\Framework\TestCase;
use Raml2Apigility\Generator\ProjectGenerator;

class ProjectGeneratorTest extends TestCase
{
    public function setUp()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(
            new vfsStreamDirectory('test')
        );
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage The specified Apigility directory is not a valid Apigility Project!
     */
    public function testValidateWillThrowAnExceptionIfBaseDirectoriesAreMissing()
    {
        $projectGenerator = new ProjectGenerator('test');
        $projectGenerator->validate();
    }
}
