<?php

class WorkflowViewHelper {
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
		
		/** HTML START **/
		echo "

		";	
	 	/** HTML END **/
		
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	private function prependToHtml($prepend) {
		$this->html = $prepend.$this->html;
	}
}