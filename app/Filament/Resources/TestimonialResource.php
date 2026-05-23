<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Testimonial;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Filament\Resources\TestimonialResource\Pages;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Testimoni')
                    ->description('Masukkan data ulasan atau review jujur dari pelanggan Service Point.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('car')
                            ->label('Kendaraan / Jabatan')
                            ->placeholder('Contoh: Pemilik Avanza, Honda HR-V, dll.')
                            ->required()
                            ->maxLength(255),

                        Select::make('stars')
                            ->label('Rating Bintang')
                            ->options([
                                5 => '⭐⭐⭐⭐⭐ (5 Bintang)',
                                4 => '⭐⭐⭐⭐ (4 Bintang)',
                                3 => '⭐⭐⭐ (3 Bintang)',
                                2 => '⭐⭐ (2 Bintang)',
                                1 => '⭐ (1 Bintang)',
                            ])
                            ->default(5)
                            ->required()
                            ->native(false),

                        Textarea::make('content')
                            ->label('Isi Ulasan / Testimoni')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('car')
                    ->label('Kendaraan')
                    ->searchable(),

                TextColumn::make('stars')
                    ->label('Rating')
                    ->alignCenter()
                    ->formatStateUsing(fn(int $state): string => str_repeat('⭐', $state)),

                IconColumn::make('is_active')
                    ->label('Status Tampil')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
