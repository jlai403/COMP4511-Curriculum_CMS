<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/Model/Workflow/WorkflowDataDto.php');


class Test {
	private $html;
	
	public function __construct() {
		$this->html = "";
	}
	
	public function printWorkflow(WorkflowDataDto $workflowDataDto) {
		$workflowDataHtml = $this->getHtml($workflowDataDto);
		$this->prependToHtml($workflowDataHtml);
		
		$hasPrevious = !is_null($workflowDataDto->getPreviousWorkflowDataDto());
		if ($hasPrevious) $this->printWorkflow($workflowDataDto->getPreviousWorkflowDataDto());
		
		return $this->html;		
	}
	
	private function getHtml(WorkflowDataDto $workflowDataDto){
		ob_start();
		echo "<h1>".$workflowDataDto->getId()."</h1>";
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	private function prependToHtml($prepend) {
		$this->html = $prepend.$this->html;
	}
}

$workflowDataDto = new WorkflowDataDto();
$workflowDataDto->setId(1);

$workflowDataDto2 = new WorkflowDataDto();
$workflowDataDto2->setId(2);
$workflowDataDto2->setPreviousWorkflowDataDto($workflowDataDto);

$workflowDataDto3 = new WorkflowDataDto();
$workflowDataDto3->setId(3);
$workflowDataDto3->setPreviousWorkflowDataDto($workflowDataDto2);

echo (new Test())->printWorkflow($workflowDataDto3);
?>