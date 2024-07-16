<?php
namespace App\Service;

class CommonFunctions
{
    public static function fileExists(string $path, string $filename = null): string
    {
        if (file_exists($path . $filename) && !empty($filename)) {
            return $path . $filename;
        }
        return NO_IMAGE;
    }

    public static function convertToMoney(?string $value, $symbol = true) {
        if ($symbol) {
            return number_format($value ?? 0, 2, ',', ' ') . '&ensp;&euro;';
        }
        return number_format($value ?? 0, 2, ',', ' ');
    }

    public static function convertToHTMLAndTrim(string $text, ?int $trim = null): ?string {
        if ($trim !== null) {
            if (strlen($text) > $trim)
            {
                $offset = ($trim - 3) - strlen($text);
                $text = substr($text, 0, strrpos($text, ' ', $offset)) . ' [...]</p>';
            }
        }
        return html_entity_decode($text);
    }

}

