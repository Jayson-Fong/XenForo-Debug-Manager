<?php
class jayson_DGM_Extend_XenForo_ControllerAdmin_Home extends XFCP_jayson_DGM_Extend_XenForo_ControllerAdmin_Home {
    public function actionIndex() {
        $parent = parent::actionIndex();
        $debugModeStatus = XenForo_Application::getSimpleCacheData('debugModeStatus');
        if (is_array($debugModeStatus)) {
            if (!is_array($debugModeStatus['registeredIps'])) {
                $debugModeStatus['registeredIps'] = array();
            }
            $parent->params['debugStatus'] = array(
                'admin' => $debugModeStatus['admin'],
                'public' => $debugModeStatus['public'],
                'restrict' => $debugModeStatus['restrict'],
                'ipCount' => count($debugModeStatus['registeredIps']),
                'restrictDisable' => $debugModeStatus['restrictDisable']
            );
        }
        return $parent;
    }
}