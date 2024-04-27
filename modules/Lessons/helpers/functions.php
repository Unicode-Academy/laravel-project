<?php

use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;

function getLessions($lessions, $old = '', $parentId = 0, $char = '')
{
    $id = request()->route()->lessonId;
    if ($lessions) {
        foreach ($lessions as $key => $lesson) {

            if ($lesson->parent_id == $parentId && $id != $lesson->id) {
                echo '<option value="' . $lesson->id . '"';
                if ($old == $lesson->id) {
                    echo ' selected';
                }
                echo '>' . $char . $lesson->name . '</option>';
                unset($lessions[$key]);
                getLessions($lessions, $old, $lesson->id, $char . ' |- ');
            }
        }
    }
}

function getTime($seconds)
{
    $mins = floor($seconds / 60);
    $seconds = floor($seconds - $mins * 60);
    $mins = $mins < 10 ? '0' . $mins : $mins;
    $seconds = $seconds < 10 ? '0' . $seconds : $seconds;
    return "$mins:$seconds";
}

function getLessonCount($course)
{
    $lessonRepository = app(LessonsRepositoryInterface::class);
    return $lessonRepository->getLessonCount($course);
}

function getModuleByPosition($course)
{
    $lessonRepository = app(LessonsRepositoryInterface::class);
    return $lessonRepository->getModuleByPosition($course);
}

function getLessonsByPosition($course, $moduleId = null, $isDocument = false)
{
    $lessonRepository = app(LessonsRepositoryInterface::class);
    return $lessonRepository->getLessonsByPosition($course, $moduleId, $isDocument);
}