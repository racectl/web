<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

trait RuleBasedInputs
{
    public $input;

    public function initializeBetterInputs()
    {
        if (method_exists($this, 'dynamicRules')) {
            foreach ($this->dynamicRules() as $key => $value) {
                $this->rules[$key] = $value;
            }
        }
    }

    public function mountRuleBasedInputs()
    {
        $this->fillInputsFromRules();
        $this->setDefaults();
    }

    protected function setDefaults()
    {
        if (method_exists($this, 'inputDefaults')) {
            $this->inputDefaults();
        }
    }

    protected function fillInputsFromRules()
    {
        foreach ($this->rules as $key => $value) {
            $this->input[$key] = '';
        }
    }

    protected function setInputDefault($key, $value)
    {
        $this->input[$key] = $value;
    }

    protected function inputs()
    {
        return $this->input;
    }

    protected function input($key)
    {
        return $this->input[$key];
    }

    public function validate($rules = null, $messages = [], $attributes = [])
    {
        [$rules, $messages, $attributes] = $this->providedOrGlobalRulesMessagesAndAttributes($rules, $messages, $attributes);

        $data = $this->prepareForValidation(
            $this->getDataForValidation($rules)
        );

        $validator = Validator::make($data, $rules, $messages, $attributes);

        $this->shortenModelAttributes($data, $rules, $validator);

        $validatedData = $validator->validate();

        $this->resetErrorBag();

        return $validatedData;
    }

    protected function getDataForValidation($rules)
    {
        $properties = $this->input;

        collect($rules)->keys()
            ->each(function ($ruleKey) use ($properties) {
                $propertyName = $this->beforeFirstDot($ruleKey);

                throw_unless(array_key_exists($propertyName, $properties), new \Exception('No property found for validation: ['.$ruleKey.']'));
            });

        return collect($properties)->map(function ($value) {
            if ($value instanceof Collection || $value instanceof EloquentCollection) return $value->toArray();

            return $value;
        })->all();
    }
}
