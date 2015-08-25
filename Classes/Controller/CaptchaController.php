<?php
namespace Heilmann\JhPwcommentsCaptcha\Controller;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
class CaptchaController extends \PwCommentsTeam\PwComments\Controller\CommentController {

	/**
	 * initializeActionMethodValidators to dynamically add validators
	 *
	 * @return void
	 */
	public function initializeActionMethodValidators() {
		parent::initializeActionMethodValidators();

		$requestArguments = $this->request->getArguments();
		foreach ($this->arguments as $argument) {
			/* @var  \TYPO3\CMS\Extbase\MVC\Controller\Argument $argument */
			if ($argument->getName() == 'newComment' && $this->actionMethodName == 'createAction') {
				// Get the validators of the model
				/* @var \TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator $validator */
				$validator = $argument->getValidator();

				// If activated and available add the modified sr_freecap validator
				if($this->settings['captcha'] == 'sr_freecap' && ExtensionManagementUtility::isLoaded('sr_freecap')) {
					$options = array(
						'word' => $requestArguments['newComment']['captchaResponse']
					);
					/** @var \Heilmann\JhPwcommentsCaptcha\Validation\Validator\SrFreecapValidator  $captchaValidator */
					$captchaValidator = GeneralUtility::makeInstance('Heilmann\\JhPwcommentsCaptcha\\Validation\\Validator\\SrFreecapValidator', $options);
					$validator->addValidator($captchaValidator);
				}

				// If activated and available add the modified captcha_viewhelper validator
				// It seems that EXT:captcha_viewhelper is not maintained anymore. Support will be dropped two minor versions later
				if($this->settings['captcha'] == 'captcha' && ExtensionManagementUtility::isLoaded('captcha_viewhelper')) {
					$options = array(
						'value' => $requestArguments['newComment']['captchaResponse']
					);
					/** @var \Heilmann\JhPwcommentsCaptcha\Validation\Validator\CaptchaValidator  $captchaValidator */
					$captchaValidator = GeneralUtility::makeInstance('Heilmann\\JhPwcommentsCaptcha\\Validation\\Validator\\CaptchaValidator', $options);
					$validator->addValidator($captchaValidator);
				}
			}
		}
	}
}
?>