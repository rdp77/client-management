<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketerResource\Pages\ListMarketers;
use App\Models\Client;
use App\Models\Marketer;
use App\Models\Product;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class MarketerResource extends Resource
{
    /**
     * The resource record title.
     */
    protected static ?string $recordTitleAttribute = 'title';

    /**
     * The resource model.
     */
    protected static ?string $model = Marketer::class;

    /**
     * The resource icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    /**
     * The resource navigation group.
     */
    protected static ?string $navigationGroup = 'Collections';

    /**
     * The resource navigation sort order.
     */
    protected static ?int $navigationSort = 0;

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    /**
     * Get the form for the resource.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(3)
                    ->schema([
                        Section::make()
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Enter a client name')
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),

                                TextInput::make('email')
                                    ->placeholder('Enter a client email')
                                    ->email(),

                                PhoneInput::make('phone')
                                    ->inputNumberFormat(PhoneInputNumberType::NATIONAL)
                                    ->initialCountry('id')
                                    ->required(),

                                TextInput::make('website')
                                    ->placeholder('eg: google.com')
                                    ->suffixIcon('heroicon-m-globe-alt')
                                    ->url(),

                                Textarea::make('address')
                                    ->placeholder('Enter a client address')
                                    ->rows(5)
                            ]),

                        Section::make()
                            ->columnSpan(1)
                            ->schema([
                                Toggle::make('is_whatsapp')
                                    ->label('WhatsApp'),

                                Toggle::make('is_active')
                                    ->label('Active'),
                            ]),
                    ]),
            ]);
    }

    /**
     * Get the table for the resource.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->sortable()
                    ->searchable()
                    ->url(fn($record) => 'mailto:'.$record->email),

                TextColumn::make('phone')
                    ->sortable()
                    ->searchable()
                    ->url(fn($record) => 'tel:'.$record->phone),

                IconColumn::make('is_whatsapp')
                    ->label('WhatsApp')
                    ->boolean()
                    ->url(fn($record) => $record->is_whatsapp ? 'https://wa.me/'.$record->phone : null)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Get the relationships for the resource.
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Get the pages for the resource.
     */
    public static function getPages(): array
    {
        return [
            'index' => ListMarketers::route('/'),
        ];
    }
}
