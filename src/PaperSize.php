<?php
namespace Ycdev;

/**
 * PaperSize Class
 *
 * This class manages paper formats by providing methods to convert formats between different units,
 * get information about paper formats, and create GD images with specified formats.
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
    /**
     * Returns the list of supported units.
     *
     * @return array The list of supported units.
     */
    public static function unit(): array
    {
        return ['px', 'mm', 'cm', 'm', 'in'];
    }

    /**
     * Converts a paper format to the specified unit.
     *
     * @param array $format The paper format to convert.
     * @param string $unit The unit to convert to.
     * @param int $resolution The resolution for pixel conversion.
     * @param string $orientation The orientation of the format.
     * @return array The converted paper format.
     */
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
        return [((float)intval($format[0]*100)/100), ((float)intval($format[1]*100)/100)];
    }

    /**
     * Converts a paper format to pixels.
     *
     * @param array $format The paper format to convert.
     * @param int $resolution The resolution for pixel conversion.
     * @return array The converted paper format in pixels.
     */
    public static function px(array $format, int $resolution = 300): array
    {
        return self::convert($format, 'px', $resolution);
    }

    /**
     * Converts a paper format to centimeters.
     *
     * @param array $format The paper format to convert.
     * @return array The converted paper format in centimeters.
     */
    public static function cm(array $format): array
    {
        return self::convert($format, 'cm');
    }

    /**
     * Converts a paper format to inches.
     *
     * @param array $format The paper format to convert.
     * @return array The converted paper format in inches.
     */
    public static function in(array $format): array
    {
        return self::convert($format, 'in');
    }

    /**
     * Calculates the aspect ratio of a paper format.
     *
     * @param array $format The paper format.
     * @return float The aspect ratio of the paper format.
     */
    public static function ratio(array $format): float
    {
        return ($format[1] / $format[0]);
    }

    /**
     * Converts a paper format to landscape orientation.
     *
     * @param array $format The paper format to convert.
     * @return array The converted paper format in landscape orientation.
     */
    public static function landscape(array $format): array
    {
        return [$format[1], $format[0]];
    }

    /**
     * Returns all supported paper formats.
     *
     * @return array The list of all supported paper formats.
     */
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

    /**
     * Creates a GD image with the specified paper format.
     *
     * @param array $format The paper format.
     * @return \GdImage|false The created GD image or false on failure.
     */
    public static function gdImage(array $format): \GdImage  | false
    {
        $format = self::px($format);
        return imagecreate($format[0], $format[1]);
    }

} 