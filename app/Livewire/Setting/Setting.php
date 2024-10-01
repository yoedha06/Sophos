<?php

namespace App\Livewire\Setting;

use App\Helpers\SettingHelper;
use App\Helpers\SophosHelper;
use App\Models\Setting as ModelsSetting;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Setting extends Component
{
    public $clientId = '';
    public $clientSecret = '';

    public function mount(): void
    {
        $setting = SettingHelper::data();
        $this->clientId = $setting->client_id;
        $this->clientSecret = $setting->client_secret;
    }

    public function fecthTenant()
    {
        return (new SophosHelper())->getWhoAmI()->json();
    }

    public function saveCredentials(): void
    {
        $this->validate([
            'clientId' => ['required', 'string', 'max:255'],
            'clientSecret' => ['required_with:clientId', 'string', 'max:255'],
        ]);

        SettingHelper::clearCache();

        $updateData = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        foreach ($updateData as $key => $value) {
            SettingHelper::setByKey($key, $value);
        }

        $this->fecthTenant();

        if($this->fecthTenant()){
            session()->flash('success', 'Credentials saved successfully');
            $this->redirectRoute('setting', navigate: true);
        }
        
        session()->flash('error', 'Something went wrong, please try again');
        $this->redirectRoute('setting', navigate: true);
    }


    public function render(): View
    {
        return view('livewire.setting.setting');
    }
}
