<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils/db_helpers.php'; // Use __DIR__ to get the current directory of db_helpersTest.php

class db_helpersTest extends TestCase
{
    public function testWithAllParameters()
    {
        $form_destination = "New";
        $form_duration = "5";
        $form_filter = "price";
        $filter_order = "nights DESC";

        $result = searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order);

        $this->assertEquals(
            "SELECT * FROM offer WHERE 1=1 AND location LIKE ? AND nights = ? AND filter = ? ORDER BY nights DESC",
            $result['query']
        );
        $this->assertEquals(["%New%", "5", "price"], $result['params']);
    }

    public function testWithDestinationOnly()
    {
        $form_destination = "York";
        $form_duration = null;
        $form_filter = null;
        $filter_order = null;

        $result = searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order);

        $this->assertEquals(
            "SELECT * FROM offer WHERE 1=1 AND location LIKE ?",
            $result['query']
        );
        $this->assertEquals(["%York%"], $result['params']);
    }

    public function testWithNoParameters()
    {
        $form_destination = null;
        $form_duration = null;
        $form_filter = null;
        $filter_order = null;

        $result = searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order);

        $this->assertEquals("SELECT * FROM offer WHERE 1=1", $result['query']);
        $this->assertEmpty($result['params']);
    }

    public function testWithDurationOnly()
    {
        $form_destination = null;
        $form_duration = "10";
        $form_filter = null;
        $filter_order = null;

        $result = searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order);

        $this->assertEquals(
            "SELECT * FROM offer WHERE 1=1 AND nights = ?",
            $result['query']
        );
        $this->assertEquals(["10"], $result['params']);
    }

    public function testWithFilterOnly()
    {
        $form_destination = null;
        $form_duration = null;
        $form_filter = "price";
        $filter_order = null;

        $result = searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order);

        $this->assertEquals(
            "SELECT * FROM offer WHERE 1=1 AND filter = ?",
            $result['query']
        );
        $this->assertEquals(["price"], $result['params']);
    }

    public function testWithOrdering()
    {
        $form_destination = null;
        $form_duration = null;
        $form_filter = null;
        $filter_order = "travel_time ASC";

        $result = searchQueryStringBuilder($form_destination, $form_duration, $form_filter, $filter_order);

        $this->assertEquals(
            "SELECT * FROM offer WHERE 1=1 ORDER BY travel_time ASC",
            $result['query']
        );
        $this->assertEmpty($result['params']);
    }
}