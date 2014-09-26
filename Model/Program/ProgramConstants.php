<?php

define("VALID_PROGRAM_TYPES", 
	serialize (array(
		ProgramConstants::BACHELORS_DEGREE,
		ProgramConstants::APPLIED_DEGREE,
		ProgramConstants::UNIVERSITY_TRANSFER,
		ProgramConstants::DIPLOMA,
		ProgramConstants::CERTIFICATE
	))
);

class ProgramConstants {
	const BACHELORS_DEGREE = "Bachelor's Degree";
	const APPLIED_DEGREE = "Applied Degree";
	const UNIVERSITY_TRANSFER = "University Transfer";
	const DIPLOMA = "Diploma";
	const CERTIFICATE = "Certificate";
}
