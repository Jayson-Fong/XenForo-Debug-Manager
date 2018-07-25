<?php
class jayson_DGM_Listener {
	public static function Listen($class, array &$extend) {
		$extend[] = 'jayson_DGM_Extend_'.$class;
	}
    public static function initDependencies(XenForo_Dependencies_Abstract $dependencies, array $data) {
        $debugModeStatus = XenForo_Application::getSimpleCacheData('debugModeStatus');
        if (!$debugModeStatus['restrict'] || in_array($_SERVER['REMOTE_ADDR'], $debugModeStatus['registeredIps'])) {
            if ($debugModeStatus['public'] && $dependencies instanceof XenForo_Dependencies_Public) {
                XenForo_Application::setDebugMode(true);
            } elseif ($debugModeStatus['admin'] && $dependencies instanceof XenForo_Dependencies_Admin) {
                XenForo_Application::setDebugMode(true);
            }
        } elseif ($debugModeStatus['restrictDisable']) {
            XenForo_Application::setDebugMode(false);
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