<?php

namespace App\Filament\Clusters\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $cluster = \App\Filament\Clusters\Product::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Information')
                    ->columnSpan(2)
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->maxLength(255)
                            ->columnSpan(1)
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->columnSpan(2)
                            ->required(),
                    ]),
                Forms\Components\Group::make([
                    Forms\Components\Section::make('Product Details')
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\TextInput::make('price')
                                ->label('Price')
                                ->numeric()
                                ->required()
                                ->columnSpan(1),
                            Forms\Components\TextInput::make('stock')
                                ->label('Stock')
                                ->numeric()
                                ->required()
                                ->columnSpan(1),
                        ]),
                    Forms\Components\Section::make('Permalink')
                        ->columnSpan(1)
                        ->schema([
                            Forms\Components\TextInput::make('slug')
                                ->label('Slug')
                                ->maxLength(255)
                                ->readOnly(),
                        ]),
                ]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Clusters\Resources\ProductResource\Pages\ListProducts::route('/'),
            'create' => \App\Filament\Clusters\Resources\ProductResource\Pages\CreateProduct::route('/create'),
            'edit' => \App\Filament\Clusters\Resources\ProductResource\Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
