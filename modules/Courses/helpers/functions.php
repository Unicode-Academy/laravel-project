<?php

function getCategoriesCheckbox($categories, $old='', $parentId=0, $char='')
{
    $id = request()->route()->category;
    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parentId && $id!=$category->id) {
                echo '<label class="d-block"><input type="checkbox"/> '.$char.$category->name.'</label>';
                unset($categories[$key]);
                getCategoriesCheckbox($categories, $old, $category->id, $char.' |- ');
            }
        }
    }
}
