# PaperSize

A PHP class for managing paper formats and their conversions.

## Installation

```bash
composer require ycdev/paper-size
```

## Usage

### Available Paper Formats

The class includes the following standard formats:
- ISO formats (A0-A10, B0-B10, C0-C10)
- US formats (Letter, Legal, etc.)
- French formats (Cloche)

### Usage Examples

#### Unit Conversion

```php
use Ycdev\PaperSize;

// Get A4 dimensions in pixels (default 300 DPI)
$dimensions = PaperSize::px(PaperSize::A4);
// Result: [2480, 3508]

// Get A4 dimensions in centimeters
$dimensions = PaperSize::cm(PaperSize::A4);
// Result: [21.0, 29.7]

// Get A4 dimensions in inches
$dimensions = PaperSize::in(PaperSize::A4);
// Result: [8.27, 11.69]
```

#### Creating a GD Image

```php
use Ycdev\PaperSize;

// Create a GD image with A4 dimensions
$image = PaperSize::gdImage(PaperSize::A4);
```

#### Calculating Aspect Ratio

```php
use Ycdev\PaperSize;

// Get the aspect ratio of A4 format
$ratio = PaperSize::ratio(PaperSize::A4);
// Result: 1.4142
```

#### Landscape Mode

```php
use Ycdev\PaperSize;

// Convert A4 format to landscape
$landscape = PaperSize::landscape(PaperSize::A4);
// Result: [297, 210]
```

#### List All Available Formats

```php
use Ycdev\PaperSize;

// Get all available formats
$formats = PaperSize::allFormats();
```

## Supported Units

- px (pixels)
- mm (millimeters)
- cm (centimeters)
- m (meters)
- in (inches)

## Resolution

The default resolution for pixel conversions is 300 DPI. You can modify it when calling the methods:

```php
use Ycdev\PaperSize;

// Convert to pixels with 600 DPI resolution
$dimensions = PaperSize::px(PaperSize::A4, 600);
```

## License

MIT
