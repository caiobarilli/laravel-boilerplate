<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\View\ComponentAttributeBag;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'UserTable';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns()
                ->showSearchInput(),

            PowerGrid::footer()
                ->showPerPage(10)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query()
            ->join('team_user', 'users.id', '=', 'team_user.user_id')
            ->where('team_user.role', '!=', 'superadmin')
            ->select(
                'users.*',
                'users.created_at as custom_created_at',
                'team_user.role',
                'team_user.team_id'
            );
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('role', fn (User $model) => $model->teamRole($model->currentTeam) ? $model->teamRole($model->currentTeam)->name : 'Sem Cargo')
            ->add('email')
            ->add('custom_created_at', fn (User $model) => Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('Nome', 'name')
                ->sortable()
                ->searchable(),

            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Cargo', 'role')
                ->sortable(),

            Column::make('Data de Criação', 'custom_created_at')
                ->sortable(),

            Column::action('Ação'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains'])->placeholder('Nome'),
            Filter::inputText('email')->operators(['contains'])->placeholder('E-mail'),
        ];
    }

    public function actions(User $user): array
    {
        return [
            Button::add('view')
                ->slot(View::make('components.icons.eye', ['attributes' => new ComponentAttributeBag(['class' => 'w-5'])])->render())
                ->class('text-slate-500 hover:text-slate-600 font-bold p-1 rounded')
                ->can(auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'user:view'))
                ->dispatchTo('user.crud.view', 'onView', ['user' => $user]),

            Button::add('edit')
                ->slot(View::make('components.icons.pencil', ['attributes' => new ComponentAttributeBag(['class' => 'w-5'])])->render())
                ->class('text-slate-500 hover:text-slate-600 font-bold p-1 rounded')
                ->can(auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'user:update'))
                ->dispatchTo('user.crud.edit', 'onView', ['user' => $user]),

            Button::add('delete')
                ->slot(View::make('components.icons.trash', ['attributes' => new ComponentAttributeBag(['class' => 'w-5'])]))
                ->class('text-red-500 hover:text-red-400 font-bold p-1 rounded')
                ->can(auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'user:delete'))
                ->dispatchTo('user.crud.delete', 'onView', ['user' => $user]),
        ];
    }

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        User::query()->find($id)->update([
            $field => e($value),
        ]);
    }
}
