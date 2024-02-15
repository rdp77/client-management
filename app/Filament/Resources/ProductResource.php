<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    /**
     * The resource record title.
     */
    protected static ?string $recordTitleAttribute = 'title';

    /**
     * The resource model.
     */
    protected static ?string $model = Product::class;

    /**
     * The resource icon.
     */
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

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
                                    ->placeholder('Enter a product name')
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),

                                Select::make('category_id')
                                    ->label('Category')
                                    ->multiple()
                                    ->relationship(name: 'categories', titleAttribute: 'name')
                                    ->maxItems(2)
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->placeholder('Enter a category name')
                                            ->required()
                                            ->maxLength(255)
                                            ->autofocus(),

                                        Textarea::make('description')
                                            ->placeholder('Enter a category description')
                                            ->rows(5)
                                    ])
                                    ->searchable(['name']),

                                TextInput::make('code')
                                    ->placeholder('Enter a product code')
                                    ->unique()
                                    ->default(static::getModel()::generateUniqueCode())
                                    ->required()
                                    ->suffixAction(
                                        Action::make('generateRandomCode')
                                            ->icon('heroicon-m-arrows-pointing-in')
                                            ->action(function (Set $set) {
                                                $set('code', static::getModel()::generateUniqueCode());
                                            })
                                    ),

                                Textarea::make('description')
                                    ->placeholder('Enter a product description')
                                    ->rows(5)
                            ]),

                        Section::make()
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('minimum_order')
                                    ->placeholder('Enter a minimum order')
                                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                                    ->default(1)
                                    ->required(),

                                TextInput::make('price')
                                    ->placeholder('Enter a selling price')
                                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                                    ->default(100)
                                    ->required(),

                                TextInput::make('quantity')
                                    ->placeholder('Enter a quantity')
                                    ->currencyMask(thousandSeparator: ',', decimalSeparator: '.', precision: 2)
                                    ->default(1)
                                    ->required(),
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

                TextColumn::make('code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('categories.name')
                    ->label('Category')
                    ->badge(),

                TextColumn::make('selling_price')
                    ->label('Selling Price')
                    ->currency('IDR')
                    ->sortable(),

                TextColumn::make('quantity'),
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
            'index' => ListProducts::route('/'),
        ];
    }
}
