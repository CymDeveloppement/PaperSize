<?php
namespace Ycdev;

/**
 * 
 */
class PaperSize
{
	// ISO 216 FORMAT (mm)
	const A0 = [841, 1189];
	const A1 = [594, 841];
	const A2 = [420, 594];
	const A3 = [297, 420];
	const A4 = [210, 297];
	const A5 = [148, 210];
	const A6 = [105, 148];
	const A7 = [74, 105];
	const A8 = [52, 74];
	const A9 = [37, 52];
	const A10 = [26, 36];

	/*const B0 = [841, 1189];
	const B1 = [841, 1189];
	const B2 = [841, 1189];
	const B3 = [841, 1189];
	const B4 = [841, 1189];
	const B5 = [841, 1189];
	const B6 = [841, 1189];
	const B7 = [841, 1189];
	const B8 = [841, 1189];
	const B9 = [841, 1189];
	const B10 = [841, 1189];

	const C0 = [841, 1189];
	const C1 = [841, 1189];
	const C2 = [841, 1189];
	const C3 = [841, 1189];
	const C4 = [841, 1189];
	const C5 = [841, 1189];
	const C6 = [841, 1189];
	const C7 = [841, 1189];
	const C8 = [841, 1189];
	const C9 = [841, 1189];
	const C10 = [841, 1189];*/

	// FRENCH AFNOR FORMAT (mm)
	const FR_CLOCHE = [300, 400];


	// unit
	public static function unit(): array
	{
		return ['px', 'mm', 'cm', 'm', 'in'];
	}

	public static function convert(array $format, string $unit = 'px', int $resolution = 300, string $orientation = 'P'): array
	{
		switch ($unit) {
			case 'px':
				$mm_resolution = ($resolution/25.4);
				$format = [intval($format[0]*$mm_resolution), intval($format[1]*$mm_resolution)];
				break;
			case 'cm':
				$format = [$format[0]*0.1, $format[1]*0.1];
				break;
			case 'in':
				$format = [$format[0]*0.0393701, $format[1]*0.0393701];
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
		return ($format[1]/$format[0]);
	}

	public static function landscape(array $format): array
	{
		return [$array[1], $array[0]];
	}

	public static function allFormats(): array
	{

	}

}