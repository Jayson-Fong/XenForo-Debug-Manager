<?php
class jayson_DGM_Extend_XenForo_ControllerAdmin_Tools extends XFCP_jayson_DGM_Extend_XenForo_ControllerAdmin_Tools {
    public function actionDebugToggle() {
        $this->_assertPostOnly();
        $this->assertAdminPermission('modifyDebugModeState');
        $admin = $this->_input->filterSingle('debug_admin', XenForo_Input::UINT);
        $public = $this->_input->filterSingle('debug_public', XenForo_Input::UINT);
        $restrict = $this->_input->filterSingle('debug_restrict', XenForo_Input::UINT);
        $restrictDisable = $this->_input->filterSingle('debug_restrict_disable', XenForo_Input::UINT);
        $clear = $this->_input->filterSingle('debug_restrict_clear', XenForo_Input::UINT);
        $addRegister = $this->_input->filterSingle('debug_add', XenForo_Input::UINT);
        $debugModeStatus = XenForo_Application::getSimpleCacheData('debugModeStatus');
        $registeredIps = $debugModeStatus['registeredIps'];
        if ($addRegister) {
            if (!is_array($registeredIps)) {
                $registeredIps = array();
            }
            if (!in_array($_SERVER['REMOTE_ADDR'], $registeredIps)) {
                $registeredIps[] = $_SERVER['REMOTE_ADDR'];
            }
        } elseif ($clear) {
            $registeredIps = array();
        }
        $debugModeStatus = array('admin' => $admin, 'public' => $public, 'restrict' => $restrict, 'registeredIps' => $registeredIps, 'restrictDisable' => $restrictDisable);
		XenForo_Application::setSimpleCacheData('debugModeStatus', $debugModeStatus);
		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::RESOURCE_CANONICAL,
			XenForo_Link::buildAdminLink('index')
		);
    }
}