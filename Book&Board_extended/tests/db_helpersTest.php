<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils/db_helpers.php'; // Use __DIR__ to get the current directory of db_helpersTest.php

class db_helpersTest extends TestCase
{
    /**
     * Test case for no filters applied (default case).
     * It should use a wildcard for the location.
     */
    public function testNoFilters()
    {
        $result = searchQueryStringBuilder(null, "any", null, null);
        $expectedQuery = "SELECT * FROM offer WHERE 1=1 AND location LIKE ?";
        $expectedParams = ["%"];

        $this->assertEquals($expectedQuery, $result['query']);
        $this->assertEquals($expectedParams, $result['params']);
    }

    /**
     * Test case for applying a destination filter.
     * It should include the destination in the query.
     */
    public function testDestinationFilter()
    {
        $result = searchQueryStringBuilder("Paris", "any", null, null);
        $expectedQuery = "SELECT * FROM offer WHERE 1=1 AND location LIKE ?";
        $expectedParams = ["%Paris%"];

        $this->assertEquals($expectedQuery, $result['query']);
        $this->assertEquals($expectedParams, $result['params']);
    }

    /**
     * Test case for applying a duration filter.
     * It should include the duration in the query.
     */
    public function testDurationFilter()
    {
        $result = searchQueryStringBuilder(null, "7", null, null);
        $expectedQuery = "SELECT * FROM offer WHERE 1=1 AND location LIKE ? AND nights = ?";
        $expectedParams = ["%", "7"];

        $this->assertEquals($expectedQuery, $result['query']);
        $this->assertEquals($expectedParams, $result['params']);
    }

    /**
     * Test case for applying both destination and duration filters.
     * It should include both in the query.
     */
    public function testDestinationAndDurationFilters()
    {
        $result = searchQueryStringBuilder("Paris", "7", null, null);
        $expectedQuery = "SELECT * FROM offer WHERE 1=1 AND location LIKE ? AND nights = ?";
        $expectedParams = ["%Paris%", "7"];

        $this->assertEquals($expectedQuery, $result['query']);
        $this->assertEquals($expectedParams, $result['params']);
    }

    /**
     * Test case for applying valid filter and sort direction.
     * It should include both the filter and sort direction in the query.
     */
    public function testValidFilterAndSortDirection()
    {
        $result = searchQueryStringBuilder("Paris", "7", "price", "ASC");
        $expectedQuery = "SELECT * FROM offer WHERE 1=1 AND location LIKE ? AND nights = ? ORDER BY price ASC";
        $expectedParams = ["%Paris%", "7"];

        $this->assertEquals($expectedQuery, $result['query']);
        $this->assertEquals($expectedParams, $result['params']);
    }

    /**
     * Test case for invalid filter column.
     * It should throw an exception with the message 'Invalid filter column'.
     */
    public function testInvalidFilterColumn()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid filter column');
        searchQueryStringBuilder("Paris", "7", "invalid_filter", "ASC");
    }

    /**
     * Test case for invalid sort direction.
     * It should throw an exception with the message 'Invalid sort direction'.
     */
    public function testInvalidSortDirection()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid sort direction');
        searchQueryStringBuilder("Paris", "7", "price", "INVALID");
    }
}