<?php
namespace Auth\V2\Rest\Login;

class LoginResourceFactory
{
    public function __invoke($services)
    {
        $config = array();

        if ($services->has('Config')) {
            $allConfig = $services->get('Config');
            if (isset($allConfig['token'])) {
                $config = $allConfig['token'];
            }
        }
        return new LoginResource($config);
    }
}