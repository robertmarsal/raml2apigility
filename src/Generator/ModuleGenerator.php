<?php
declare(strict_types = 1);

namespace Raml2Apigility\Generator;

use Raml\ApiDefinition;
use Zend\ModuleManager\ModuleManager;
use ZF\Apigility\Admin\Model\ModuleEntity;
use ZF\Apigility\Admin\Model\ModuleModel;
use ZF\Apigility\Admin\Model\ModulePathSpec;
use ZF\Apigility\Admin\Model\RestServiceModel;
use ZF\Configuration\ConfigResource;
use ZF\Configuration\ModuleUtils;

final class ModuleGenerator extends AbstractGenerator
{
    public function generate(ApiDefinition $api): bool
    {
        $moduleName = $this->filterModuleName($api->getTitle());

        $moduleManager = new ModuleManager(
            include $this->getBasePath() . '/config/modules.config.php'
        );
        $moduleUtils = new ModuleUtils($moduleManager);

        $moduleModel = new ModuleModel(
            $moduleManager,
            [],
            []
        );
        $moduleModel->setUseShortArrayNotation(true);

        $modulePathSpec = new ModulePathSpec(
            $moduleUtils,
            ModulePathSpec::PSR_4,
            $this->getBasePath()
        );

        $moduleModel->createModule($moduleName, $modulePathSpec);

        $moduleEntity = new ModuleEntity($moduleModel->getModule($moduleName)->getNamespace());

        // @TODO generate sub-resources
        $resources = $api->getResources();

        $restServiceModel = new RestServiceModel(
            $moduleEntity,
            $modulePathSpec,
            new ConfigResource([])
        );
        foreach ($resources as $resource) {
            $restServiceEntity = new RestServiceEntity();
            $restServiceEntity->exchangeArray([
                'module'      => $this->filterModuleName($api->getTitle()),
                'servicename' => $resource->getDisplayName(),
            ]);

            $restServiceModel->createService($restServiceEntity);
        }

        return true;
    }
}
