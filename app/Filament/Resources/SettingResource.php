<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Settings;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SettingResource extends Resource
{
    protected static ?string $model = Settings::class;
    /**
     * @var array|string[]
     */
    protected static array $array_setting_type = [
                        'input' => 'Text',
                        'textarea' => 'Textarea',
                        'editor' => 'RichEditor',
                        'image' => 'Image',
                    ];
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Forms\Form $form): Forms\Form
    {
        $operation = $form->getOperation(); // Get the current operation ('create' or 'edit')
        if ($operation == "edit"){
            $record = $form->getRecord();

            // Mảng map các components với setting_type tương ứng
            $typeComponents = [
                'input' => Forms\Components\TextInput::make('setting_value')
                    ->label('Setting Value')
                    ->required()
                    ->columnSpan('full'),

                'textarea' => Forms\Components\Textarea::make('setting_value')
                    ->label('Setting Value')
                    ->required()
                    ->columnSpan('full'),

                'editor' => Forms\Components\RichEditor::make('setting_value')
                    ->label('Setting Value')
                    ->required()
                    ->columnSpan('full'),

                'image' => Forms\Components\FileUpload::make('setting_value')
                    ->label('Setting Value')
                    ->required()
                    ->columnSpan('full'),
            ];

            // Tạo schema form
            $schema = [
                Forms\Components\TextInput::make('setting_key')
                    ->label('Setting Key')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\Select::make('setting_type')
                    ->label('Setting Type')
                    ->options(self::$array_setting_type)
                    ->required()
                    ->reactive()
                    ->disabled()
                    ->columnSpan('full'),
                // Render component setting_value tương ứng với setting_type hiện tại
                $typeComponents[$record->setting_type ?? 'input'], // Chỉ định giá trị mặc định ban đầu khi edit hoặc create
            ];

            // Các fields còn lại
            $schema = array_merge($schema, [
                Forms\Components\TextInput::make('priority')
                    ->label('Priority')
                    ->required()
                    ->numeric()
                    ->columnSpan('full'),

                Forms\Components\Toggle::make('require')
                    ->label('Require')
                    ->default(false)
                    ->columnSpan('full'),

                Forms\Components\Toggle::make('visible')
                    ->label('Visible')
                    ->default(true)
                    ->columnSpan('full'),
            ]);

            return $form->schema($schema);
        } else {
            return $form->schema([
                Forms\Components\TextInput::make('setting_key')
                    ->label('Setting Key')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\Select::make('setting_type')
                    ->label('Setting Type')
                    ->options(self::$array_setting_type)
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('priority')
                    ->label('Priority')
                    ->required()
                    ->numeric()
                    ->columnSpan('full'),

                Forms\Components\Toggle::make('require')
                    ->label('Require')
                    ->default(false)
                    ->columnSpan('full'),

                Forms\Components\Toggle::make('visible')
                    ->label('Visible')
                    ->default(true)
                    ->columnSpan('full'),
            ]);
        }
    }




    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('setting_key')
                    ->label('Setting Key'),
                Tables\Columns\TextColumn::make('setting_value')
                    ->label('Setting Value')
                    ->extraAttributes(['style' => 'max-width: 100px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;']),
                Tables\Columns\TextColumn::make('setting_type')
                    ->label('Setting Type'),
                Tables\Columns\TextColumn::make('setting_desc')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('priority')
                    ->label('Priority'),
                Tables\Columns\BooleanColumn::make('require')
                    ->label('Required'),
                Tables\Columns\BooleanColumn::make('visible')
                    ->label('Visible'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modal(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSettings::route('/'),
            'add' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
