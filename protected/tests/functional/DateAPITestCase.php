<?php
/**
 * Test Date API functions
 */
class DateAPITestCase extends CTestCase {
  
  public function testIndex()
	{
		$this->open('');
		$this->assertTextPresent('Welcome');
	}

  public function testDateAPI() {
    // Test date_format_date().
    $formatters = array(
      'a',
      'A',
      'B',
      'c',
      'd',
      'D',
      'e',
      'F',
      'g',
      'G',
      'h',
      'H',
      'i',
      'I',
      'j',
      'l',
      'L',
      'm',
      'M',
      'n',
      'N',
      'o',
      'O',
      'P',
      'r',
      'R',
      's',
      'S',
      't',
      'T',
      'u',
      'U',
      'w',
      'W',
      'y',
      'Y',
      'z',
      'Z',
    );
    foreach ($formatters as $formatter) {
      $date_api_format = date_format_date(date_now(), 'custom', $formatter);
      $php_format = date_format(date_now(), $formatter);
      $this->assertEqual($date_api_format, $php_format, 'Test that the "' . $formatter . '" formatter is formatted correctly by date_format_date()');
    }

    // Test the order of the weeks days for a calendar that starts on Monday and one that starts on Sunday.
    variable_set('date_first_day', 1);
    $expected = array ( 0 => t('Mon'), 1 => t('Tue'), 2 => t('Wed'), 3 => t('Thu'), 4 => t('Fri'), 5 => t('Sat'), 6 => t('Sun'), );
    $days = date_week_days_ordered(date_week_days_abbr(1));
    $this->assertEqual($expected, $days, 'Test that date_week_days_ordered() array starts on Monday when the site first day is on Monday.');
    variable_set('date_first_day', 0);
    $expected = array ( 0 => t('Sun'), 1 => t('Mon'), 2 => t('Tue'), 3 => t('Wed'), 4 => t('Thu'), 5 => t('Fri'), 6 => t('Sat'), );
    $days = date_week_days_ordered(date_week_days_abbr(1));
    $this->assertEqual($expected, $days, 'Test that date_week_days_ordered() array starts on Sunday when the site first day is on Sunday.');

    // Test days in February for a leap year and a non-leap year.
    $expected = 28;
    $value = date_days_in_month(2005, 2);
    $this->assertEqual($expected, $value, "Test date_days_in_month(2, 2005): should be $expected, found $value.");
    $expected = 29;
    $value = date_days_in_month(2004, 2);
    $this->assertEqual($expected, $value, "Test date_days_in_month(2, 2004): should be $expected, found $value.");

    // Test days in year for a leap year and a non-leap year.
    $expected = 365;
    $value = date_days_in_year('2005-06-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_days_in_year(2005-06-01): should be $expected, found $value.");    
    $expected = 366;
    $value = date_days_in_year('2004-06-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_days_in_year(2004-06-01): should be $expected, found $value.");

    // Test ISO weeks for a leap year and a non-leap year.
    $expected = 52;
    $value = date_iso_weeks_in_year('2008-06-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_iso_weeks_in_year(2008-06-01): should be $expected, found $value.");    
    $expected = 53;
    $value = date_iso_weeks_in_year('2009-06-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_iso_weeks_in_year(2009-06-01): should be $expected, found $value.");

    // Test day of week for March 1, the day after leap day.
    $expected = 6;
    $value = date_day_of_week('2008-03-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_day_of_week(2008-03-01): should be $expected, found $value.");    
    $expected = 0;
    $value = date_day_of_week('2009-03-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_day_of_week(2009-03-01): should be $expected, found $value.");

    // Test day of week name for March 1, the day after leap day.
    $expected = 'Sat';
    $value = date_day_of_week_name('2008-03-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_day_of_week_name(2008-03-01): should be $expected, found $value.");    
    $expected = 'Sun';
    $value = date_day_of_week_name('2009-03-01 00:00:00');
    $this->assertEqual($expected, $value, "Test date_day_of_week_name(2009-03-01): should be $expected, found $value.");

    // Test week range with calendar weeks.
    variable_set('date_first_day', 0);
    variable_set('date_api_use_iso8601', FALSE);
    $expected = '2008-01-27 to 2008-02-03';
    $result = date_week_range(5, 2008);
    $value = $result[0]->format(DATE_FORMAT_DATE) .' to '. $result[1]->format(DATE_FORMAT_DATE);
    $this->assertEqual($expected, $value, "Test calendar date_week_range(5, 2008): should be $expected, found $value.");    
    $expected = '2009-01-25 to 2009-02-01';
    $result = date_week_range(5, 2009);
    $value = $result[0]->format(DATE_FORMAT_DATE) .' to '. $result[1]->format(DATE_FORMAT_DATE);
    $this->assertEqual($expected, $value, "Test calendar date_week_range(5, 2009): should be $expected, found $value.");

    // And now with ISO weeks.
    variable_set('date_first_day', 1);
    variable_set('date_api_use_iso8601', TRUE);
    $expected = '2008-01-28 to 2008-02-04';
    $result = date_week_range(5, 2008);
    $value = $result[0]->format(DATE_FORMAT_DATE) .' to '. $result[1]->format(DATE_FORMAT_DATE);
    $this->assertEqual($expected, $value, "Test ISO date_week_range(5, 2008): should be $expected, found $value.");    
    $expected = '2009-01-26 to 2009-02-02';
    $result = date_week_range(5, 2009);
    $value = $result[0]->format(DATE_FORMAT_DATE) .' to '. $result[1]->format(DATE_FORMAT_DATE);
    $this->assertEqual($expected, $value, "Test ISO date_week_range(5, 2009): should be $expected, found $value.");
    variable_set('date_api_use_iso8601', FALSE);

    // Find calendar week for a date.
    variable_set('date_first_day', 0);
    $expected = '09';
    $value = date_week('2008-03-01');
    $this->assertEqual($expected, $value, "Test date_week(2008-03-01): should be $expected, found $value.");    
    $expected = '10';
    $value = date_week('2009-03-01');
    $this->assertEqual($expected, $value, "Test date_week(2009-03-01): should be $expected, found $value.");

    // Create date object from datetime string.
    $input = '2009-03-07 10:30';
    $timezone = 'America/Chicago';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '2009-03-07T10:30:00-06:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone): should be $expected, found $value.");

    // Same during daylight savings time.
    $input = '2009-06-07 10:30';
    $timezone = 'America/Chicago';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '2009-06-07T10:30:00-05:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone): should be $expected, found $value.");

    // Create date object from date string.
    $input = '2009-03-07';
    $timezone = 'America/Chicago';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '2009-03-07T00:00:00-06:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone): should be $expected, found $value.");

    // Same during daylight savings time.
    $input = '2009-06-07';
    $timezone = 'America/Chicago';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '2009-06-07T00:00:00-05:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone): should be $expected, found $value.");

    // Create date object from date array, date only.
    $input = array('year' => 2010, 'month' => 2, 'day' => 28);
    $timezone = 'America/Chicago';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '2010-02-28T00:00:00-06:00';
    $this->assertEqual($expected, $value, "Test new dateObject(array('year' => 2010, 'month' => 2, 'day' => 28), $timezone): should be $expected, found $value.");

    // Create date object from date array with hour.
    $input = array('year' => 2010, 'month' => 2, 'day' => 28, 'hour' => 10);
    $timezone = 'America/Chicago';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '2010-02-28T10:00:00-06:00';
    $this->assertEqual($expected, $value, "Test new dateObject(array('year' => 2010, 'month' => 2, 'day' => 28, 'hour' => 10), $timezone): should be $expected, found $value.");

    // 0 = January 1, 1970 00:00:00 (UTC);
    // 1000000000 = September 9, 2001 01:46:40 (UTC);

    // Create date object from unix timestamp and convert it to a local date.
    $input = 0;
    $timezone = 'UTC';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '1970-01-01T00:00:00+00:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone): should be $expected, found $value.");

    $expected = 'UTC';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone is $value: should be $expected.");    
    $expected = 0;
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset is $value: should be $expected.");    

    $timezone = 'America/Los_Angeles';
    $date->setTimezone(new DateTimeZone($timezone));
    $value = $date->format('c');
    $expected = '1969-12-31T16:00:00-08:00';
    $this->assertEqual($expected, $value, "Test \$date->setTimezone(new DateTimeZone($timezone)): should be $expected, found $value.");

    $expected = 'America/Los_Angeles';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone should be $expected, found $value.");
    $expected = '-28800';
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset should be $expected, found $value.");    

    // Convert the local version of a timestamp to UTC.
    $input = 0;
    $timezone = 'America/Los_Angeles';
    $date = new dateObject($input, $timezone);
    $offset = $date->getOffset();
    $value = $date->format('c');
    $expected = '1969-12-31T16:00:00-08:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone):  should be $expected, found $value.");

    $expected = 'America/Los_Angeles';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone should be $expected, found $value.");
    $expected = '-28800';
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset should be $expected, found $value.");    

    $timezone = 'UTC';
    $date->setTimezone(new DateTimeZone($timezone));
    $value = $date->format('c');
    $expected = '1970-01-01T00:00:00+00:00';
    $this->assertEqual($expected, $value, "Test \$date->setTimezone(new DateTimeZone($timezone)): should be $expected, found $value.");

    $expected = 'UTC';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone should be $expected, found $value.");
    $expected = '0';
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset should be $expected, found $value.");  

     // Create date object from datetime string and convert it to a local date.
    $input = '1970-01-01 00:00:00';
    $timezone = 'UTC';
    $date = new dateObject($input, $timezone);
    $value = $date->format('c');
    $expected = '1970-01-01T00:00:00+00:00';
    $this->assertEqual($expected, $value, "Test new dateObject('$input', '$timezone'): should be $expected, found $value.");

    $expected = 'UTC';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone is $value: should be $expected.");    
    $expected = 0;
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset is $value: should be $expected.");    

    $timezone = 'America/Los_Angeles';
    $date->setTimezone(new DateTimeZone($timezone));
    $value = $date->format('c');
    $expected = '1969-12-31T16:00:00-08:00';
    $this->assertEqual($expected, $value, "Test \$date->setTimezone(new DateTimeZone($timezone)): should be $expected, found $value.");

    $expected = 'America/Los_Angeles';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone should be $expected, found $value.");
    $expected = '-28800';
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset should be $expected, found $value.");    

    // Convert the local version of a datetime string to UTC.
    $input = '1969-12-31 16:00:00';
    $timezone = 'America/Los_Angeles';
    $date = new dateObject($input, $timezone);
    $offset = $date->getOffset();
    $value = $date->format('c');
    $expected = '1969-12-31T16:00:00-08:00';
    $this->assertEqual($expected, $value, "Test new dateObject('$input', '$timezone'):  should be $expected, found $value.");

    $expected = 'America/Los_Angeles';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone should be $expected, found $value.");
    $expected = '-28800';
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset should be $expected, found $value.");    

    $timezone = 'UTC';
    $date->setTimezone(new DateTimeZone($timezone));
    $value = $date->format('c');
    $expected = '1970-01-01T00:00:00+00:00';
    $this->assertEqual($expected, $value, "Test \$date->setTimezone(new DateTimeZone($timezone)): should be $expected, found $value.");

    $expected = 'UTC';
    $value = $date->getTimeZone()->getName();
    $this->assertEqual($expected, $value, "The current timezone should be $expected, found $value.");
    $expected = '0';
    $value = $date->getOffset();
    $this->assertEqual($expected, $value, "The current offset should be $expected, found $value.");       

     // Create year-only date.
    $input = '2009';
    $timezone = NULL;
    $format = 'Y';
    $date = new dateObject($input, $timezone, $format);
    $value = $date->format('Y');
    $expected = '2009';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone, $format): should be $expected, found $value.");

     // Create month and year-only date.
    $input = '2009-10';
    $timezone = NULL;
    $format = 'Y-m';
    $date = new dateObject($input, $timezone, $format);
    $value = $date->format('Y-m');
    $expected = '2009-10';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone, $format): should be $expected, found $value.");

     // Create time-only date.
    $input = '0000-00-00T10:30:00';
    $timezone = NULL;
    $format = 'Y-m-d\TH:i:s';
    $date = new dateObject($input, $timezone, $format);
    $value = $date->format('H:i:s');
    $expected = '10:30:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone, $format): should be $expected, found $value.");

     // Create time-only date.
    $input = '10:30:00';
    $timezone = NULL;
    $format = 'H:i:s';
    $date = new dateObject($input, $timezone, $format);
    $value = $date->format('H:i:s');
    $expected = '10:30:00';
    $this->assertEqual($expected, $value, "Test new dateObject($input, $timezone, $format): should be $expected, found $value.");

  }
}