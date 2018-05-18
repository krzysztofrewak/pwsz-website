@database @log @consultation
Feature: Check consultations retrieving functions when there's some consultations in database

	Background:
		Given a set of existing consultations in database:
			| id | datetime            | place | created_at          |
			| 1  | 2018-01-01 12:00:00 | A1    | 2018-01-01 00:00:00 |
			| 2  | 2018-01-08 12:00:00 | A1    | 2018-01-01 00:00:00 |
			| 3  | 2018-01-15 12:00:00 | A1    | 2018-01-01 00:00:00 |

 # Happy path scenarios

	Scenario: Checking if retrieving non-empty consultations list returns correct result
		When a client requests "/api/consultations" with "GET" method
		Then "200" status code should be received
		And proper response array should be received
		And response array should have success status
		And response array should have empty message
		And response array should not have empty data array
		And there should be "3" consultation entries
		And received consultation should be arranged in chronological order
		And logger have logged messages:
			| type | count |
			| info | 1     |
