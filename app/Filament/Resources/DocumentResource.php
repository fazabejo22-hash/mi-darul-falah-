<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?string $navigationGroup = 'Website / CMS';
    protected static ?string $navigationLabel = 'Dokumen & Unduhan';

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
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('category')
                    ->maxLength(255)
                    ->placeholder('Contoh: Kurikulum, Administrasi, Brosur'),
                Forms\Components\FileUpload::make('file_path')
                    ->required()
                    ->directory('documents')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip'])
                    ->maxSize(10240) // 10MB
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $set('file_name', is_string($state) ? basename($state) : $state->getClientOriginalName());
                            $set('file_size', is_string($state) ? 0 : $state->getSize());
                            $set('mime_type', is_string($state) ? null : $state->getMimeType());
                        }
                    }),
                Forms\Components\Hidden::make('file_name'),
                Forms\Components\Hidden::make('file_size'),
                Forms\Components\Hidden::make('mime_type'),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('category')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('file_name')->label('Nama File'),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('download_count')->sortable()->label('Total Download'),
                Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published'),
                Tables\Filters\SelectFilter::make('category')
                    ->options(fn () => Document::distinct()->pluck('category', 'category')->toArray()),
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
            'index' => Pages\ManageDocuments::route('/'),
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
