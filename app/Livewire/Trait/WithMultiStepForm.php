<?php

namespace App\Livewire\Trait;

trait WithMultiStepForm 
{

    public function validateStepField() 
    {
        $field = $this->stepFields[$this->step];

        if (is_array($field)) {
            foreach ($field as $field_name) {
                $this->validateOnly(str_replace('_confirmation', '', $field_name));
            }
            return;
        }

        $this->validateOnly(str_replace('_confirmation', '', $field));
    }

}