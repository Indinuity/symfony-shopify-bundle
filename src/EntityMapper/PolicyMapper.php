<?php
namespace CodeCloud\Bundle\ShopifyBundle\EntityMapper;

use CodeCloud\Bundle\ShopifyBundle\Api\Request\GetJson;

class PolicyMapper extends EntityMapper
{
	/**
	 * @param array $query
	 * @return array|GenericEntity[]
	 */
	public function findAll(array $query = array())
	{
		$request = new GetJson('/admin/policies.json', $query);
		$response = $this->send($request);
		return $this->createCollection($response->get('policies'));
	}
}