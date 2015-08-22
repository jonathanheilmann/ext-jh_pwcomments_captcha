<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2014-2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * The extended comment controller
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_JhPwcommentsCaptcha_Controller_CaptchaController extends Tx_PwComments_Controller_CommentController {
	/**
	 * initializeActionMethodValidators to dynamically add validators
	 *
	 * @return void
	 */
	public function initializeActionMethodValidators() {
		parent::initializeActionMethodValidators();

		$requestArguments = $this->request->getArguments();
		foreach ($this->arguments as $argument) {
			/* @var  Tx_Extbase_MVC_Controller_Argument $argument */
			if ($argument->getName() == 'newComment' && $this->actionMethodName == 'createAction') {
				// Get the validators of the model
				/* @var Tx_Extbase_Validation_Validator_ConjunctionValidator $validator */
				$validator = $argument->getValidator();

				// If activated and available add the modified sr_freecap validator
				if($this->settings['captcha'] == 'sr_freecap' && \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('sr_freecap')) {
					$captchaValidator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_JhPwcommentsCaptcha_Validation_Validator_SrFreecapValidator');
					$captchaValidator->setOptions(
						array(
							'word' => $requestArguments['newComment']['captchaResponse']
						)
					);
					$validator->addValidator($captchaValidator);
				}

				// If activated and available add the modified captcha_viewhelper validator
				if($this->settings['captcha'] == 'captcha' && \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('captcha_viewhelper')) {
					$captchaValidator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_JhPwcommentsCaptcha_Validation_Validator_CaptchaValidator');
					$captchaValidator->setOptions(
						array(
							'value' => $requestArguments['newComment']['captchaResponse']
						)
					);
					$validator->addValidator($captchaValidator);
				}
			}
		}
	}
}
?>