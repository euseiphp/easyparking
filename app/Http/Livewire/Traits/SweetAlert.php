<?php

namespace App\Http\Livewire\Traits;

use Exception;
use Illuminate\Support\Str;

trait SweetAlert
{
    protected ?string $event = null;

    protected ?string $type = null;

    protected ?string $title = null;

    protected ?string $text = null;

    protected array $bag = [];

    protected function alertBag(array $alertbag): self
    {
        $this->bag = $alertbag;

        return $this;
    }

    protected function sweetAlert(
        string $title,
        string $message,
        string $type = 'success',
        ?string $event = 'swal:common'
    ): self {
        $this->alertEvent($event)
             ->alertType($type)
             ->alertTitle($title)
             ->alertText($message);

        return $this->fireUp();
    }

    protected function alertText(string $alertText): self
    {
        $this->text = $alertText;

        return $this;
    }

    protected function alertTitle(string $alertTitle): self
    {
        $this->title = $alertTitle;

        return $this;
    }

    protected function alertType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    protected function alertEvent(string $alertEvent): self
    {
        $this->event = $alertEvent;

        return $this;
    }

    protected function confirmAlert(?string $message = 'Você tem certeza que deseja prosseguir?'): bool
    {
        $this->alertEvent('swal:confirm')
             ->alertType('warning')
             ->alertTitle('Atenção!')
             ->alertText($message);

        return $this->fireUp();
    }

    protected function successAlert(?string $message = 'Procedimento realizado com sucesso'): bool
    {
        $this->alertEvent('swal:common')
             ->alertType('success')
             ->alertTitle('Sucesso!')
             ->alertText($message);

        return $this->fireUp();
    }

    protected function errorAlert(?string $message = 'Erro interno. Contate o suporte!'): bool
    {
        $this->alertEvent('swal:common')
             ->alertType('error')
             ->alertTitle('Ops!')
             ->alertText($message);

        return $this->fireUp();
    }

    private function fireUp(): bool
    {
        $this->alertValidations();

        $data = [
            'type'    => $this->type,
            'message' => $this->title,
            'text'    => $this->text,
        ];

        $this->dispatchBrowserEvent($this->event, array_merge($data, $this->bag));

        return true;
    }

    private function alertValidations(): bool
    {
        throw_if(
            !in_array($this->type, [
                'success',
                'error',
                'warning',
                'info',
            ]),
            new Exception(
                __(
                    'The :method is invalid. Allowed is: success, error, warning and info',
                    ['method' => $this->type]
                )
            )
        );

        throw_if(!Str::contains($this->event, 'swal:'), new Exception(__('There is no "swal:" syntax in the event name.')));

        return true;
    }
}
