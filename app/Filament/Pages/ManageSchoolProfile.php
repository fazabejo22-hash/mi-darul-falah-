<?php

namespace App\Filament\Pages;

use App\Models\SchoolProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class ManageSchoolProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Website / CMS';
    protected static ?string $navigationLabel = 'Profil Madrasah';
    protected static string $view = 'filament.pages.manage-school-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $profile = SchoolProfile::firstOrCreate(['id' => 1], [
            'name' => 'MI Darul Falah',
            'npsn' => '69881899',
            'nsm' => '111235150224',
            'status' => 'Swasta',
            'accreditation' => 'B',
            'established_year' => 2007,
            'address' => 'Bendomungal RT/RW 002/001, Sidorejo, Krian, Sidoarjo, Jawa Timur 61262',
            'whatsapp' => '082139808646',
            'email' => 'midarulfalahpusat@yahoo.com',
            'headmaster' => 'Drs. Ach. Azhari',
            'vision' => 'Berilmu, Berprestasi, Berakhlaqul Karimah',
        ]);

        $this->form->fill($profile->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas Madrasah')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->maxLength(255),
                        Forms\Components\TextInput::make('npsn')->required()->maxLength(255),
                        Forms\Components\TextInput::make('nsm')->required()->maxLength(255),
                        Forms\Components\TextInput::make('status')->required()->maxLength(255),
                        Forms\Components\TextInput::make('accreditation')->required()->maxLength(10),
                        Forms\Components\TextInput::make('established_year')->numeric()->required(),
                        Forms\Components\TextInput::make('headmaster')->required()->maxLength(255),
                    ])->columns(2),
                Forms\Components\Section::make('Kontak & Alamat')
                    ->schema([
                        Forms\Components\Textarea::make('address')->required()->columnSpanFull(),
                        Forms\Components\TextInput::make('whatsapp')->required()->maxLength(50),
                        Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
                        Forms\Components\TextInput::make('map_url')->url()->maxLength(500)->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make('Visi, Misi & Sejarah')
                    ->schema([
                        Forms\Components\Textarea::make('vision')->required()->columnSpanFull(),
                        Forms\Components\Textarea::make('mission')->columnSpanFull(),
                        Forms\Components\RichEditor::make('history')->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Media & Logo')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')->image()->directory('school'),
                    ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $profile = SchoolProfile::firstOrNew(['id' => 1]);
        $profile->fill($data);
        $profile->save();

        Notification::make()
            ->success()
            ->title('Profil Madrasah berhasil diperbarui')
            ->send();
    }

    public static function canAccess(): bool
    {
        return auth()->check() && (auth()->hasRole('Super Admin') || auth()->hasRole('Admin/TU') || auth()->hasRole('Kepala Madrasah') || auth()->can('manage-school-profile'));
    }
}
