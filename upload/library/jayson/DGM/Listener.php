<?php
class jayson_DGM_Listener {
	public static function Listen($class, array &$extend) {
		$extend[] = 'jayson_DGM_Extend_'.$class;
	}
    public static function initDependencies(XenForo_Dependencies_Abstract $dependencies, array $data) {
        if (XenForo_Application::getSimpleCacheData('debugPublic') && $dependencies instanceof XenForo_Dependencies_Public) {
            XenForo_Application::setDebugMode(true);
        } elseif (XenForo_Application::getSimpleCacheData('debugAdmin') && $dependencies instanceof XenForo_Dependencies_Admin) {
            XenForo_Application::setDebugMode(true);
        }
    }
    public static function templateHook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template) {
        switch($hookName) {
            case 'admin_sidebar_home':
                $visitor = XenForo_Visitor::getInstance();
                if ($visitor->hasAdminPermission('modifyDebugModeState')) {
                    $params = $template->getParams();
                    $params += $hookParams;
                    $contents = $template->create('jayson_dgm_options', $params) . $contents;
                }
                break;
        }
    }
}