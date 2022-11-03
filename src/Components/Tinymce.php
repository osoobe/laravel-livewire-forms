<?php

namespace Bastinald\LaravelLivewireForms\Components;

use Bastinald\LaravelLivewireForms\Traits\WithDisabled;
use Bastinald\LaravelLivewireForms\Traits\WithHelp;
use Bastinald\LaravelLivewireForms\Traits\WithModel;
use Bastinald\LaravelLivewireForms\Traits\WithPlaceholder;
use Bastinald\LaravelLivewireForms\Traits\WithPrefix;
use Bastinald\LaravelLivewireForms\Traits\WithReadonly;
use Bastinald\LaravelLivewireForms\Traits\WithSizing;
use Illuminate\View\Component;

class Tinymce extends Component
{
    use WithPrefix, WithSizing, WithHelp, WithModel, WithDisabled, WithReadonly, WithPlaceholder;

    public $props = [];
    public $attrs = [];

    public static function make($name, $label = null)
    {
        $component = new static;

        $component->props = [
            'name' => $name,
            'label' => $label,
            'prefix' => null,
            'append' => null,
            'prepend' => null,
            'plaintext' => false,
            'small' => false,
            'large' => false,
            'help' => null,
            'model' => '.defer',
        ];

        $component->attrs = [
            'type' => 'textarea',
            'inputmode' => 'text',
            'disabled' => false,
            'readonly' => false,
        ];

        return $component;
    }

    public function append($append)
    {
        $this->props['append'] = $append;

        return $this;
    }

    public function prepend($prepend)
    {
        $this->props['prepend'] = $prepend;

        return $this;
    }

    public function plaintext($plaintext = true)
    {
        $this->props['plaintext'] = $plaintext;
        $this->attrs['readonly'] = $plaintext;

        return $this;
    }

    public function render()
    {
        return view('laravel-livewire-forms::tinymce');
    }
}
