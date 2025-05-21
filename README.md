# PaperSize

A PHP class for managing paper formats and their conversions.

## Installation

```bash
composer require ycdev/paper-size
```

## Supported Paper Formats

### ISO Formats

| Format | Dimensions (mm) | Description |
|--------|----------------|-------------|
| A0     | 841 × 1189    | Largest standard ISO format |
| A1     | 594 × 841     | Half of A0 |
| A2     | 420 × 594     | Half of A1 |
| A3     | 297 × 420     | Half of A2 |
| A4     | 210 × 297     | Standard paper size |
| A5     | 148 × 210     | Half of A4 |
| A6     | 105 × 148     | Half of A5 |
| A7     | 74 × 105      | Half of A6 |
| A8     | 52 × 74       | Half of A7 |
| A9     | 37 × 52       | Half of A8 |
| A10    | 26 × 36       | Half of A9 |

### B Series (ISO)

| Format | Dimensions (mm) | Description |
|--------|----------------|-------------|
| B0     | 1000 × 1414   | Largest B series format |
| B1     | 707 × 1000    | Half of B0 |
| B2     | 500 × 707     | Half of B1 |
| B3     | 353 × 500     | Half of B2 |
| B4     | 250 × 353     | Half of B3 |
| B5     | 176 × 250     | Half of B4 |
| B6     | 125 × 176     | Half of B5 |
| B7     | 88 × 125      | Half of B6 |
| B8     | 62 × 88       | Half of B7 |
| B9     | 44 × 62       | Half of B8 |
| B10    | 31 × 44       | Half of B9 |

### C Series (ISO)

| Format | Dimensions (mm) | Description |
|--------|----------------|-------------|
| C0     | 917 × 1297    | Largest C series format |
| C1     | 648 × 917     | Half of C0 |
| C2     | 458 × 648     | Half of C1 |
| C3     | 324 × 458     | Half of C2 |
| C4     | 229 × 324     | Half of C3 |
| C5     | 162 × 229     | Half of C4 |
| C6     | 114 × 162     | Half of C5 |
| C7     | 81 × 114      | Half of C6 |
| C8     | 57 × 81       | Half of C7 |
| C9     | 40 × 57       | Half of C8 |
| C10    | 28 × 40       | Half of C9 |

### US Formats

| Format | Dimensions (mm) | Description |
|--------|----------------|-------------|
| US Letter | 216 × 279 | Standard US paper size |
| US Legal | 216 × 356 | Legal documents |
| US Junior Legal | 127 × 203 | Junior legal size |
| US Half Letter | 127 × 203 | Half of US Letter |
| US Executive | 184 × 267 | Executive size |
| US Government Letter | 203 × 267 | Government documents |

### French Formats

| Format | Dimensions (mm) | Description |
|--------|----------------|-------------|
| FR Cloche | 300 × 400 | French standard format |

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

GPL V3
