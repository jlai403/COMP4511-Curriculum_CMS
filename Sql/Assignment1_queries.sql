call recreate();

-- get approval chain steps for approval chain
select ac.name as 'ApprovalChain', acs.sequence, r.name
from ApprovalChainStep acs
	join ApprovalChain ac on (acs.approvalChain_id =ac.id)
	join Role r on (acs.role_id = r.id)
order by ac.name, sequence