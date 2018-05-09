@database @log @news
Feature: Check news retrieving functions when there's no news in database

	# Happy path scenarios

	Scenario: Checking if retrieving empty newsreel returns correct result
		When a client requests "/api/news" with "GET" method
		Then "200" status code should be received
		And proper response array should be received
		And response array should have success status
		And response array should have empty message
		And response array should have empty data array

	Scenario: Checking if retrieving non-existing news returns correct result
		When a client requests "/api/news/1" with "GET" method
		Then "400" status code should be received
		And proper response array should be received
		And response array should not have success status
		And response array should have message
		And response array should have empty data array

	Scenario: Checking if retrieving non-existing news returns correct result
		When a client requests "/api/news/a" with "GET" method
		Then "400" status code should be received
		And proper response array should be received
		And response array should not have success status
		And response array should have message
		And response array should have empty data array
