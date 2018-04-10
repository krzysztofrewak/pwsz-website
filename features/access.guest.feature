@guest
Feature: Check application API
	When requested by Guzzle client
	And requested by guest

	Scenario: Check if non-existing hook is interpreted correctly
		When a client requests "/api/non/existing/hook"
		Then "404" status code should be received
		And response array has no success status

	Scenario: Check if authentication status is blocked correctly
		When a client requests "/api/auth" with "GET" method
		Then "401" status code should be received
		And response array has no success status

	Scenario: Check if authentication status is blocked correctly
		When a client requests "/api/auth" with "POST" method
		Then "401" status code should be received
		And response array has no success status

	Scenario: Checking if newsreel is received correctly
		When a client requests "/api/news" with "GET" method
		Then "200" status code should be received
		And response array has success status

	Scenario: Checking if courses table is received correctly
		When a client requests "/api/courses" with "GET" method
		Then "200" status code should be received
		And response array has success status

	Scenario: Checking if FAQ is received correctly
		When a client requests "/api/faq" with "GET" method
		Then "200" status code should be received
		And response array has success status

	Scenario: Check if FAQ management is blocked correctly
		When a client requests "/api/management/faqs" with "GET" method
		Then "401" status code should be received
		And response array has no success status
