<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Delete extends Component
{
    public $route, $text;

    function formButton($url, $text, $method_field = false, $method = 'POST', $class = 'dropdown-item')
    {
        $formName = 'doc_' . md5(microtime());
        $csrf_field = csrf_field();

        if($method_field == 'DELETE') {
            $method_field = method_field('DELETE');
            $onclick = 'if (confirm(\'Você realmente deseja remover o registro?\')) { document.' . $formName . '.submit(); } event.returnValue = false; return false;';

        } else {
            $method_field = '';
            $onclick = 'document.' . $formName . '.submit()';
        }

        $form = 
        <<<HTML
                <form name="$formName" method="$method" action="$url">
                    $csrf_field
                    $method_field
                </form>
                <a href="#" class="px-0 dropdown-item" onclick="$onclick" title="Apagar">$text</a>
        HTML;

        return $form;
    }

    public function render()
    {
        return <<<'blade'
            <div>
                {!! $this->formButton($this->route, $this->text ?? null, 'DELETE') !!}
            </div>
        blade;
    }
}
