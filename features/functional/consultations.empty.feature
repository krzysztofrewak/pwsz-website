@database @log @consultation
Feature: Check consultations retrieving functions when there's no consultations in database

 # Happy path scenarios

	Scenario: Checking if empty consultations set is received correctly
		When a client requests "/api/consultations" with "GET" method
		Then "200" status code should be received
		And proper response array should be received
		And response array should have success status
		And response array should have empty message
		And response array should have empty data array
		And logger have logged messages:
			| type | count |
			| info | 1     |

 # Fail scenarios

	Scenario Outline: Checking if retrieving empty consultations set with forbidden method returns correct result
		When a client requests "/api/consultations" with "<method>" method
		Then "404" status code should be received
		And proper response array should be received
		And response array should not have success status
		And response array should have message
		And response array should have empty data array
		And logger have logged messages:
			| type    | count |
			| warning | 1     |

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
