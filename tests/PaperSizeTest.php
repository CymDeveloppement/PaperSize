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
        $this->assertCount(3, $formats['A4']);
        $this->assertEquals([210, 297], array_slice($formats['A4'], 0, 2));
    }
} 