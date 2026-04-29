<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Schema;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_url')
                    ->hiddenLabel()
                    ->avatar()
                    ->directory('avatars')
                    ->image()
                    ->maxSize(2048)
                    ->extraAttributes([
                        'style' => 'display: flex; justify-content: center; margin: 0 auto 1.5rem auto;',
                    ]),

                Grid::make(2)->schema([
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                ]),

                Grid::make(1)->schema([
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                ]),
            ]);
    }
}
