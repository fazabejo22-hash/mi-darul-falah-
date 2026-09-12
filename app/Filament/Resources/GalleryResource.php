<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website / CMS';
    protected static ?string $navigationLabel = 'Galeri Foto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120)
                    ->directory('galleries'),
                Forms\Components\DatePicker::make('event_date'),
                Forms\Components\Toggle::make('is_published')
                    ->required()
                    ->default(true),
                Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->required()
                            ->directory('galleries/items'),
                        Forms\Components\TextInput::make('caption')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alt_text')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columnSpanFull()
                    ->grid(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('event_date')->date()->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Jumlah Foto'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
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
            'index' => Pages\ManageGalleries::route('/'),
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
