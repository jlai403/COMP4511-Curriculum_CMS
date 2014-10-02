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
		return (new UserAssembler($user))->assemble();
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
}