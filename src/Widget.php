<?php

namespace Eleazarbr\Widget;

use Illuminate\Support\Str;
use ReflectionProperty;
use ReflectionClass;

abstract class Widget
{

    public static function render()
    {
        $instance = new static;
        return $instance->view()->with($instance->buildViewData());
    }

    public function view()
    {
        return view("widgets." . $this->viewName());
    }

    public function viewName()
    {
        return Str::kebab(class_basename($this));
    }

    protected function buildViewData()
    {
        $viewData = [];
        $properties = (new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($properties as $property) {
            $viewData[$property->getName()] = $property->getValue($this);
        }

        return $viewData;
    }
}
