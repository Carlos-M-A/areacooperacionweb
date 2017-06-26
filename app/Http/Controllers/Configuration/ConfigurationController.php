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
            'newsletterActive' => 'required|boolean',
        ]);
        
        $this->_setEnvironmentValue('APP_NAME', 'app.name', config('app.name'), $request->appName);
        $this->_setEnvironmentValue('APP_NAME_LINK', 'app.link_in_app_name', config('app.link_in_app_name'), $request->linkInAppName);
        
        if($request->newsletterActive){
            if(config('app.newsletter_active')){
                $this->_setEnvironmentValue('APP_NEWSLETTER_ACTIVE', 'app.newsletter_active', 'true', 'true');
            } else {
                $this->_setEnvironmentValue('APP_NEWSLETTER_ACTIVE', 'app.newsletter_active', 'false', 'true');
            }
        } else {
            if(config('app.newsletter_active')){
                $this->_setEnvironmentValue('APP_NEWSLETTER_ACTIVE', 'app.newsletter_active', 'true', 'false');
            } else {
                $this->_setEnvironmentValue('APP_NEWSLETTER_ACTIVE', 'app.newsletter_active', 'false', 'false');
            }
        }
        
        return redirect('configuration');
    }
    
    /**
     * Change a value in .env file
     * @param type $environmentName is the key in the environment file (example.. APP_LOG_LEVEL)
     * @param type $configKey  is the key used to access the configuration at runtime (example.. app.log_level (tinker config('app.log_level'))
     * @param type $currentValue is the current value of the enviroment field
     * @param type $newValue is of course the new value you wish to persist.
     */
    private function _setEnvironmentValue($environmentName, $configKey, $currentValue, $newValue) {
        file_put_contents(App::environmentFilePath(), str_replace(
            $environmentName . '=' . '"'.$currentValue.'"',
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
