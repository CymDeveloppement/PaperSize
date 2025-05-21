<?php
namespace Ycdev;

/**
 *
 */
class PaperSize
{
    const no = false;
    // ISO 216 FORMAT (mm)
    const A0  = [841, 1189];
    const A1  = [594, 841];
    const A2  = [420, 594];
    const A3  = [297, 420];
    const A4  = [210, 297];
    const A5  = [148, 210];
    const A6  = [105, 148];
    const A7  = [74, 105];
    const A8  = [52, 74];
    const A9  = [37, 52];
    const A10 = [26, 36];

    const B0  = [1000, 1414];
    const B1  = [707, 1000];
    const B2  = [500, 707];
    const B3  = [353, 500];
    const B4  = [250, 353];
    const B5  = [176, 250];
    const B6  = [125, 176];
    const B7  = [88, 125];
    const B8  = [62, 88];
    const B9  = [44, 62];
    const B10 = [31, 44];

    const C0  = [917, 1297];
    const C1  = [648, 917];
    const C2  = [458, 648];
    const C3  = [324, 458];
    const C4  = [229, 324];
    const C5  = [162, 229];
    const C6  = [114, 162];
    const C7  = [81, 114];
    const C8  = [57, 81];
    const C9  = [40, 57];
    const C10 = [28, 40];

    // FRENCH AFNOR FORMAT (mm)
    const FR_CLOCHE = [300, 400];

    // US FORMAT
    const US_JUNIOR_LEGAL      = [127, 203];
    const US_HALF_LETTER       = [127, 203];
    const US_QUARTO            = [127, 203];
    const US_FOOLSCAP_FOLIO    = [127, 203];
    const US_EXECUTIVE         = [127, 203];
    const US_GOVERNMENT_LETTER = [127, 203];
    const US_LETTER            = [127, 203];

    // unit
    public static function unit(): array
    {
        return ['px', 'mm', 'cm', 'm', 'in'];
    }

    public static function convert(array $format, string $unit = 'px', int $resolution = 300, string $orientation = 'P'): array
    {
        switch ($unit) {
            case 'px':
                $mm_resolution = ($resolution / 25.4);
                $format        = [intval($format[0] * $mm_resolution), intval($format[1] * $mm_resolution)];
                break;
            case 'cm':
                $format = [$format[0] * 0.1, $format[1] * 0.1];
                break;
            case 'in':
                $format = [$format[0] * 0.0393701, $format[1] * 0.0393701];
                break;
        }
        return $format;
    }

    public static function px(array $format, int $resolution = 300): array
    {
        return self::convert($format, 'px', $resolution);
    }

    public static function cm(array $format): array
    {
        return self::convert($format, 'cm');
    }

    public static function in(array $format): array
    {
        return self::convert($format, 'in');
    }

    public static function ratio(array $format): float
    {
        return ($format[1] / $format[0]);
    }

    public static function landscape(array $format): array
    {
        return [$array[1], $array[0]];
    }

    public static function allFormats(): array
    {
        $class = new \ReflectionClass(__CLASS__);

        $formats = array_filter($class->getConstants(), function ($const) {
            return (is_array($const) && count($const) == 2);
        });

        $userConstant = get_defined_constants(true);
        if (isset($userConstant['user'])) {
            foreach ($userConstant['user'] as $key => $value) {
                if (substr($key, 0, 9) == 'PAPERSIZE' && is_array($value) && count($value) == 2) {
                    $formats[$key] = $value;
                }
            }
        }

        foreach ($formats as $key => $value) {
            $formats[$key][] = trim(ucfirst(strtolower(str_replace('PAPERSIZE', '', str_replace('_', ' ', $key)))));
        }

        return $formats;
    }

    public static function gdImage(array $format): \GdImage  | false
    {
        return imagecreate($format[0], $format[1]);
    }

}
