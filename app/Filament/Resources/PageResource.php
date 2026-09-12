<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Website / CMS';
    protected static ?string $navigationLabel = 'Halaman Statis';

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
                Forms\Components\Textarea::make('excerpt')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('template')
                    ->options([
                        'default' => 'Default Template',
                        'full-width' => 'Full Width',
                        'sidebar' => 'With Sidebar',
                    ])
                    ->required()
                    ->default('default'),
                Forms\Components\Toggle::make('is_published')
                    ->required()
                    ->default(true),
                Forms\Components\DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->searchable(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
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
            'index' => Pages\ManagePages::route('/'),
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
