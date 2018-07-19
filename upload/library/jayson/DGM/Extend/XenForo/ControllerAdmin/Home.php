<?php
class jayson_DGM_Extend_XenForo_ControllerAdmin_Home extends XFCP_jayson_DGM_Extend_XenForo_ControllerAdmin_Home {
    public function actionIndex() {
        $parent = parent::actionIndex();
        $admin = XenForo_Application::getSimpleCacheData('debugAdmin');
        $public = XenForo_Application::getSimpleCacheData('debugPublic');
        $adminRestrict = XenForo_Application::getSimpleCacheData('debugAdminRestrict');
        $parent->params['debugStatus'] = array('admin' => $admin, 'public' => $public);
        return $parent;
    }
}