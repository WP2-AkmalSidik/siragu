<?php

if (! function_exists('toTitleCase')) {

    function toTitleCase(string $text): string
    {
        return Str::title(str_replace('_', ' ', $text));
    }
}
