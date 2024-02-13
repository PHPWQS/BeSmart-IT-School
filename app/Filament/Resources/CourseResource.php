<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Moderator Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Course Information')->schema([
                    Forms\Components\TextInput::make('name')->filled()->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('description')->filled()->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),
                    Forms\Components\Select::make('type_id')->label('Type')->options(
                        Type::all()->pluck('type', 'id')
                    )->searchable(),
                ]),
                Forms\Components\Section::make('Course thumbnail')->schema([
                    Forms\Components\FileUpload::make('thumbnail')->image()
                        ->filled()->directory('courses/posters'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->modifyQueryUsing(function (Builder $query) {
            return $query->where('user_id', '=', auth()->id());
        })->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\ImageColumn::make('thumbnail')->label('Poster'),
            Tables\Columns\TextColumn::make('created_at')->label('Created at')->date('d M Y')->sortable(),
            Tables\Columns\TextColumn::make('updated_at')->label('Updated at')->date('d M Y')->sortable(),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
