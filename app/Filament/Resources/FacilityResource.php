<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'Website / CMS';
    protected static ?string $navigationLabel = 'Fasilitas / Sarpras';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('condition')
                    ->maxLength(255)
                    ->placeholder('Contoh: Baik, Rusak Ringan'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->directory('facilities'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('quantity')->sortable(),
                Tables\Columns\TextColumn::make('condition')->searchable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFacilities::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (!$user || !$user->is_active) {
            return false;
        }
        return $user->hasAnyRole(['Super Admin', 'Admin/TU', 'Kepala Madrasah']) || $user->can('manage-website');
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();
        if (!$user || !$user->is_active) {
            return false;
        }
        return $user->hasAnyRole(['Super Admin', 'Admin/TU']) || $user->can('manage-website');
    }

    public static function canEdit($record): bool
    {
        $user = auth()->user();
        if (!$user || !$user->is_active) {
            return false;
        }
        return $user->hasAnyRole(['Super Admin', 'Admin/TU']) || $user->can('manage-website');
    }

    public static function canDelete($record): bool
    {
        $user = auth()->user();
        if (!$user || !$user->is_active) {
            return false;
        }
        return $user->hasRole('Super Admin') || $user->can('manage-website');
    }
}
