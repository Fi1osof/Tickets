<?php
/**
 * Resolve update comments count
 * @var xPDOObject $object
 * @var array $options
 * @package tickets
 * @subpackage build
 */
if ($object->xpdo) {
	$modx =& $object->xpdo;
	$modelPath = $modx->getOption('tickets.core_path',null,$modx->getOption('core_path').'components/tickets/').'model/';

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
		case xPDOTransport::ACTION_UPGRADE:
			$modx->addPackage('tickets',$modelPath);

			$threads = $modx->getCollection('TicketThread', array('comments' => 0));
			/** @var TicketThread $thread */
			foreach ($threads as $thread) {
				$thread->updateCommentsCount();
			}
		break;

		case xPDOTransport::ACTION_UNINSTALL:
		break;
	}
}
return true;