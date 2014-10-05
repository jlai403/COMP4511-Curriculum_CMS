<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserAssembler.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/User/UserRepository.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/FacultyRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Faculty/FacultyAssembler.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Discipline/DisciplineAssembler.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/Controller/SessionManager.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Role/RoleAssembler.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInputDto.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramInitializer.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramRepository.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Program/ProgramAssembler.php');

require_once($_SERVER["DOCUMENT_ROOT"].'/Model/File/FileAssembler.php');

class FacadeFactory {
	
	public static function getDomainFacade(){
		return new DomainFacade();
	}
}

class DomainFacade {
	
	public function signUp(UserDto $userDto){
		$user = (new UserInitializer($userDto))->initialize();
		$user->assertValid();
		
		(new UserRepository())->create($user);
	}
	
	public function signIn($userDto){
		$user = (new UserRepository())->findUserByEmail($userDto->getEmail());
		SessionManager::signIn($user, $userDto);
	}
	
	public function logout(){
		SessionManager::logout();
	}
	
	public function findUserByEmail($email) {
		$user = (new UserRepository())->findUserByEmail($email);
		return (new UserAssembler())->assemble($user);
	}

	public function findAllRoles() {
		$roles = (new RoleRepository())->findAll();
		return (new RoleAssembler())->assembleAll($roles);
	}
	
	public function findRolesByIds($roleIds) {
		$roles = (new RoleRepository())->findRolesByIds($roleIds);
		return (new RoleAssembler())->assembleAll($roles);
	}

	public function findAllFaculties() {
		$faculties = (new FacultyRepository())->findAll();
		return (new FacultyAssembler())->assembleAll($faculties);
	}
	
	public function findAllDisciplines() {
		$disciplines = (new DisciplineRepository())->findAll();
		return (new DisciplineAssembler())->assembleAll($disciplines);
	}
	
	public function findDisiplineById($id) {
		$discipline = (new DisciplineRepository())->findById($id);
		return (new DisciplineAssembler())->assemble($discipline);
	}
	
	public function createProgramRequest(ProgramInputDto $programInputDto) {
		$program = (new ProgramInitializer($programInputDto))->initialize();
		$program->assertValid();
		(new ProgramRepository())->createProgramRequest($program);
	}
	
	public function findProgramsByRequester($email) {
		$user = (new UserRepository())->findUserByEmail($email);
		$programs = (new ProgramRepository())->findProgramsByRequester($user->getId());
		return (new ProgramAssembler())->assembleAll($programs);
	}
	
	public function findProgramById($id) {
		$program = (new ProgramRepository())->findById($id);
		return (new ProgramAssembler())->assemble($program);
	}
	
	public function findProgramsForApproval($email) {
		$user = (new UserRepository())->findUserByEmail($email);
		$programs = (new ProgramRepository())->findProgramsForApproval($user->getId());
		return (new ProgramAssembler())->assembleAll($programs);
	}
	
	public function approveProgram($userId, $programId) {
		$user = (new UserRepository())->findById($userId);
		$program = (new ProgramRepository())->findById($programId);
		(new ProgramRepository())->approve($user, $program);
	}
	
	public function rejectProgram($userId, $programId) {
		$user = (new UserRepository())->findById($userId);
		$program = (new ProgramRepository())->findById($programId);
		(new ProgramRepository())->reject($user, $program);
	}
	
	public function addCommentToProgram($programId, $commentString, $authorDto) {
		$comment = (new CommentInitializer($commentString, $authorDto))->initialize();
		$commentId = (new CommentRepository())->create($comment);
		(new ProgramRepository())->addCommentToProgram($programId, $commentId);
	}
	
	public function addFilesToProgram($programId, $fileInputDtos) {
		$files = (new FileInitializer())->initializeAll($fileInputDtos);
		(new ProgramRepository())->addFilesToProgram($programId, $files);
	}
	
	public function findFileById($fileId) {
		$file = (new FileRepository())->findById($fileId);
		return (new FileAssembler())->assemble($file);
	}
}