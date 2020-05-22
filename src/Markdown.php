<?php

namespace Davidsneal\LaravelNovaMarkdown;

use Laravel\Nova\Fields\Field;

class Markdown extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'laravel-nova-markdown';

    /**
     * Set the toolbar buttons to be added to the editor.
     *
     * @param  array  $buttons
     * @return $this
     */
    public function buttons(array $buttons)
    {
        return $this->withMeta(['buttons' => $buttons]);
    }
}
