<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationGroup = 'Website / CMS';
    protected static ?string $navigationLabel = 'Prestasi';

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
                Forms\Components\TextInput::make('recipient_name')
                    ->maxLength(255)
                    ->label('Nama Penerima / Siswa / Tim'),
                Forms\Components\TextInput::make('level')
                    ->maxLength(255)
                    ->placeholder('Kecamatan, Kabupaten, Provinsi, Nasional'),
                Forms\Components\DatePicker::make('achievement_date'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('achievements'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_published')
                    ->required()
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('recipient_name')->searchable()->label('Penerima'),
                Tables\Columns\TextColumn::make('level')->searchable(),
                Tables\Columns\TextColumn::make('achievement_date')->date()->sortable(),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
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
            'index' => Pages\ManageAchievements::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && (auth()->hasRole('Super Admin') || auth()->hasRole('Admin/TU') || auth()->hasRole('Kepala Madrasah') || auth()->can('manage-website'));
    }

    public static function canCreate(): bool
    {
        return auth()->check() && (auth()->hasRole('Super Admin') || auth()->hasRole('Admin/TU') || auth()->can('manage-website'));
    }

    public static function canEdit($record): bool
    {
        return auth()->check() && (auth()->hasRole('Super Admin') || auth()->hasRole('Admin/TU') || auth()->can('manage-website'));
    }

    public static function canDelete($record): bool
    {
        return auth()->check() && (auth()->hasRole('Super Admin') || auth()->can('manage-website'));
    }
}
