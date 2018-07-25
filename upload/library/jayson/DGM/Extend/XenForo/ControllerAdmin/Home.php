<?php
class jayson_DGM_Extend_XenForo_ControllerAdmin_Home extends XFCP_jayson_DGM_Extend_XenForo_ControllerAdmin_Home {
    public function actionIndex() {
        $parent = parent::actionIndex();
        $debugModeStatus = XenForo_Application::getSimpleCacheData('debugModeStatus');
        $parent->params['debugStatus'] = $debugModeStatus;
        return $parent;
    }
}