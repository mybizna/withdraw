<?php

namespace Modules\Withdraw\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Base\Filament\Resources\BaseResource;
use Modules\Base\Filament\Resources\Pages;
use Modules\Withdraw\Models\Gateway;

class GatewayResource extends BaseResource
{
    protected static ?string $model = Gateway::class;

    protected static ?string $slug = 'withdraw/gateway';

    protected static ?string $navigationGroup = 'Withdraw';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('instruction')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('gateway_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('file_structure')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('file_prefix')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('file_suffix')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('file_type')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('file_limit')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gateway_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_limit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {

        Pages\ListBase::setResource(static::class);

        return [
            'index' => Pages\ListBase::route('/'),
            'create' => Pages\CreateBase::route('/create'),
            'edit' => Pages\EditBase::route('/{record}/edit'),
        ];
    }
}
