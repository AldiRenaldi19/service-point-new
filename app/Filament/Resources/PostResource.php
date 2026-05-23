<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Filament\Resources\PostResource\Pages;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Artikel / Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Utama')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Artikel')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->unique(Post::class, 'slug', ignoreRecord: true),

                        RichEditor::make('content')
                            ->label('Isi Artikel')
                            ->required()
                            ->fileAttachmentsDirectory('blog')
                            ->fileAttachmentsVisibility('public')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Media & Status')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Foto Sampul')
                            ->image()
                            ->directory('blog-thumbnails')
                            ->visibility('public')
                            ->maxSize(2048),

                        Grid::make(1)
                            ->schema([
                                TextInput::make('video_url')
                                    ->url()
                                    ->label('Link Video (YouTube)')
                                    ->placeholder('https://www.youtube.com/watch?v=...')
                                    ->maxLength(255)
                                    ->helperText('Kosongkan jika ingin upload video manual'),

                                FileUpload::make('video_file')
                                    ->label('Atau Upload File Video')
                                    ->directory('blog-videos')
                                    ->acceptedFileTypes(['video/mp4', 'video/ogg', 'video/webm'])
                                    ->maxSize(51200) // 50MB
                                    ->helperText('Format: mp4, ogg, webm. Maksimal 50MB'),
                            ]),

                        // ==========================================================
                        // 🔒 SECURITY PROTECTION: ANTI AUTHOR ESCALATION FRAUD
                        // ==========================================================
                        // Mengunci hak kepenulisan secara otomatis kepada user yang sedang login.
                        // Komponen ini dinonaktifkan (disabled) demi menghindari manipulasi ID Penulis.
                        Select::make('user_id')
                            ->label('Penulis')
                            ->relationship('user', 'name')
                            ->default(auth()->id())
                            ->disabled()
                            ->dehydrated() // Memastikan nilai ID penulis tetap ikut dikirim ke database meskipun berstatus disabled
                            ->required(),

                        Toggle::make('status')
                            ->label('Terbitkan Artikel')
                            ->onColor('success')
                            ->offColor('danger'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Sampul')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                IconColumn::make('status')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Rilis')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
