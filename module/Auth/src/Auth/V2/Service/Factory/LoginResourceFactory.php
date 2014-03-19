<?php

namespace Auth\V2\Rest\Service\Factory;
//namespace Auth\V2\Rest\Login;
class LoginResourceFactory
{
    public function __invoke($services)
    {
        $config = array();

        if ($services->has('Config')) {
            $allConfig = $services->get('Config');
            if (isset($allConfig['upsservice'])) {
                $config = $allConfig['upsservice'];
            }
        }
        return new LoginResource($config);
    }
}