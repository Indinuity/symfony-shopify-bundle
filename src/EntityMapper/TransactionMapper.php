<?php
namespace CodeCloud\Bundle\ShopifyBundle\EntityMapper;

use CodeCloud\Bundle\ShopifyBundle\Api\Request\GetJson;
use CodeCloud\Bundle\ShopifyBundle\Api\Request\PostJson;

class TransactionMapper extends EntityMapper
{
	/**
	 * @param int $orderId
	 * @param array $query
	 * @return array|GenericEntity
	 */
	public function findByOrder($orderId, array $query = array())
	{
		$request = new GetJson('/admin/orders/' . $orderId . '/transactions.json', $query);
		$response = $this->send($request);
		return $this->createCollection($response->get('transactions'));
	}

	/**
	 * @param int $orderId
	 * @return int
	 */
	public function countByOrder($orderId)
	{
		$request = new GetJson('/admin/orders/' . $orderId . '/transactions/count.json');
		$response = $this->send($request);
		return $response->get('count');
	}

	/**
	 * @param int $orderId
	 * @param int $transactionId
	 * @param array $fields
	 * @return GenericEntity
	 */
	public function findOne($orderId, $transactionId, array $fields = array())
	{
		$params = $fields ? array('fields' => implode(',', $fields)) : array();
		$request = new GetJson('/admin/orders/' . $orderId . '/transactions/' . $transactionId . '.json', $params);
		$response = $this->send($request);
		return $this->createEntity($response->get('transaction'));
	}

	/**
	 * @param int $orderId
	 * @param float|null $amount
	 */
	public function capture($orderId, $amount = null)
	{
		$params = array('kind' => 'capture');

		if ($amount) {
			$params['amount'] = (float)$amount;
		}

		$request = new PostJson('/admin/orders/' . $orderId . '/transactions.json', array('transaction' => $params));
		$this->send($request);
	}
}