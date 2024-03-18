<?php
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

function getTime($seconds) {
    $mins = floor($seconds / 60);
    $seconds = floor($seconds - $mins * 60);
    $mins = $mins < 10 ? '0'.$mins: $mins;
    $seconds = $seconds < 10 ? '0'.$seconds:$seconds;
    return "$mins:$seconds";
}