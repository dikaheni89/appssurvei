<?php
if ( ! function_exists('render'))
{
    function render(string $name, array $data = [], array $options = [])
    {
        return view(
            'layout',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }

    function renderweb(string $name, array $data = [], array $options = [])
    {
        return view(
            'layoutweb',
            [
                'content' => view($name, $data, $options),
            ],
            $options
        );
    }
}