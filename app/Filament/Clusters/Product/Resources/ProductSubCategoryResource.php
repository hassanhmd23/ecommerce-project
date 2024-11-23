<?php

namespace App\Filament\Clusters\Product\Resources;

use App\Filament\Clusters\Product;
use App\Filament\Clusters\Product\Resources\ProductSubCategoryResource\Pages;
use App\Filament\Clusters\Product\Resources\ProductSubCategoryResource\RelationManagers;
use App\Models\ProductSubCategory;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductSubCategoryResource extends Resource
{
    protected static ?string $model = ProductSubCategory::class;
    protected static ?string $cluster = Product::class;
    protected static ?int $navigationSort = 2;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->columnSpan(1)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->readOnly()
                    ->columnSpan(1)
                    ->maxLength(255),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parentCategory', 'name')
                    ->label('Parent Category')
                    ->columnSpan(1)
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpan(3)
                    ->required(),
            ])->columns(3);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parentCategory.name')
                    ->label('Parent Category')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListProductSubCategories::route('/'),
            'create' => Pages\CreateProductSubCategory::route('/create'),
            'edit' => Pages\EditProductSubCategory::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class
            ]);
    }
}
