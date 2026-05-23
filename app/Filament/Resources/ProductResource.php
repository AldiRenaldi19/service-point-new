<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\ProductResource\Pages;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Katalog Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->description('Detail nama, kategori, dan identitas brand produk.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->helperText('URL unik otomatis terisi dari nama produk.'),

                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Oli Mesin' => 'Oli Mesin',
                                'Suku Cadang' => 'Suku Cadang',
                                'Aksesoris' => 'Aksesoris',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('brand')
                            ->label('Brand / Merek')
                            ->default('TOP 1')
                            ->maxLength(255)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true)
                            ->onColor('success'),
                    ])->columns(2),

                Section::make('Detail Konten')
                    ->description('Penjelasan mendalam mengenai spesifikasi dan kegunaan produk.')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Produk')
                            ->image()
                            ->directory('products')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048) // Membatasi upload gambar maksimal 2MB demi menghemat penyimpanan disk
                            ->columnSpanFull(),

                        TextInput::make('spec')
                            ->label('Spesifikasi Singkat')
                            ->placeholder('Contoh: 10W-40 / SAE 20W-50')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('fungsi')
                                    ->label('Fungsi Utama')
                                    ->placeholder('Jelaskan fungsi utama produk ini...')
                                    ->maxLength(1000)
                                    ->rows(3),

                                Textarea::make('manfaat')
                                    ->label('Manfaat Produk')
                                    ->placeholder('Apa manfaat yang didapat konsumen?')
                                    ->maxLength(1000)
                                    ->rows(3),
                            ]),

                        RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'heading',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'undo'
                            ]) // Membatasi tombol rich editor untuk mencegah eksploitasi tag HTML rusak
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Oli Mesin' => 'info',
                        'Suku Cadang' => 'warning',
                        'Aksesoris' => 'success',
                        default => 'gray',
                    }),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Oli Mesin' => 'Oli Mesin',
                        'Suku Cadang' => 'Suku Cadang',
                        'Aksesoris' => 'Aksesoris',
                        'Lainnya' => 'Lainnya',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
