@access
Feature: Check application API
	When requested by Guzzle client
	And requested by guest

	Scenario: Check if non-existing hook is interpreted correctly
		When the Guzzle client requests "/non/existing/hook" with "GET" method
		Then "404" status code should be received
		And response array has no success status

	Scenario: Check if authentication status is blocked correctly
		When the Guzzle client requests "/auth" with "GET" method
		Then "401" status code should be received
		And response array has no success status

	Scenario: Check if authentication status is blocked correctly
		When the Guzzle client requests "/auth" with "POST" method
		Then "401" status code should be received
		And response array has no success status

	Scenario: Checking if newsreel is received correctly
		When the Guzzle client requests "/news" with "GET" method
		Then "200" status code should be received
		And response array has success status

	Scenario: Checking if courses table is received correctly
		When the Guzzle client requests "/courses" with "GET" method
		Then "200" status code should be received
		And response array has success status

	Scenario: Checking if FAQ is received correctly
		When the Guzzle client requests "/faq" with "GET" method
		Then "200" status code should be received
		And response array has success status

	Scenario: Check if FAQ management is blocked correctly
		When the Guzzle client requests "/management/faqs" with "GET" method
		Then "401" status code should be received
		And response array has no success status