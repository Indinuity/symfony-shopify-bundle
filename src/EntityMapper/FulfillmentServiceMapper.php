<?php
namespace CodeCloud\Bundle\ShopifyBundle\EntityMapper;

use CodeCloud\Bundle\ShopifyBundle\Api\Request\DeleteParams;
use CodeCloud\Bundle\ShopifyBundle\Api\Request\GetJson;
use CodeCloud\Bundle\ShopifyBundle\Api\Request\PostJson;
use CodeCloud\Bundle\ShopifyBundle\Api\Request\PutJson;
use CodeCloud\Bundle\ShopifyBundle\Entity\GenericEntity;

class FulfillmentServiceMapper extends EntityMapper
{
	/**
	 * @param array $query
	 * @return array|GenericEntity[]
	 */
	public function findAll(array $query = array('scope' => 'all'))
	{
		$request = new GetJson('/admin/fulfillment_services.json', $query);
		$response = $this->send($request);
		return $this->createCollection($response->get('fulfillment_services'));
	}

	/**
	 * @param int $fulfillmentServiceId
	 * @return GenericEntity
	 */
	public function findOne($fulfillmentServiceId)
	{
		$request = new GetJson('/admin/fulfillment_services/' . $fulfillmentServiceId . '.json');
		$response = $this->send($request);
		return $this->createEntity($response->get('fulfillment_service'));
	}

	/**
	 * @param GenericEntity $fulfillmentService
	 * @return GenericEntity
	 */
	public function create(GenericEntity $fulfillmentService)
	{
		$request = new PostJson('/admin/fulfillment_services.json', array('fulfillment_service' => $fulfillmentService->toArray()));
		$response = $this->send($request);
		return $this->createEntity($response->get('fulfillment_service'));
	}

	/**
	 * @param int $fulfillmentServiceId
	 * @param GenericEntity $fulfillmentService
	 * @return GenericEntity
	 */
	public function update($fulfillmentServiceId, GenericEntity $fulfillmentService)
	{
		$request = new PutJson('/admin/fulfillment_services/' . $fulfillmentServiceId . '.json', array('fulfillment_service' => $fulfillmentService->toArray()));
		$response = $this->send($request);
		return $this->createEntity($response->get('fulfillment_service'));
	}

	/**
	 * @param int $fulfillmentServiceId
	 */
	public function delete($fulfillmentServiceId)
	{
		$request = new DeleteParams('/admin/fulfillment_services/' . $fulfillmentServiceId . '.json');
		$this->send($request);
	}
}