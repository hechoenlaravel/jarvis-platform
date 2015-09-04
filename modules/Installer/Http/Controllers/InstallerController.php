<?php namespace Modules\Installer\Http\Controllers;

use Modules\Installer\Http\Requests\InstallRequest;
use Pingpong\Modules\Routing\Controller;

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
        $envFile = view('installer::env')->with('data', $request->all())->render();
        if (file_exists(base_path('.env')) && $fs = fopen(base_path('.env'), "w")) {
            fwrite($fs, $envFile);
            fclose($fs);
            return $this->installLaravelAdmin();
        }
        return redirect()->back()->withErrors(['error' => 'Error Creating .env File']);
    }

    /**
     * @return $this|\Illuminate\View\View
     */
    protected function installLaravelAdmin()
    {
        try{
            \Artisan::call('key:generate');
            \Artisan::call('migrate');
            $installer = new \Joselfonseca\LaravelAdmin\Installer\Installer();
            $installer->install('admin@admin.com', 'secret');
            return view('installer::installed');
        }catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
	
}