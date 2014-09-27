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
	
	public function login($userDto){
		$user = (new UserRepository())->findUserByEmail($userDto->getEmail());
		SessionManager::login($user, $userDto);
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
}