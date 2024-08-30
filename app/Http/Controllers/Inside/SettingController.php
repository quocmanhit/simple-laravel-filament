<?php
namespace App\Http\Controllers\Inside;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingController extends Controller
{
    public function index()
    {
        $datalistOptions = $this->getDatalistOptions();
        return view('filament.pages.test-custom');
    }
    public function create()
    {
        return view('inside.setting.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'setting_key' => 'required',
            'setting_value' => 'required',
            'setting_desc' => 'required',
            'priority' => 'required',
            'require' => 'required',
            'visible' => 'required',
        ]);
        $setting = new Settings();
        $setting->setting_key = $request->setting_key;
        $setting->setting_value = $request->setting_value;
        $setting->setting_desc = $request->setting_desc;
        $setting->priority = $request->priority;
        $setting->require = $request->require;
        $setting->visible = $request->visible;
        $setting->save();
        return redirect()->route('setting.index');
    }
    public function show($id)
    {
        $setting = Settings::find($id);
        return view('inside.setting.show', compact('setting'));
    }
    public function edit($id)
    {
        $setting = Settings::find($id);
        return view('inside.setting.edit', compact('setting'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'setting_key' => 'required',
            'setting_value' => 'required',
            'setting_desc' => 'required',
            'priority' => 'required',
            'require' => 'required',
            'visible' => 'required',
        ]);
        $setting = Settings::find($id);
        $setting->setting_key = $request->setting_key;
        $setting->setting_value = $request->setting_value;
        $setting->setting_desc = $request->setting_desc;
        $setting->priority = $request->priority;
        $setting->require = $request->require;
        $setting->visible = $request->visible;
        $setting->save();
        return redirect()->route('setting.index');
    }
    public function destroy($id)
    {
        $setting = Settings::find($id);
        $setting->delete();
        return redirect()->route('setting.index');
    }
}

?>
