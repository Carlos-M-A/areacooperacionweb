<?php

namespace App\Http\Controllers\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

class ConfigurationController extends Controller
{
    //
    public function index() {
        return view('configuration.configuration');
    }
    
    public function edit(Request $request) {
        $this->validate($request, [
            'appName' => 'required|string|max:100',
            'linkInAppName' => 'required|url|max:' . config('forms.url'),
        ]);
        
        $this->_setEnvironmentValue('APP_NAME', 'app.name', $request->appName);
        $this->_setEnvironmentValue('APP_NAME_LINK', 'constants.link_in_app_name', $request->linkInAppName);
        
        return redirect('configuration');
    }
    
    /**
     * Change a value in .env file
     * @param type $environmentNameis the key in the environment file (example.. APP_LOG_LEVEL)
     * @param type $configKey is the key used to access the configuration at runtime (example.. app.log_level (tinker config('app.log_level')).
     * @param type $newValue is of course the new value you wish to persist.
     */
    private function _setEnvironmentValue($environmentName, $configKey, $newValue) {
        file_put_contents(App::environmentFilePath(), str_replace(
            $environmentName . '=' . '"'.config($configKey).'"',
            $environmentName . '=' . '"'.$newValue.'"',
            file_get_contents(App::environmentFilePath())
        ));

        Config::set($configKey, $newValue);

        // Reload the cached config       
        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
}
}
