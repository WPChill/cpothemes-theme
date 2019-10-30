<?php

if (! function_exists('ctsc_do_shortcode')) {
    function ctsc_do_shortcode($content)
    {
        $content = do_shortcode(shortcode_unautop($content));
        $content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
        return $content;
    }
}
