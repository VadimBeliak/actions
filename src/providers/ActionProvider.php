<?php

namespace Hiraeth\Actions;

use Hiraeth;
use Hiraeth\Routing\ResolverInterface as Resolver;
use Hiraeth\Routing\UrlGeneratorInterface as UrlGenerator;
use Hiraeth\Templates\TemplateManagerInterface as TemplateManager;


/**
 * Providers add additional dependencies or configuration for objects of certain interfaces.
 */
class ActionProvider implements Hiraeth\Provider
{
	/**
	 * Get the interfaces for which the provider operates.
	 *
	 * @access public
	 * @return array A list of interfaces for which the provider operates
	 */
	static public function getInterfaces(): array
	{
		return [
			ActionInterface::class
		];
	}


	/**
	 * Prepare the instance.
	 *
	 * @access public
	 * @param Hiraeth\Application $app The application instance for which the delegate operates
	 * @return Object The prepared instance
	 */
	public function __invoke(object $instance, Hiraeth\Application $app): object
	{
		$instance->setResolver($app->get(Resolver::class));

		if ($app->has(UrlGenerator::class)) {
			$instance->setUrlGenerator($app->get(UrlGenerator::class));
		}

		if ($app->has(TemplateManager::class)) {
			$instance->setTemplateManager($app->get(TemplateManager::class));
		}

		return $instance;
	}
}
