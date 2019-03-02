<?php
namespace Heilmann\JhPwcommentsCaptcha\Controller;

use Heilmann\JhPwcommentsCaptcha\Validation\Validator\SrFreecapValidator;
use PwCommentsTeam\PwComments\Controller\CommentController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\MVC\Controller\Argument;
use TYPO3\CMS\Extbase\Validation\Validator\ConjunctionValidator;

/***************************************************************
*  Copyright notice
*
*  (c) 2014-2019 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
class CaptchaController extends CommentController {

	/**
	 * initializeActionMethodValidators to dynamically add validators
	 *
	 * @return void
	 */
	public function initializeActionMethodValidators() {
		parent::initializeActionMethodValidators();

		$requestArguments = $this->request->getArguments();
		foreach ($this->arguments as $argument) {
			/* @var  Argument $argument */
			if ($argument->getName() == 'newComment' && $this->actionMethodName == 'createAction') {
				// Get the validators of the model
				/* @var ConjunctionValidator $validator */
				$validator = $argument->getValidator();

				// If activated and available add the modified sr_freecap validator
				if($this->settings['captcha'] == 'sr_freecap' && ExtensionManagementUtility::isLoaded('sr_freecap')) {
					$options = array(
						'word' => $requestArguments['newComment']['captchaResponse']
					);
					/** @var SrFreecapValidator $captchaValidator */
					$captchaValidator = GeneralUtility::makeInstance(SrFreecapValidator::class, $options);
					$validator->addValidator($captchaValidator);
				}
			}
		}
	}
}