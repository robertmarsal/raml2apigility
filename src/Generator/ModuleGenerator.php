<?php
declare(strict_types = 1);

namespace Raml2Apigility\Generator;

use Raml\ApiDefinition;
use Zend\ModuleManager\ModuleManager;
use ZF\Apigility\Admin\Model\ModuleModel;
use ZF\Apigility\Admin\Model\ModulePathSpec;
use Zend\I18n\Filter\Alpha as AlphaFilter;
use ZF\Configuration\ModuleUtils;

final class ModuleGenerator extends AbstractGenerator
{
    public function generate(ApiDefinition $api): bool
    {
        $alphaFilter = new AlphaFilter();

        $namespace = $alphaFilter->filter($api->getTitle());

        $moduleManager = new ModuleManager(
            include $this->getBasePath() . '/config/modules.config.php'
        );
        $moduleUtils = new ModuleUtils($moduleManager);

        $moduleModel = new ModuleModel(
            $moduleManager,
            [],
            []
        );

        $modulePathSpec = new ModulePathSpec(
            $moduleUtils,
            ModulePathSpec::PSR_4,
            $this->getBasePath()
        );

        $moduleModel->createModule($namespace, $modulePathSpec);

        return true;
    }
}
