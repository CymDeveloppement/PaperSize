<?php
namespace Tests;
require_once __DIR__ . '/../src/PaperSize.php';
use PHPUnit\Framework\TestCase;
use Ycdev\PaperSize;

class PaperSizeTest extends TestCase
{
    /**
     * Test unit conversion methods
     */
    public function testUnitConversion()
    {
        // Test px conversion
        $this->assertEquals(
            [2480, 3507],
            PaperSize::px(PaperSize::A4)
        );
        $this->assertEquals(
            [4960, 7015],
            PaperSize::px(PaperSize::A4, 600)
        );

        // Test cm conversion
        $this->assertEquals(
            [21.0, 29.7],
            PaperSize::cm(PaperSize::A4)
        );

        // Test inch conversion
        $this->assertEquals(
            [8.26, 11.69],
            PaperSize::in(PaperSize::A4)
        );
    }

    /**
     * Test ratio calculation
     */
    public function testRatio()
    {
        $this->assertEquals(
            1.4143,
            round(PaperSize::ratio(PaperSize::A4), 4)
        );
    }

    /**
     * Test landscape conversion
     */
    public function testLandscape()
    {
        $this->assertEquals(
            [297, 210],
            PaperSize::landscape(PaperSize::A4)
        );
    }

    /**
     * Test GD image creation
     */
    public function testGdImage()
    {
        $image = PaperSize::gdImage(PaperSize::A4);
        $this->assertNotFalse($image);
        $this->assertEquals(2480, imagesx($image));
        $this->assertEquals(3507, imagesy($image));
    }

    /**
     * Test available units
     */
    public function testUnit()
    {
        $expectedUnits = ['px', 'mm', 'cm', 'm', 'in'];
        $this->assertEquals($expectedUnits, PaperSize::unit());
    }

    /**
     * Test all formats listing
     */
    public function testAllFormats()
    {
        $formats = PaperSize::allFormats();

        // Test if A4 exists in formats
        $this->assertArrayHasKey('A4', $formats);

        // Test if format contains dimensions and name
        $this->assertArrayHasKey('width', $formats['A4']);
        $this->assertArrayHasKey('height', $formats['A4']);
        $this->assertArrayHasKey('name', $formats['A4']);
        $this->assertEquals(210, $formats['A4']['width']);
        $this->assertEquals(297, $formats['A4']['height']);
        $this->assertEquals('A4', $formats['A4']['name']);
    }

    /**
     * Test format detection with exact pixel dimensions
     */
    public function testFormatExactMatch()
    {
        $a4px = PaperSize::px(PaperSize::A4);
        $this->assertEquals('A4', PaperSize::format($a4px[0], $a4px[1]));
    }

    /**
     * Test format detection with precision tolerance
     */
    public function testFormatWithPrecision()
    {
        $a4px = PaperSize::px(PaperSize::A4);
        $this->assertEquals('A4', PaperSize::format($a4px[0] + 1, $a4px[1] - 1));
        $this->assertEquals('A4', PaperSize::format($a4px[0] - 2, $a4px[1] + 2));
    }

    /**
     * Test format detection in landscape orientation
     */
    public function testFormatLandscape()
    {
        $a4px = PaperSize::px(PaperSize::A4);
        $this->assertEquals('A4', PaperSize::format($a4px[1], $a4px[0]));
    }

    /**
     * Test format returns false when no match
     */
    public function testFormatNoMatch()
    {
        $this->assertFalse(PaperSize::format(1, 1));
        $this->assertFalse(PaperSize::format(9999, 9999));
    }

    /**
     * Test format detection with custom resolution
     */
    public function testFormatCustomResolution()
    {
        $a4px = PaperSize::px(PaperSize::A4, 600);
        $this->assertEquals('A4', PaperSize::format($a4px[0], $a4px[1], 2, 600));
    }

    /**
     * Test crop returns a valid GD image
     */
    public function testCrop()
    {
        $image = PaperSize::gdImage(PaperSize::A4);
        $cropped = PaperSize::crop($image, PaperSize::A5);
        $a5px = PaperSize::px(PaperSize::A5);
        $this->assertInstanceOf(\GdImage::class, $cropped);
        $this->assertEquals($a5px[0], imagesx($cropped));
        $this->assertEquals($a5px[1], imagesy($cropped));
    }

    /**
     * Test convert with landscape orientation
     */
    public function testConvertLandscape()
    {
        $portrait = PaperSize::convert(PaperSize::A4, 'mm');
        $landscape = PaperSize::convert(PaperSize::A4, 'mm', 300, 'L');
        $this->assertEquals($portrait[0], $landscape[1]);
        $this->assertEquals($portrait[1], $landscape[0]);
    }

    /**
     * Test convert to meters
     */
    public function testConvertMeters()
    {
        $result = PaperSize::convert(PaperSize::A4, 'm');
        $this->assertEquals(0.21, $result[0]);
        $this->assertEquals(0.29, $result[1]);
    }
}