<?php
class jayson_DGM_Extend_XenForo_ControllerAdmin_Tools extends XFCP_jayson_DGM_Extend_XenForo_ControllerAdmin_Tools {
    public function actionDebugToggle() {
        $this->_assertPostOnly();
        $this->assertAdminPermission('modifyDebugModeState');
        $admin = $this->_input->filterSingle('debug_admin', XenForo_Input::UINT);
        $public = $this->_input->filterSingle('debug_public', XenForo_Input::UINT);
        $debugModeStatus = array('admin' => $admin, 'public' => $public);
		XenForo_Application::setSimpleCacheData('debugModeStatus', $debugModeStatus);
		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::RESOURCE_CANONICAL,
			XenForo_Link::buildAdminLink('index')
		);
    }
}