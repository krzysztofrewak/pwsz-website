@database @auth
Feature: Check application API
	When requested by authenticated user

	Scenario: Check if non-existing hook is interpreted correctly
		When a client requests "/api/non/existing/hook"
		Then "404" status code should be received
		And response array should not have success status

	Scenario: Check if authentication status is blocked correctly
		When a client requests "/api/auth" with "GET" method
		Then "200" status code should be received
		And response array should have success status

	Scenario: Check if authentication status is blocked correctly
		When a client requests "/api/auth" with "POST" method
		Then "200" status code should be received
		And response array should have success status
