<?php

namespace Bastinald\LaravelLivewireForms\Components;

use Bastinald\LaravelLivewireForms\Components\Button;
use Bastinald\LaravelLivewireForms\Components\FormComponent;
use Bastinald\LaravelLivewireForms\Components\Input;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;


class ModalFormComponent extends FormComponent
{


    use LivewireAlert;

    public $program = null;
    public $btnTitle = "Add Student";
    public $modalTitle = "Add Student";
    public $btnClass = "btn btn-dark ml-2 mt-sm--3";
    public $modalFormVisible = false;
    public $isDropdown = false;
    public $file = null;
    public $team;

    public function createShowModal() {
        $this->modalFormVisible = true;
    }

    public function buttons()
    {
        return [
            Button::make('Cancel', 'dark')->click('$toggle("modalFormVisible")'),
            Button::make()->click('submit'),
        ];
    }

    public function submit()
    {
        $this->alert(
            'success',
            'Test Success',
            [
                'timer' =>  10000
            ]
        );
        $this->data = [];
        $this->refreshDatatables();
        $this->modalFormVisible = false;

    }

    public function render()
    {
        return view('laravel-livewire-forms::modal-form')
            ->layout($this->layout ?? config('livewire.layout'));
    }
}
