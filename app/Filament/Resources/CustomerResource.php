<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Pages\ViewCustomer;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use Filament\Forms\Components\TextInput;

use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected const Super_Admin = 'Super Admin';

    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // this function is used to hide file upload component from view and edit page if user is not super admin
    protected static function aadhar(){

        if (Auth::user()->hasRole(self::Super_Admin)) {

            $aadhar = FileUpload::make('aadhar')
                                ->disk('documents')
                                ->directory('aadhar')
                                ->visibility('private')
                                ->maxSize(512)
                                ->enableDownload()
                                ->enableOpen();
        } else {

            $aadhar = FileUpload::make('aadhar')
                                ->disk('documents')
                                ->directory('aadhar')
                                ->visibility('private')
                                ->maxSize(512);
        }

        return $aadhar;

    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('name')->required(),

                TextInput::make('email')->email()->required(),

                self::aadhar(),

                Select::make('status')
                        ->label('Status')
                        ->options([

                            'Active'     => 'Active',
                            'Not-Active' => 'Not-Active',

                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name'),

                TextColumn::make('email'),

                TextColumn::make('aadhar'),

                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view'   => Pages\ViewCustomer::route('/{record}'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
