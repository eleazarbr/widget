<?php

namespace Tests\Feature;

use Eleazarbr\Widget\Widget;
use Eleazarbr\Widget\WidgetServiceProvider;
use Orchestra\Testbench\TestCase;

class WidgetTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [
            WidgetServiceProvider::class
        ];
    }

    /** TODO: get the default DIR via configuration files */
    function it_compiles_the_widget_blade_directive()
    {
        $string = "@widget('Eleazarbr\Widget\Tests\TestWidget')";
        $expected = "<?= resolve('Eleazarbr\Widget\Tests\TestWidget'); ?>";

        $compiled = resolve('blade.compiler')->compileString($string);
        // $this->assertEquals($expected, $compiled);
    }

    /** @test */
    function it_chooses_a_default_view_name_based_on_the_class()
    {
        $widget = new TestWidget;
        $this->assertEquals('test-widget', $widget->viewName());
    }
}

class TestWidget extends Widget
{
}
