@database @log @news
Feature: Check news routes exceptions handlers

	Scenario Outline: Checking if retrieving newsreel with forbidden method returns correct result
		When a client requests "/api/news" with "<method>" method
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

	Scenario Outline: Checking if retrieving non-existing news with forbidden method returns correct result
		When a client requests "/api/news/1" with "<method>" method
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

	Scenario Outline: Checking if retrieving non-existing news with forbidden method returns correct result
		When a client requests "/api/news/1" with "<method>" method
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
