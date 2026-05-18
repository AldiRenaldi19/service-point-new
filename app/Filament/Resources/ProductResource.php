<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    // Icon shopping cart biar lebih relevan buat katalog
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Katalog Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Utama')
                    ->description('Detail nama, kategori, dan identitas brand produk.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->helperText('URL otomatis terisi dari nama produk.'),

                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Oli Mesin' => 'Oli Mesin',
                                'Suku Cadang' => 'Suku Cadang',
                                'Aksesoris' => 'Aksesoris',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('brand')
                            ->default('TOP 1')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Harga & Inventori')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Harga Jual')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Forms\Components\TextInput::make('stock')
                            ->label('Jumlah Stok')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true)
                            ->onColor('success'),
                    ])->columns(3),

                Forms\Components\Section::make('Detail Konten')
                    ->description('Penjelasan mendalam mengenai spesifikasi dan kegunaan produk.')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Foto Produk')
                            ->image()
                            ->directory('products')
                            ->visibility('public')
                            ->imageEditor() // Biar bisa crop/resize langsung di admin
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('spec')
                            ->label('Spesifikasi Singkat')
                            ->placeholder('Contoh: 10W-40 / SAE 20W-50')
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Textarea::make('fungsi')
                                    ->label('Fungsi Utama')
                                    ->placeholder('Jelaskan fungsi utama produk ini...')
                                    ->rows(3),

                                Forms\Components\Textarea::make('manfaat')
                                    ->label('Manfaat Produk')
                                    ->placeholder('Apa manfaat yang didapat konsumen?')
                                    ->rows(3),
                            ]),

                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Oli Mesin' => 'info',
                        'Suku Cadang' => 'warning',
                        'Aksesoris' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Oli Mesin' => 'Oli Mesin',
                        'Suku Cadang' => 'Suku Cadang',
                        'Aksesoris' => 'Aksesoris',
                    ]),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
