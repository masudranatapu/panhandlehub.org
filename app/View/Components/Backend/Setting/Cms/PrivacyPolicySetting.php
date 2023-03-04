<?php

namespace App\View\Components\Backend\Setting\Cms;

use Illuminate\View\Component;

class PrivacyPolicySetting extends Component
{
    public $privacy;
    public $privacyBackground;
    public $privacyContent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($privacy, $privacyBackground, $privacyContent)
    {
        $this->privacy = $privacy;
        $this->privacyBackground = $privacyBackground;
        $this->privacyContent = $privacyContent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.backend.setting.cms.privacy-policy-setting');
    }
}
