<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Testimonial;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use App\Filament\App\Resources\TestimonialResource\Pages;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Testimoni Saya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 安全 (Secure) - Mengunci ID User langsung dari sesi auth internal server
                Hidden::make('user_id')
                    ->default(fn() => Auth::id()),

                // 🔒 ANTI-HACKER COUNTERMEASURE: FORCE MODERATION STATUS
                // Memastikan ulasan baru yang dibuat oleh customer wajib masuk antrean moderasi (is_active = false).
                // Ini mencegah peretas langsung membanjiri (spamming) halaman depan web dengan konten teks berbahaya.
                Hidden::make('is_active')
                    ->default(false),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->default(fn() => Auth::user()?->name)
                    ->required()
                    ->maxLength(255),

                TextInput::make('car')
                    ->label('Tipe Mobil / Kendaraan')
                    ->placeholder('Contoh: Honda Civic Turbo / Avanza 2022')
                    ->required()
                    ->maxLength(255),

                Select::make('stars')
                    ->label('Rating Bintang')
                    ->options([
                        5 => '⭐⭐⭐⭐⭐ (Sangat Puas)',
                        4 => '⭐⭐⭐⭐ (Puas)',
                        3 => '⭐⭐⭐ (Cukup)',
                        2 => '⭐⭐ (Kurang Puas)',
                        1 => '⭐ (Sangat Kecewa)',
                    ])
                    ->native(false)
                    ->required()
                    // Menjamin input biner yang dikirim strictly integer dari rentang 1-5
                    ->rules(['in:1,2,3,4,5']),

                Textarea::make('content')
                    ->label('Isi Ulasan / Testimoni')
                    ->placeholder('Tuliskan pengalaman puas Anda servis di Service Point...')
                    ->required()
                    ->rows(4)
                    ->maxLength(1000), // Membatasi input teks maksimal 1000 karakter agar database tidak bengkak
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car')
                    ->label('Mobil')
                    ->searchable(),

                TextColumn::make('stars')
                    ->label('Rating')
                    ->alignCenter()
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state)),

                TextColumn::make('content')
                    ->label('Ulasan')
                    ->limit(50)
                    ->wrap(),

                // Menambahkan status moderasi agar customer tahu ulasannya sudah disetujui admin atau belum
                TextColumn::make('is_active')
                    ->label('Status Publikasi')
                    ->badge()
                    ->color(fn(bool $state): string => $state ? 'success' : 'warning')
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Diterbitkan' : 'Menunggu Moderasi'),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([])
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

    /**
     * 🛡️ DATA ISOLATION ZONE
     * Mengunci query agar user HANYA BISA melihat dan memanipulasi testimoni milik mereka sendiri.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
