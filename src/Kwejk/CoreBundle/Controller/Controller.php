<?php
namespace Kwejk\CoreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
class Controller extends BaseController
{
	protected function findOr404($repository, $id, $message = "Entity not found")
	{
		$entity = $this->getDoctrine()
			->getRepository($repository)
			->find($id);
		
		if (!$entity) {
			throw $this->createNotFoundException($message);
		}
		return $entity;
	}
}