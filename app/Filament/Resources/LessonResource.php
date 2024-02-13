<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Moderator Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lesson Info')->schema([
                    Forms\Components\TextInput::make('title')->filled(),
                    Forms\Components\RichEditor::make('description')->filled(),
                    Forms\Components\Select::make('course_id')
                        ->label('Course')->options(
                            Course::query()->where('user_id', auth()->id())->pluck('name', 'id')
                        )->searchable(),
                ]),
                Forms\Components\Section::make('Video')->schema([
                    Forms\Components\FileUpload::make('video')
                        ->directory('courses/lessons')->downloadable()->acceptedFileTypes(['video/mp4']),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->modifyQueryUsing(function (Builder $query) {
            $courses = Course::query()->where('user_id', auth()->id())->get();

            if (count($courses) === 0) return $query->where('course_id', '=', 0);
            return $query->whereBelongsTo($courses);
        })
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->searchable(),
                Tables\Columns\TextColumn::make('course.name')->label('Course')->searchable(),
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}
