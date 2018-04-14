@database @faq
Feature: Check FAQ entries retrieving functions when there's no FAQs in database

	# Happy path scenarios

	Scenario: Checking if empty FAQ set is received correctly
		When a client requests "/api/faq" with "GET" method
		Then "200" status code should be received
		And proper response array should be received
		And response array should have success status
		And response array should have empty message
		And response array should have empty data array

	# Fail scenarios

	Scenario Outline: Checking if retrieving empty FAQ set with forbidden method returns correct result
		When a client requests "/api/faq" with "<method>" method
		Then "404" status code should be received
		And proper response array should be received
		And response array should not have success status
		And response array should have message
		And response array should have empty data array

		Examples:
			| method  |
			| CONNECT |
			| DELETE  |
			| HEAD    |
			| OPTIONS |
			| PATCH   |
			| POST    |
			| PUT     |
			| TRACE   |
