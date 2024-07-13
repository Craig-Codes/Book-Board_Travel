<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils/utils.php'; // Use __DIR__ to get the current directory of utilsTest.php

class utilsTest extends TestCase
{
    public function testConvertMinutesToHoursAndMinutes()
    {
        // Test case 1: Test with 120 minutes (2 hours)
        $this->assertEquals("2 hours", convertMinutesToHoursAndMinutes(120));

        // Test case 2: Test with 90 minutes (1 hour 30 minutes)
        $this->assertEquals("1 hour 30 minutes", convertMinutesToHoursAndMinutes(90));

        // Test case 3: Test with 60 minutes (1 hour)
        $this->assertEquals("1 hour", convertMinutesToHoursAndMinutes(60));

        // Test case 4: Test with 45 minutes (45 minutes)
        $this->assertEquals("45 minutes", convertMinutesToHoursAndMinutes(45));

        // Test case 5: Test with 0 minutes (should return empty string)
        $this->assertEquals("", convertMinutesToHoursAndMinutes(0));

        // Test case 6: Test with negative minutes (should return empty string)
        $this->assertEquals("", convertMinutesToHoursAndMinutes(-30));
    }
}