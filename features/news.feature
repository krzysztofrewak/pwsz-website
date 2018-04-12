@database @news
Feature: Check news retrieving functions when there's some news in databasae

	Background: 
		Given a set of existing news in database:
			| id | title | content  | created_at          |
			| 1  | Test1 | Test 1.  | 2018-01-01 12:00:00 |
			| 2  | Test2 | Test 2.  | 2018-01-01 15:00:00 |
			| 3  | Test3 | Test 3.  | 2017-01-01 15:00:00 |

	# Happy path scenarios

	Scenario: Checking if retrieving non-empty newsreel returns correct result
		When a client requests "/api/news" with "GET" method
		Then "200" status code should be received
		And proper response array should be received
		And response array should have success status
		And response array should have empty message
		And response array should not have empty data array
		And received news should be arranged in chronological order

	Scenario: Checking if retrieving existing news returns correct result
		When a client requests "/api/news/1" with "GET" method
		Then "200" status code should be received
		And proper response array should be received
		And response array should have success status
		And response array should have empty message
		And response array should not have empty data array
		And response array data should have following values:
			| id | title | content  | timestamp           |
			| 1  | Test1 | Test 1.  | 2018-01-01 12:00:00 |

	# Fail scenarios

	Scenario Outline: Checking if retrieving non-empty newsreel with forbidden method returns correct result
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

	Scenario: Checking if retrieving non-existing news returns correct result
		When a client requests "/api/news/4" with "GET" method
		Then "400" status code should be received
		And proper response array should be received
		And response array should not have success status
		And response array should have message
		And response array should have empty data array

	Scenario Outline: Checking if retrieving non-existing news with forbidden method returns correct result
		When a client requests "/api/news/4" with "<method>" method
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

	Scenario: Checking if retrieving non-existing news returns correct result
		When a client requests "/api/news/a" with "GET" method
		Then "400" status code should be received
		And proper response array should be received
		And response array should not have success status
		And response array should have message
		And response array should have empty data array

	Scenario Outline: Checking if retrieving non-existing news with forbidden method returns correct result
		When a client requests "/api/news/a" with "<method>" method
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
