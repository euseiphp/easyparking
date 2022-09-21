<?php

namespace App\Http\Livewire;

use App\Enum\Status;
use App\Http\Livewire\Traits\SweetAlert;
use App\Http\Livewire\Traits\Table;
use App\Models\Parking;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Throwable;

class ParkingComponent extends Component
{
    use Table;
    use SweetAlert;

    public User $user;

    public bool $createModal = false;

    public bool $editModal = false;

    public string $postcode = '';

    public array $create = [];

    public array $edit = [];

    protected array $validationAttributes = [
        'create.name'     => 'Nome',
        'create.spaces'   => 'Vagas',
        'create.street'   => 'Rua',
        'create.district' => 'Bairro',
        'create.number'   => 'Número',
        'create.city'     => 'Cidade',
        'create.state'    => 'Estado',
        'edit.name'       => 'Nome',
        'edit.spaces'     => 'Vagas',
        'edit.street'     => 'Rua',
        'edit.district'   => 'Bairro',
        'edit.number'     => 'Número',
        'edit.city'       => 'Cidade',
        'edit.state'      => 'Estado',
        'postcode'        => 'CEP',
    ];

    protected $listeners = [
        'destroy',
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.parking-component', [
            'parkings' => $this->data(),
        ]);
    }

    private function data(): LengthAwarePaginator
    {
        return $this->user
            ->parking()
            ->orderBy($this->sort, $this->direction)
            ->latest('id')
            ->paginate($this->quantity);
    }

    private function action(): string
    {
        return $this->createModal ? 'create' : 'edit';
    }

    public function rules(): array
    {
        $action = $this->action();

        return [
            $action . '.name' => [
                'required',
                'string',
                'max:255',
            ],
            $action . '.spaces' => [
                'required',
                'integer',
            ],
            $action . '.street' => [
                'nullable',
            ],
            $action . '.district' => [
                'nullable',
            ],
            $action . '.number' => [
                'required',
                'integer',
            ],
            $action . '.city' => [
                'nullable',
            ],
            $action . '.state' => [
                'required',
            ],
            'postcode' => [
                'required',
            ],
        ];
    }

    public function create()
    {
        $this->validate();

        try {
            $this->user
                ->parking()
                ->create(array_merge($this->create, [
                    'postcode' => $this->postcode,
                    'status'   => Status::Actived,
                ]));

            $this->resetExcept('user');

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->errorAlert();
    }

    public function append(Parking $parking)
    {
        $this->edit = $parking->toArray();

        $this->postcode = $parking->postcode;

        $this->editModal = true;
    }

    public function edit()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $this->user
                    ->parking()
                    ->find($this->edit['id'])
                    ->update(array_merge($this->edit, [
                        'postcode' => $this->postcode,
                    ]));
            });

            $this->resetExcept('user');

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->errorAlert();
    }

    public function confirmingBeforeDestroy(int $id)
    {
        return $this->alertBag([
            'event'  => 'destroy',
            'append' => ['selected' => $id],
        ])->confirmAlert();
    }

    public function destroy(array $appended)
    {
        $this->resetExcept('user');

        try {
            DB::transaction(function () use ($appended) {
                $this->user
                    ->parking()
                    ->find($appended['selected'])
                    ->delete();
            });

            return $this->successAlert();
        } catch (Throwable $e) {
            //
        }

        return $this->errorAlert();
    }

    public function resetPostCode(): void
    {
        $this->reset('postcode');
    }

    public function updatedPostCode()
    {
        $cep = str($this->postcode);

        if ($cep->length() < 10) {
            return null;
        }

        $cep = $cep->remove(['.', '-']);

        $response = Cache::rememberForever('cep_' . $cep, function () use ($cep): mixed {
            try {
                return Http::get(sprintf('https://viacep.com.br/ws/%s/json', $cep))->json();
            } catch (Throwable $e) {
                return null;
            }
        });

        if (isset($response['erro']) || $response === null) {
            return $this->errorAlert('O cep não foi encontrado. Tente novamente!');
        }

        $action = $this->action();

        $this->{$action}['street']   = data_get($response, 'logradouro');
        $this->{$action}['district'] = data_get($response, 'bairro');
        $this->{$action}['city']     = data_get($response, 'localidade');
        $this->{$action}['state']    = data_get($response, 'uf');
    }
}
