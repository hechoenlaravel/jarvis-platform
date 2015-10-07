<?php namespace Modules\Installer\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Installer\Http\Requests\InstallRequest;
use JarvisPlatform\Modules\Installer\Repositories\EntitiesForLaravelAdmin;

/**
 * Class InstallerController
 * @package Modules\Installer\Http\Controllers
 */
class InstallerController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function index()
	{
		return view('installer::index');
	}

    /**
     * @param InstallRequest $request
     * @return $this|\Illuminate\View\View
     */
    public function doInstall(InstallRequest $request)
    {
        \Artisan::call('key:generate');
        \Artisan::call('migrate');
        $envFile = view('installer::env')->with('data', $request->all())->render();
        if (file_exists(base_path('.env')) && $fs = fopen(base_path('.env'), "w")) {
            fwrite($fs, $envFile);
            fclose($fs);
        }
        return redirect()->back()->withErrors(['error' => 'Error Creating .env File']);
    }
	
}