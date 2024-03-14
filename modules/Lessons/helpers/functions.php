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
