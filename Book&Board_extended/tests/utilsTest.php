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

    protected function setUp(): void
    {
        $_GET = []; // Clear $_GET before each test
    }

    public function testValidateSearchInputWithValidParameter()
    {
        $_GET['destination'] = '<script>alert("XSS")</script>';
        $result = validateSearchInput('destination');
        $this->assertEquals('&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', $result);
    }

    public function testValidateSearchInputWithMissingParameter()
    {
        $result = validateSearchInput('nonexistent');
        $this->assertNull($result);
    }

    public function testValidateSearchInputWithEmptyParameter()
    {
        $_GET['destination'] = '';
        $result = validateSearchInput('destination');
        $this->assertEquals('', $result);
    }
    /**
     * Test valid input that is within the length limit.
     */
    public function testValidInput()
    {
        $_GET['test_key'] = 'valid_input';
        $result = validateSearchInput('test_key');
        $expected = htmlspecialchars('valid_input', ENT_QUOTES, 'UTF-8');

        $this->assertEquals($expected, $result);
    }

    /**
     * Test input that exceeds the length limit of 100 characters.
     */
    public function testInputTooLong()
    {
        $_GET['test_key'] = str_repeat('a', 101);
        $result = validateSearchInput('test_key');

        $this->assertNull($result);
    }

    /**
     * Test the absence of the input key.
     */
    public function testInputNotSet()
    {
        unset($_GET['test_key']);
        $result = validateSearchInput('test_key');

        $this->assertNull($result);
    }

    /**
     * Test input that contains special characters.
     */
    public function testInputWithSpecialCharacters()
    {
        $_GET['test_key'] = '<script>alert("test")</script>';
        $result = validateSearchInput('test_key');
        $expected = htmlspecialchars('<script>alert("test")</script>', ENT_QUOTES, 'UTF-8');

        $this->assertEquals($expected, $result);
    }

}