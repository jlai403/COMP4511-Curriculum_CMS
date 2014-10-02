<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainStep.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/ApprovalChain/ApprovalChainStepDto.php');

class ApprovalChainAssembler {
	
	public function assemble(ApprovalChainStep $approvalChainStep) {
		$approvalChainStepDto = new ApprovalChainStepDto();
		$approvalChainStepDto->setId($approvalChainStep->getId());
		$approvalChainStepDto->setSequence($approvalChainStep->getSequence());
		
		$roleDto = (new RoleAssembler())->assemble($approvalChainStep->getRole());
		$approvalChainStepDto->setRoleDto($roleDto);
		return $approvalChainStepDto;
	}
}